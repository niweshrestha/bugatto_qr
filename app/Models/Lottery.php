<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lottery extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "lotteries";
    protected $guarded = [];

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
