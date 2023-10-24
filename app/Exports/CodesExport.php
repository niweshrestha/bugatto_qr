<?php

namespace App\Exports;

use App\Models\Code;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CodesExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    private $brandId;

    public function __construct($brandId)
    {
        $this->brandId = $brandId;
    }

    public function map($row): array
    {
        return [
            '="' . $row->security_no . '"', // Format as text to preserve leading zeros
            $row->qr_path,
        ];
    }

    public function headings(): array
    {
        return [
            'Codes',
            'QrPath',
            // Add more headers as needed
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
