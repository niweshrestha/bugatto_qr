<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Rules\Slug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public $error;

    public function lists()
    {
        $brands = Brand::orderBy('id', 'desc')->paginate(10)->fragment('codes');
        return view('dashboard.pages.brands.lists', compact('brands'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('dashboard.pages.brands.generate');
        }

        if ($request->isMethod('POST')) {
            $request->validate([
                'name' => 'required|string|max:20',
                'slug' => ['required', new Slug],
                'description' => 'nullable|string|min:3',
                'brand_logo' => 'required|file|mimes:png,jpg,jpeg',
                'brand_cover' => 'nullable|file|mimes:png,jpg,jpeg',
            ]);

            DB::beginTransaction();
            try {
                // dd($request);
                $logo_path = null;
                $cover_path = null;
                if ($request->hasFile('brand_logo'))
                {
                    $fileName = $request->file('brand_logo');
                    $logo_path = $this->fileUpload($request->name, $fileName, 'logo');
                }

                if ($request->hasFile('brand_cover'))
                {
                    $fileName = $request->file('brand_cover');
                    $cover_path = $this->fileUpload($request->name, $fileName, 'cover');
                }
                
                // create brand
                $code = new Brand;
                $code->name = $request->name;
                $code->slug = $request->slug;
                $code->logo_path = $logo_path ?? '';
                $code->cover_path = $cover_path ?? '';
                $code->description = $request->description;
                $code->save(); // saving code

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $this->error = 'Ops! looks like we had some problem';
                $this->error = $e->getMessage();
                return redirect()->route('admin.brand.generate')->with('error-message', $this->error);
            }

            return redirect()->route('admin.brand.lists')->with('success', 'Code has been generated successfully.');
        }
    }

    protected function fileUpload($name, $file, $type = null)
    {
        try {
            $currentTime = time(); // time in sec
            $imageName = $name . '-' . $currentTime . '-' . $type . '.' . $file->getClientOriginalExtension(); // full image name
            $imgPath = 'brand'; // full path
            $file->move(storage_path("app/public/" . $imgPath), $imageName);
            return 'storage/' .$imgPath . '/' . $imageName;
        } catch (\Exception $e) {
            $this->error = 'Ops! looks like we had some problem: ' . $e->getMessage();
            \Log::error($this->error);
        }
    }

    public function show($brandId = 0)
    {
        $brand = Brand::find($brandId);
        $status = $brand->status ? 'text-success':'text-danger';
        $html = "";
        if (!empty($brand)) {
            $html = "<div class='show-card'>
                        <div class='img-avatar'>
                            <img src='". asset($brand->logo_path) ."' alt='brand-logo' />
                        </div>
                        <div class='show-card-text'>
                            <div class='portada' style='background-image: url(\" ". asset($brand->cover_path) ." \")'></div>

                            <div class='title-total'>
                                <div class='title ". $status ."'>" .
                                    ($brand->status ? 'Active':'Inactive') . "
                                </div>
                                <h2>". $brand->name ."</h2>
                        
                                <div class='desc'>". $brand->description ."</div>
                            </div>
                        </div>
                    </div>";
        }
        $response['html'] = $html;

        return response()->json($response);
    }
}
