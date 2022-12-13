<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\RequestQrcode;
use App\Models\ProductScanned;
use App\Http\Controllers\Controller;
use App\Models\UserPartner;

class AdminDasboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $totalPartner = UserPartner::count();
        $totalBusiness = Business::count();
        $totalProduct = Product::count();
        $totalRequestQr = RequestQrcode::count();
        $totalCategory = Category::count();
        $awal = $request->get('start_date') . ' ' . '00:00:01';
        $akhir = $request->get('end_date') . ' ' . '23:59:59';
        switch ($request->exists('start_date') && $request->exists('end_date')) {
            case true:
                $totalProductScanned = ProductScanned::where('product_scanneds.created_at', '>=', $awal)
                    ->where('product_scanneds.created_at', '<=', $akhir)->count();
                break;
            default:
                $totalProductScanned = ProductScanned::count();
                break;
        }

        return Inertia::render('Admin/Dashboard', compact(
            'totalPartner',
            'totalBusiness',
            'totalProduct',
            'totalRequestQr',
            'totalProductScanned',
            'totalCategory',
        ));
    }
}
