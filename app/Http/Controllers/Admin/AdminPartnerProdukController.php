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
        $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->join('user_partners', 'products.user_id', '=', 'user_partners.user_id')
            ->join('users', 'user_partners.user_id', '=', 'users.id')
            ->get(['products.*', 'users.name as nama_partner', 'categories.name as nama_kategori', 'businesses.name as nama_bisnis']);
        return Inertia::render('Admin/Product/PartnerProduct', ['products' => $products]);
    }
    public function show($id)
    {
        $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->join('partners', 'businesses.partner_id', '=', 'partners.id')
            ->select('products.*', 'categories.name as nama_kategori', 'businesses.name as nama_bisnis', 'partners.name as nama_partner')
            ->where('products.id', $id)
            ->get();
        return Inertia::render('Admin/Product/ProductDetail', ['products' => $products]);
    }
}
