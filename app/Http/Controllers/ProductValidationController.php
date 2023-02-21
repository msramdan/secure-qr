<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\QrCode;
use App\Models\Sosmed;
use Illuminate\Http\Request;
use App\Models\ProductRating;
use App\Models\ProductScanned;
use Illuminate\Support\Facades\DB;

class ProductValidationController extends Controller
{
    public function scan($id)
    {
        $qrcode = QrCode::firstWhere('serial_number', $id);
        return Inertia::render('Frontend/ProductValidation/CheckProduct', [
            'sn' => $id,
            'qr' => $qrcode,
            'apiKey' => env('MAP_KEY', 'AIzaSyA2C2Pu928d5fXhDBBpozZY4ZKkWLbmrTY')
        ]);
    }
    public function validation(Request $request)
    {
        abort_if($request->isMethod('get'), 404);
        try {
            $request->validate([
                'latitude' => ['required'],
                'longitude' => ['required'],
            ]);
            // define all
            $pin = $request->one . $request->two . $request->three . $request->four . $request->five . $request->six;
            $scanned['lat'] = $request->latitude;
            $scanned['long'] = $request->longitude;
            $scanned['visitor'] = $request->getClientIp(true);
            $scanned['kota'] = $request->kota;
            // validation
            $valid = QrCode::where('serial_number', $request->serial_number)->where('pin', $pin)->first();
            if ($valid) {
                $product = QrCode::join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
                    ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->join('businesses', 'products.business_id', '=', 'businesses.id')
                    ->where('qr_codes.serial_number', $request->serial_number)
                    ->where('qr_codes.pin', $pin)
                    ->select('products.name as nama_produk', 'categories.name as nama_kategori', 'businesses.logo as logo_brand', 'businesses.brand as nama_brand', 'products.bpom', 'products.photo', 'products.id as product_id', 'products.netto', 'products.expired_date', 'products.production_code', 'products.partner_id', 'qr_codes.*')
                    ->first();
                $sosialLinks = Sosmed::where('partner_id', $product->partner_id)->get();
                $rating = ProductRating::where('product_id', $product->product_id)->get();
                $scanned['qr_code_id'] = $valid->id;
                // cek duplicate serial number
                $duplicate = ProductScanned::where('qr_code_id', $valid->id)->get();
                if ($duplicate->isEmpty()) {

                    ProductScanned::create($scanned);
                    return Inertia::render('Frontend/ProductValidation/ValidationResult', [
                        'product_status' => 'registered',
                        'product' => $product,
                        'sosmed' => $sosialLinks,
                        'rate' => $rating,
                    ]);
                } else {
                    // cek status qr terkunci atau tidak
                    $Qr = $duplicate->load('qr_code');
                    if (isset($Qr)) {
                        if ($Qr[0]->qr_code->status == false) {
                            if ($Qr[0]->visitor != $scanned['visitor']) {
                                ProductScanned::create($scanned);
                            }
                            return Inertia::render('Frontend/ProductValidation/ValidationResult', [
                                'product_status' => 'registered',
                                'product' => $product,
                                'sosmed' => $sosialLinks,
                                'rating' => $rating,
                            ]);
                        } else {
                            return Inertia::render('Frontend/ProductValidation/ValidationResult', [
                                'product_status' => 'duplicate'
                            ]);
                        }
                    }
                }
            } else {
                return Inertia::render('Frontend/ProductValidation/ValidationResult', [
                    'product_status' => 'not registered'
                ]);
            }
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            \Message::danger('Gagal menvalidasi produk!');
            return redirect()->back();
        }
    }
    public function rating(Request $request, $id)
    {
        $ipClient = $request->getClientIp(true);
        $produk = QrCode::join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
            ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
            ->where('qr_codes.serial_number', $id)
            ->select('products.id')
            ->first();
        $cek = ProductRating::where('product_id', $produk->id)->where('visitor', $ipClient)->first();
        if (!isset($cek)) {
            DB::table('product_ratings')->insert([
                'product_id' => $produk->id,
                'produk_rated' => $request->productRate,
                'visitor' => $ipClient,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        $getProdukRating = ProductRating::where('product_id', $produk->id)->get('produk_rated');
        $produk_rating = $getProdukRating->count() > 0 ? round($getProdukRating->sum('produk_rated') / $getProdukRating->count(), 2) : 0;
        $respon = [
            'message' => $cek->visitor == $ipClient && $produk->id == $cek->product_id ? 'Terimkasih, anda sudah melakukan rating' : 'Terimakasih atas rating anda',
            'rating' => $produk_rating,
        ];
        return response($respon, 200)->header('X-Inertia', true);
    }
}
