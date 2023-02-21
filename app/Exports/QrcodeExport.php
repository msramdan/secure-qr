<?php

namespace App\Exports;

use App\Models\QrCode;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class QrcodeExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request_qr_id;
    public function __construct(string $keyword)
    {
        $this->request_qr_id = $keyword;
    }
    public function headings(): array
    {
        return [
            'Batch Code',
            'Nama Produk',
            'Serial Number',
            'PIN',
            'Link',
        ];
    }
    public function collection()
    {
        return QrCode::join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
            ->join('batch_codes', 'batch_codes.qr_code_id', '=', 'qr_codes.id')
            ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
            ->select('qr_codes.pin', 'qr_codes.serial_number', 'products.name as nama_produk', 'batch_codes.batch_code')
            ->where('qr_codes.request_qrcode_id', '=', $this->request_qr_id)
            ->where('batch_codes.request_qrcode_id', $this->request_qr_id)
            ->get();
    }

    public function map($row): array
    {
        return [
            $row->batch_code,
            $row->nama_produk,
            $row->serial_number,
            $row->pin,
            url('/scan', $row->serial_number)
        ];
    }
}
