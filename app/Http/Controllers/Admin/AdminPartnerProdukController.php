<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPartnerProdukController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Product/PartnerProduct');
    }
    public function show($id)
    {
        return Inertia::render('Admin/Product/ProductDetail');
    }
}
