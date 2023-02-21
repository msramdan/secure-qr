<?php

namespace App\Http\Controllers\Partner;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PartnerProductController extends Controller
{
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $product = Product::select('partners.name as nama_partner', 'categories.name as category', 'businesses.name as bisnis', 'products.*')->join('businesses', 'products.business_id', '=', 'businesses.id')
            ->join('partners', 'products.partner_id', '=', 'partners.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->when($request->input('search'), function ($query, $search) {
                $query->where('production_code', 'like', "%{$search}%")
                    ->orWhere('products.name', 'like', "%{$search}%")
                    ->orWhere('bpom', 'like', "%{$search}%")
                    ->orWhere('partners.name', 'like', "%{$search}%")
                    ->orWhere('categories.name', 'like', "%{$search}%")
                    ->orWhere('businesses.name', 'like', "%{$search}%");
            })->where('products.partner_id', Auth::guard('partners')->user()->id)
            ->paginate($paginate)
            ->withQueryString()
            ->through(fn ($product) => [
                'id' => $product->id,
                'partner' => $product->nama_partner,
                'category' => $product->category,
                'bisnis' => $product->bisnis,
                'production_code' => $product->production_code,
                'name' => $product->name,
                'bpom' => $product->bpom,
            ]);
        return Inertia::render('Partner/Product/Product', [
            'products' => $product,
            'filters' => $request->only(['search'])
        ]);
    }
    public function create()
    {
        $category = Category::all();
        $company = Business::where('partner_id', Auth::guard('partners')->user()->id)->get();
        return Inertia::render('Partner/Product/Create', [
            'category' => $category,
            'company' => $company
        ]);
    }
    public function store(Request $request)
    {
        try {
            $attr = $request->validate([
                'production_code' => 'required|string|min:1|max:20',
                'product_name' => 'required|string|min:1|max:200',
                'category_id' => 'required|exists:App\Models\Category,id',
                'business_id' => 'required|exists:App\Models\Business,id',
                'bpom' => 'required|string|min:1|max:200',
                'description' => 'required|string',
                'expired_date' => 'required|string',
                'netto' => 'required|string|min:1|max:200',
                'photo' => 'required|image|max:1024',
            ]);
            $attr['slug'] = str($attr['product_name'])->slug();
            $attr['partner_id'] = Auth::guard('partners')->user()->id;
            $attr['name'] = $attr['product_name'];
            // dd($attr);

            if ($request->file('photo') && $request->file('photo')->isValid()) {
                $path = storage_path('app/public/uploads/photos/');
                $filename = $request->file('photo')->hashName();
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                Image::make($request->file('photo')->getRealPath())->resize(400, 400, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })->save($path . $filename);
                $attr['photo'] = $filename;
            }
            Product::create($attr);

            \Message::success('Berhasil menyimpan data!');
            return to_route('partner.produk.index');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            \Message::danger('Gagal menyimpan data!');
            return redirect()->back();
        }
    }
    public function show(Product $product)
    {
        return Inertia::render('Partner/Product/Detail', [
            'product' => $product->load(['business', 'category'])
        ]);
    }
    public function edit(Product $product)
    {
        return Inertia::render('Partner/Product/Edit', [
            'product' => $product->load(['business', 'category']),
            'categories' => Category::all(),
            'businesses' => Business::where('partner_id', Auth::guard('partners')->user()->id)->get()
        ]);
    }
    public function update(Product $product, Request $request)
    {
        // dd($request->all(), $product);
        try {
            $attr = $request->validate([
                'production_code' => 'required|string|min:1|max:20',
                'name' => 'required|string|min:1|max:200',
                'category_id' => 'required|exists:App\Models\Category,id',
                'business_id' => 'required|exists:App\Models\Business,id',
                'bpom' => 'required|string|min:1|max:200',
                'description' => 'required|string',
                'expired_date' => 'required|string',
                'netto' => 'required|string|min:1|max:200',
                'photo' => 'nullable|image|max:1024',
            ]);
            $attr['slug'] = str($attr['name'])->slug();
            if ($request->file('photo') && $request->file('photo')->isValid()) {
                $path = storage_path('app/public/uploads/photos/');
                $filename = $request->file('photo')->hashName();
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                Image::make($request->file('photo')->getRealPath())->resize(400, 400, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })->save($path . $filename);
                // delete old photo from storage
                if ($product->photo != null && file_exists($path . $product->photo)) {
                    unlink($path . $product->photo);
                }
                $attr['photo'] = $filename;
            } else {
                $attr['photo'] = $product->photo;
            }
            $product->update($attr);

            \Message::success('Berhasil merubah data!');
            return to_route('partner.produk.index');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            \Message::danger('Gagal merubah data!');
            return redirect()->back();
        }
    }
    public function destroy(Product $product)
    {
        try {
            $path = storage_path('app/public/uploads/photos/');
            if ($product->photo != null && file_exists($path . $product->photo)) {
                unlink($path . $product->photo);
            }
            $product->delete();
            \Message::success('Berhasil menghapus data!');
            return to_route('partner.produk.index');
        } catch (\Throwable $th) {
            \Message::danger('Gagal menghapus data!');
            return redirect()->back();
        }
    }
}
