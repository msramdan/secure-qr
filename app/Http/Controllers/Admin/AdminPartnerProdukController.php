<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class AdminPartnerProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission::partner_product_show')->only('index', 'show');
    }
    public function index(Request $request)
    {
        $pagiante = $request->get('paginate') ?? 10;
        $products = Product::when($request->input('search'), function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('bpom', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })->with('category:id,name', 'business:id,name', 'partner:id,name')
            ->paginate($pagiante)
            ->withQueryString()
            ->through(fn ($product) => [
                'id' => $product->id,
                'nama_partner' => $product->partner->name,
                'nama_bisnis' => $product->business->name,
                'nama_kategori' => $product->category->name,
                'name' => $product->name,
                'bpom' => $product->bpom,
                'description' => $product->description
            ]);
        return Inertia::render('Admin/Product/PartnerProduct', [
            'products' => $products,
            'filters' => $request->only(['search'])
        ]);
    }
    public function show($id)
    {
        $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->join('partners', 'businesses.partner_id', '=', 'partners.id')
            ->select('products.*', 'categories.name as nama_kategori', 'businesses.name as nama_bisnis', 'partners.name as nama_partner')
            ->where('products.id', $id)
            ->first();
        return Inertia::render('Admin/Product/ProductDetail', ['products' => $products]);
    }
}
