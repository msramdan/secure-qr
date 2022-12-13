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
        $requestQrs = RequestQrcode::with('product:id,code,name', 'type_qr:id,name');
        return Inertia::render('Admin/Dashboard');
    }
    public function create(Request $request)
    {
    }
    public function show(Request $request)
    {
    }
    public function store(Request $request)
    {
    }
    public function edit(Request $request)
    {
    }
    public function update(Request $request)
    {
    }
    public function destroy(Request $request)
    {
    }
}
