<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RequestQrcode;

class AdminRequestQrcodeController extends Controller
{
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $request = RequestQrcode::with('product:id,name', 'type_qrcode:id,name')->paginate($paginate);
        // dd($request);
        return Inertia::render('Admin/Request/RequestQR', ['requests' => $request]);
    }
    public function show($id)
    {
        return Inertia::render('Admin/Request/DetailRequestQR');
    }
}
