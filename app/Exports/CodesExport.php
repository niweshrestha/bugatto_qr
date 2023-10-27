<?php

namespace App\Exports;

use App\Models\Code;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class CodesExport implements FromQuery, WithColumnFormatting, WithHeadings, WithMapping, ShouldAutoSize
{
    private $brandId;

    public function __construct($brandId)
    {
        $this->brandId = $brandId;
    }

    public function map($row): array
    {
        return [
            $row->security_no,
            $row->qr_path,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT
        ];
    }

    public function headings(): array
    {
        return [
            'Codes',
            'QrPath',
        ];
    }

    public function query()
    {
        $query = Code::query()->select('security_no', 'qr_path');

        if ($this->brandId) {
            $query->where('brand_id', $this->brandId);
        }

        return $query;
    }
}
