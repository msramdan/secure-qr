<?php

use App\Models\Business;
use App\Models\Partner;
use App\Models\Product;
use App\Models\RequestQrcode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

function getMapData()
{
  $data = DB::table('product_scanneds')
    ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
    ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
    ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
    ->join('businesses', 'products.business_id', '=', 'businesses.id')
    ->selectRaw('COUNT(*) AS totalScan, kota as city, serial_number')
    ->groupBy('city', 'serial_number')
    ->get();
  return $data;
}
function getByCategory()
{
  $data = DB::table('product_scanneds')
    ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
    ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
    ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
    ->join('businesses', 'products.business_id', '=', 'businesses.id')
    ->join('categories', 'products.category_id', '=', 'categories.id')
    ->selectRaw('COUNT(*) AS totalScan, categories.name as kategori')
    ->groupBy('kategori')
    ->get();
  $labels = $data->pluck('kategori')->toArray();
  $dataPoints = $data->pluck('totalScan')->toArray();
  return [$labels, $dataPoints];
}
function getByBisnis()
{
  $data = DB::table('product_scanneds')
    ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
    ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
    ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
    ->join('businesses', 'products.business_id', '=', 'businesses.id')
    ->selectRaw('COUNT(*) AS totalScan, businesses.brand')
    ->groupBy('brand')
    ->get();
  $labels = $data->pluck('brand')->toArray();
  $dataPoints = $data->pluck('totalScan')->toArray();
  return [$labels, $dataPoints];
}
function allScan()
{
  $count = DB::table('product_scanneds')
    ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
    ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
    ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
    ->join('businesses', 'products.business_id', '=', 'businesses.id')
    ->join('categories', 'products.category_id', '=', 'categories.id')
    ->count();
  return [$count];
}

function getDuplicate()
{
  $data = DB::table('product_scanneds')
    ->join('qr_codes', 'product_scanneds.qr_code_id', '=', 'qr_codes.id')
    ->join('request_qrcodes', 'qr_codes.request_qrcode_id', '=', 'request_qrcodes.id')
    ->join('products', 'request_qrcodes.product_id', '=', 'products.id')
    ->join('businesses', 'products.business_id', '=', 'businesses.id')
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
