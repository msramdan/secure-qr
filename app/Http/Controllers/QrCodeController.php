<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\QrcodeExport;
use App\Models\RequestQrcode;
use Maatwebsite\Excel\Facades\Excel;

class QrCodeController extends Controller
{
    public function export($id)
    {
        $setName = RequestQrcode::join('partners', 'request_qrcodes.partner_id', '=', 'partners.id')
            ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->where('request_qrcodes.id', $id)
            ->select('partners.name as nama_partner', 'products.name as nama_produk', 'businesses.name as nama_bisnis')
            ->first();
        return Excel::download(new QrcodeExport($id), $setName->nama_partner . '-' . $setName->nama_bisnis . '-' . $setName->nama_produk . '.xlsx');
    }
}
