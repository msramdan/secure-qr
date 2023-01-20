<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RequestQrcode;

class AdminRequestQrcodeController extends Controller
{
    public function index()
    {
        $request = RequestQrcode::with('product:id,name', 'type_qrcode:id,name')->paginate(10);
        return Inertia::render('Admin/Request/Create', ['requests' => $request]);
    }
    public function show($id)
    {
        return Inertia::render('Admin/Request/DetailRequestQR');
    }
}
