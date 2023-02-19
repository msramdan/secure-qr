<?php

namespace App\Http\Controllers\Partner;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ProductScanned;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\QrCode;
use Illuminate\Support\Facades\Auth;

class PartnerCustomerDataController extends Controller
{
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $productScanned = DB::table('product_scanneds')
            ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
            ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
            ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->where('businesses.partner_id', Auth::guard('partners')->user()->id)
            ->selectRaw('count(*) as total, qr_codes.id, qr_codes.serial_number, products.name, qr_codes.status')
            ->groupBy('qr_codes.id', 'qr_codes.serial_number', 'products.name', 'qr_codes.status')
            ->when($request->input('search'), function ($query, $search) {
                $query->where('products.name', 'like', "%{$search}%")
                    ->orWhere('businesses.name', 'like', "%{$search}%")
                    ->orWhere('qr_codes.serial_number', 'like', "%{$search}%")
                    ->orWhere('qr_codes.status', 'like', "%{$search}%");
            })
            ->paginate($paginate);
        return Inertia::render('Partner/CustomerData/CustomerData', [
            'product' => $productScanned,
            'filters' => $request->only(['search'])
        ]);
    }
    public function show($id)
    {
        $productScanned = ProductScanned::with('qr_code')->where('qr_code_id', $id)->get();
        $sn = $productScanned[0]->qr_code->serial_number;
        $product = $productScanned[0]->qr_code->request_qrcode->product;
        return Inertia::render('Partner/CustomerData/Detail', [
            'productScanned' => $productScanned,
            'serial_number' => $sn,
            'product' => $product
        ]);
    }
    public function update($id)
    {
        try {
            $qr = QrCode::firstWhere('id', $id);
            $qr->status = $qr->status == 1 ? 0 : 1;
            $qr->save();
            if ($qr->status == true) {
                \Message::success('Berhasil mengunci Qr Code!');
            } else {
                \Message::success('Berhasil membuka Qr Code!');
            }
            return redirect()->back();
        } catch (\Throwable $th) {
            \Message::danger('Gagal merubah data!');
            return redirect()->back();
        }
    }
}
