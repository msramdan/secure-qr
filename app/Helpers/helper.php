<?php

use App\Models\Business;
use App\Models\Partner;
use App\Models\Product;
use App\Models\RequestQrcode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

function format($params)
{
  return "Rp " . number_format($params, 2, ',', '.');
}
function getBycity()
{
  if (Auth::guard('partners')) {
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
}
function getMapData()
{
  if (Auth::guard('web')) {
    $data = DB::table('product_scanneds')
      ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
      ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
      ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
      ->join('businesses', 'products.business_id', '=', 'businesses.id')
      ->selectRaw('COUNT(*) AS totalScan, kota as city')
      ->groupBy('city')
      ->get();
  } else {
    $data = DB::table('product_scanneds')
      ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
      ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
      ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
      ->join('businesses', 'products.business_id', '=', 'businesses.id')
      ->where('businesses.partner_id', Auth::guard('partners')->id())
      ->selectRaw('COUNT(*) AS totalScan, kota as city')
      ->groupBy('city')
      ->get();
  }

  return $data;
}
function getByCategory()
{
  if (Auth::guard('web')) {
    $data = DB::table('product_scanneds')
      ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
      ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
      ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
      ->join('businesses', 'products.business_id', '=', 'businesses.id')
      ->join('categories', 'products.category_id', '=', 'categories.id')
      ->selectRaw('COUNT(*) AS totalScan, categories.name as kategori')
      ->groupBy('kategori')
      ->get();
  } else {
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
  }
  $labels = $data->pluck('kategori')->toArray();
  $dataPoints = $data->pluck('totalScan')->toArray();
  return [$labels, $dataPoints];
}
function getByBisnis()
{
  if (Auth::guard('web')) {
    $data = DB::table('product_scanneds')
      ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
      ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
      ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
      ->join('businesses', 'products.business_id', '=', 'businesses.id')
      ->selectRaw('COUNT(*) AS totalScan, businesses.brand')
      ->groupBy('brand')
      ->get();
  } else {
    $data = DB::table('product_scanneds')
      ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
      ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
      ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
      ->join('businesses', 'products.business_id', '=', 'businesses.id')
      ->where('businesses.partner_id', Auth::guard('partners')->id())
      ->selectRaw('COUNT(*) AS totalScan, businesses.brand')
      ->groupBy('brand')
      ->get();
  }
  $labels = $data->pluck('brand')->toArray();
  $dataPoints = $data->pluck('totalScan')->toArray();
  return [$labels, $dataPoints];
}
function allScan()
{
  if (Auth::guard('web')) {
    $count = DB::table('product_scanneds')
      ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
      ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
      ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
      ->join('businesses', 'products.business_id', '=', 'businesses.id')
      ->join('categories', 'products.category_id', '=', 'categories.id')
      ->count();
  } else {
    $count = DB::table('product_scanneds')
      ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
      ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
      ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
      ->join('businesses', 'products.business_id', '=', 'businesses.id')
      ->join('categories', 'products.category_id', '=', 'categories.id')
      ->where('businesses.partner_id', Auth::guard('partners')->id())
      ->count();
  }
  return $count;
}

function getDuplicate()
{
  if (Auth::guard('web')) {
    $data = DB::table('product_scanneds')
      ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
      ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
      ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
      ->join('businesses', 'products.business_id', '=', 'businesses.id')
      ->select('qr_code_id')
      ->get();
  } else {
    $data = DB::table('product_scanneds')
      ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
      ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
      ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
      ->join('businesses', 'products.business_id', '=', 'businesses.id')
      ->where('businesses.partner_id', Auth::guard('partners')->id())
      ->select('qr_code_id')
      ->get();
  }

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

  return $maxCountData == '' ? $maxCountData->take(1) : 0;
}

function partners()
{
  if (Auth::guard('web')) {
    $data = Partner::all()->count();
    return $data;
  }
}
function partner_business()
{
  if (Auth::guard('web')) {
    $data = Business::all()->count();
    return $data;
  }
}
function partner_product()
{
  if (Auth::guard('web')) {
    $data = Product::all()->count();
    return $data;
  }
}
function request_qrcode()
{
  if (Auth::guard('web')) {
    $data = RequestQrcode::all()->count();
    return $data;
  }
}
