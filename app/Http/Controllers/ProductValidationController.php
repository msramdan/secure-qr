<?php

namespace App\Http\Controllers;

use App\Models\ClaimedLoyalty;
use App\Models\LoyaltyProgram;
use Inertia\Inertia;
use App\Models\QrCode;
use App\Models\Sosmed;
use Illuminate\Http\Request;
use App\Models\ProductRating;
use App\Models\ProductScanned;
use App\Models\RoyaltiProgram;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class ProductValidationController extends Controller
{
    public function scan($id)
    {
        $product = QrCode::select('businesses.logo as logo_brand', 'business_videos.video')
            ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
            ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->join('business_videos', 'business_videos.business_id', '=', 'businesses.id')
            ->where('qr_codes.serial_number', $id)
            ->first();
        return Inertia::render('Frontend/ProductValidation/CheckProduct', [
            'brandLogo' => $product,
            'sn' => $id,
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
                $rating = ProductRating::where('product_id', $product->product_id)->where('visitor', $scanned['visitor'])->first();
                $getProdukRating = ProductRating::where('product_id', $product->product_id)->get('produk_rated');
                $produk_rating = $getProdukRating->count() > 0 ? round($getProdukRating->sum('produk_rated') / $getProdukRating->count(), 2) : 0;
                $loyaltyProgram = LoyaltyProgram::select('end_program', 'start_program', 'id')->where('qr_code_id', $valid->id)
                    ->where('end_program', '>=', date('Y-m-d'))
                    ->first();
                $loyaltyStatus = (bool) false;
                if ($loyaltyProgram != null) {
                    if (date('Y-m-d') >= $loyaltyProgram->start_program) {
                        if (date('Y-m-d') >= $loyaltyProgram->end_program) {
                            $loyaltyStatus = false;
                        } else {
                            $claimed = ClaimedLoyalty::where('loyalty_program_id', $loyaltyProgram->id)->first();
                            // dd($claimed->isEmpty());
                            if ($claimed == null) {
                                $loyaltyStatus = true;
                            } else {
                                $loyaltyStatus = false;
                            }
                        }
                    } else {
                        $loyaltyStatus = false;
                    }
                }

                $scanned['qr_code_id'] = $valid->id;
                // cek duplicate serial number
                $duplicate = ProductScanned::where('qr_code_id', $valid->id)->get();
                if ($duplicate->isEmpty()) {

                    ProductScanned::create($scanned);
                    return Inertia::render('Frontend/ProductValidation/ValidationResult', [
                        'product_status' => 'registered',
                        'product' => $product,
                        'sosmed' => $sosialLinks,
                        'product_rate' => isset($getProdukRating) ? $produk_rating : 0,
                        'status' => $rating != null ? true : false,
                        'loyalty' => $loyaltyStatus,
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
                                'product_rate' => isset($getProdukRating) ? $produk_rating : 0,
                                'status' => $rating != null ? true : false,
                                'loyalty' => $loyaltyStatus,
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
            $getProdukRating = ProductRating::where('product_id', $produk->id)->get('produk_rated');
            $produk_rating = $getProdukRating->count() > 0 ? round($getProdukRating->sum('produk_rated') / $getProdukRating->count(), 2) : 0;
            $respon = [
                'message' => 'Terimakasih atas rating anda.',
                'rating' => $produk_rating,
            ];
            return response($respon, 200)->header('X-Inertia', true);
        } else {
            return response()->json([
                'message' => 'Terimakasih, anda telah melakukan rating.'
            ], 200);
        }
    }
}
