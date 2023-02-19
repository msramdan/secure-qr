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
        // dd($this->getDuplicate());
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
            $colorKey = (array_sum($cityData) < 500) ? 'green' : ((array_sum($cityData) < 1000) ? 'yellow' : 'red');

            $dataByCity[] = [
                'city' => $city,
                'data' => array_values($cityData),
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
            ->selectRaw('COUNT(*) AS totalScan, kota as city')
            ->where('businesses.partner_id', Auth::guard('partners')->user()->id)
            ->groupBy('city')
            ->get();

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
            ->where('businesses.partner_id', Auth::guard('partners')->user()->id)
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
            ->where('businesses.partner_id', Auth::guard('partners')->user()->id)
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
            ->where('businesses.partner_id', Auth::guard('partners')->user()->id)
            ->count();
        return $count;
    }

    public function getDuplicate()
    {
        $data = DB::table('product_scanneds')
            ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
            ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
            ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->where('businesses.partner_id', Auth::guard('partners')->user()->id)
            ->select('qr_code_id')
            ->get();

        $countedData = $data->groupBy('qr_code_id')->map(function ($item) {
            return $item->count();
        });

        $maxCount = $countedData->max();
        $maxCountData = $countedData->filter(function ($item) use ($maxCount) {
            return $item == $maxCount;
        });

        $maxCountData = $maxCountData->keys()->map(function ($item) use ($maxCount) {
            return ['qr_code_id' => $item, 'total_duplicates' => $maxCount];
        });

        return $maxCountData->take(1);
    }
}
