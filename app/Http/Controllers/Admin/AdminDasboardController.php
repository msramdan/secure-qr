<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminDasboardController extends Controller
{
    public function __invoke(Request $request)
    {
        return Inertia::render('Admin/Dashboard', [
            'dataMap' => getMapData(),
            'chartByKategori' => getByCategory(),
            'chartByBisnis' => getByBisnis(),
            'allScan' => allScan(),
            'duplicateScan' => getDuplicate(),
            'partners' => partners(),
            'partner_business' => partner_business(),
            'partner_product' => partner_product(),
            'request_qrcode' => request_qrcode()
        ]);
    }
}
