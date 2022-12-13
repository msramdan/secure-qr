<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class AdminPartnerProdukController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return Inertia::render('Admin/Dashboard', compact('product'));
    }
    public function show($id)
    {
        $product = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->join('user_partners', 'businesses.user_id', '=', 'user_partners.user_id')
            ->join('users', 'user_partners.user_id', 'users.id')
            ->select('products.*', 'categories.name as nama_kategori', 'businesses.name as nama_bisnis', 'users.name as nama_partner')
            ->where('products.id', 1)
            ->get();
        return $product;
    }
}
