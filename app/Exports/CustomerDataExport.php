<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class CustomerDataExport implements FromCollection, WithHeadings, ShouldAutoSize, WithCustomValueBinder
{
    private $data = [];

    private $product;

    public function __construct($product)
    {
        $this->product = $product;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $whereQuery = $this->product ? ($this->product != 'Semua Produk' ? "WHERE products.name = '" . $this->product . "'" : '') : '';

        $arrTempData = DB::select("SELECT 
                        qr_codes.serial_number,
                        products.name,
                        count(*) as total,
                        product_scanneds.kota,
                        product_scanneds.whatsapp_number
                    FROM product_scanneds 
                        LEFT JOIN qr_codes ON qr_codes.id = product_scanneds.qr_code_id 
                        LEFT JOIN request_qrcodes ON request_qrcodes.id = qr_codes.request_qrcode_id 
                        LEFT JOIN products on products.id = request_qrcodes.product_id " . $whereQuery . "
                    GROUP BY products.name, qr_codes.id, qr_codes.serial_number, qr_codes.status, product_scanneds.kota, product_scanneds.whatsapp_number");

        foreach($arrTempData as $index => $tempData) {
            $this->data[] = [
                $index + 1,
                $tempData->serial_number,
                $tempData->name,
                $tempData->total,
                $tempData->kota,
                $tempData->whatsapp_number,
            ];
        }
        
        return collect($this->data);
    }

    public function headings(): array
    {
        return ["No", "Serial Number", "Nama Produk", 'Total Scan', 'Kota', 'Nomor Whatsapp'];
    }

    public function bindValue(Cell $cell, $value)
    {
        $cell->setValueExplicit($value, DataType::TYPE_STRING2);
        return true;
    }
}
