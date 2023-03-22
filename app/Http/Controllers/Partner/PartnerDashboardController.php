<?php

namespace App\Http\Controllers\Partner;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ProductScanned;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PartnerDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Partner/Dashboard', [
            'dataByCity' => $this->getBycity(),
            'dataMap' => $this->getMapData(),
            'chartByKategori' => $this->getByCategory(),
            'chartByBisnis' => $this->getByBisnis(),
            'allScan' => $this->allScan(),
            'duplicateScan' => $this->getDuplicate()
        ]);
    }

    public function getBycity()
    {
        $color = [
            'red' => '#ef4444',
            'green' => '#22c55e',
            'yellow' => '#eab308'
        ];

        $scansByCityAndMonth = DB::table('product_scanneds')
            ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
            ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
            ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->selectRaw('YEAR(product_scanneds.created_at) AS year, MONTH(product_scanneds.created_at) AS month, COUNT(*) AS count, kota')
            ->where('businesses.partner_id', Auth::guard('partners')->id())
            ->groupBy('year', 'month', 'kota')
            ->get();

        $cities = $scansByCityAndMonth->pluck('kota')->unique();
        $months = range(1, 12);

        $dataByCity = [];

        foreach ($cities as $city) {
            $cityData = $scansByCityAndMonth->where('kota', $city)->pluck('count', 'month')->toArray();
            $cityData = array_replace(array_fill_keys($months, 0), $cityData);
            $colorKey = (array_sum($cityData) <= 5) ? 'green' : ((array_sum($cityData) <= 10) ? 'yellow' : 'red');

            $totalScan = 0;
            foreach ($cityData as $item) {
                $totalScan += $item;
            }
            $dataByCity[] = [
                'city' => $city,
                'data' => array_values($cityData),
                'total' => $totalScan,
                'color' => $color[$colorKey]
            ];
        }
        return $dataByCity;
    }
    public function getMapData()
    {
        $data = DB::table('product_scanneds')
            ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
            ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
            ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->where('businesses.partner_id', Auth::guard('partners')->id())
            ->selectRaw('COUNT(*) AS totalScan, serial_number, kota as city')
            ->groupBy('serial_number', 'city')
            ->get();
        // dd($data);
        return $data;
    }
    public function getByCategory()
    {
        $data = DB::table('product_scanneds')
            ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
            ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
            ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('businesses.partner_id', Auth::guard('partners')->id())
            ->selectRaw('COUNT(*) AS totalScan, categories.name as kategori')
            ->groupBy('kategori')
            ->get();
        $labels = $data->pluck('kategori')->toArray();
        $dataPoints = $data->pluck('totalScan')->toArray();
        return [$labels, $dataPoints];
    }
    public function getByBisnis()
    {
        $data = DB::table('product_scanneds')
            ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
            ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
            ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->where('businesses.partner_id', Auth::guard('partners')->id())
            ->selectRaw('COUNT(*) AS totalScan, businesses.brand')
            ->groupBy('brand')
            ->get();
        $labels = $data->pluck('brand')->toArray();
        $dataPoints = $data->pluck('totalScan')->toArray();
        return [$labels, $dataPoints];
    }
    public function allScan()
    {
        $count = DB::table('product_scanneds')
            ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
            ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
            ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('businesses.partner_id', Auth::guard('partners')->id())
            ->count();
        return [$count];
    }
    public function getDuplicate()
    {
        $data = DB::table('product_scanneds')
            ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
            ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
            ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->where('businesses.partner_id', Auth::guard('partners')->id())
            ->get();
        $countedData = $data->groupBy('qr_code_id')->map(function ($item) {
            return $item->count();
        });

        $maxCount = $countedData->max();
        $maxCountData = $countedData->filter(function ($item) use ($maxCount) {
            return $item == $maxCount;
        });

        $maxCountData = $maxCountData->keys()->map(function ($item) use ($maxCount) {
            return ['total_duplicates' => $maxCount];
        });

        return $maxCountData->take(1) ?? 0;
    }
}
