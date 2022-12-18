<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTyperQrcodeController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/MaterData/TypeQRCode/TypeQR');
    }
    public function create()
    {
        return Inertia::render('Admin/MaterData/TypeQRCode/CreateTypeQR');
    }
    public function show($id)
    {
        return Inertia::render('Admin/MaterData/TypeQRCode/DetailTypeQR');
    }
    public function store(Request $request)
    {
    }
    public function edit($id)
    {
        return Inertia::render('Admin/MaterData/TypeQRCode/EditTypeQR');
    }
    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {
    }
}
