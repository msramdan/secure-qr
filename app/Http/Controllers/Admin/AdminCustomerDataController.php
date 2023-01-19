<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ProductScanned;
use App\Http\Controllers\Controller;

class AdminCustomerDataController extends Controller
{
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $userscan = ProductScanned::join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
            ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
            ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->orderBy('product_scanneds.id', 'desc')
            ->select('products.name as nama_produk', 'product_scanneds.*', 'businesses.name as business_name', 'qr_codes.serial_number', 'qr_codes.id as id_qrcode', 'qr_codes.status')
            ->when($request->input('search'), function ($query, $search) {
                $query->where('products.name', 'like', "%{$search}%");
            })
            ->paginate($paginate)
            ->withQueryString();
        return Inertia::render('Admin/Scanned/CustomerData', [
            'customers' => $userscan,
            'filters' => $request->only(['search'])
        ]);
    }
    public function show($id)
    {
        return Inertia::render('Admin/Scanned/DetailCustomerData');
    }
    public function lock(Request $request, $id)
    {
    }
}
