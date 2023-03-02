<?php

namespace App\Http\Controllers\Partner;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ProductRating;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Array_;

class PartnerRatingController extends Controller
{
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $productRating = ProductRating::when($request->input('search'), function ($query, $search) {
            $query->where('products.production_code', 'like', "%{$search}%")
                ->orWhere('products.name', 'like', "%{$search}%");
        })
            ->join('products', 'product_ratings.product_id', '=', 'products.id')
            ->where('products.partner_id', Auth::guard('partners')->user()->id)
            ->selectRaw('SUM(produk_rated) as total_produk_rated, products.production_code, products.name')
            ->groupBy('products.production_code', 'products.name')
            ->paginate($paginate)
            ->withQueryString();
        $all = DB::table('product_ratings')
            ->join('products', 'product_ratings.product_id', '=', 'products.id')
            ->where('products.partner_id', Auth::guard('partners')->user()->id)
            ->get()->count();
        return Inertia::render('Partner/Product/Rating/Rating', [
            'filters' => $request->only(['search']),
            'ratings' => $productRating,
            'all' => $all
        ]);
    }
}
