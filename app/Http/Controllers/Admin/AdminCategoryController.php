<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class AdminCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission::category_show')->only('index');
        $this->middleware('permission::category_create')->only('create', 'store');
        $this->middleware('permission::category_update')->only('edit', 'update');
        $this->middleware('permission::category_delete')->only('destroy');
        $this->middleware('permission::category_detail')->only('show');
    }
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $category = Category::when($request->input('search'), function ($query, $search) {
            $query->where('code', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%");
        })->paginate($paginate)
            ->withQueryString()
            ->through(fn ($ct) => [
                'id' => $ct->id,
                'code' => $ct->code,
                'name' => $ct->name,
            ]);
        return Inertia::render('Admin/Master/Kategori/Category', [
            'category' => $category,
            'filters' => $request->only(['search'])
        ]);
    }
    public function create()
    {
        return Inertia::render('Admin/Master/Kategori/CreateCategory');
    }
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return Inertia::render('Admin/Master/Kategori/DetailCategory', ['category' => $category]);
    }
    public function store(Request $request)
    {
        try {
            Category::create(
                $request->validate([
                    'code' => 'required|unique:categories,code',
                    'name' => 'required|min:1'
                ])
            );

            \Message::success('Berhasil merubah data!');
            return to_route('admin.category.index');
        } catch (\Throwable $th) {
            \Message::danger('Gagal merubah data!');
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $category = Category::findorFail($id);
        return Inertia::render('Admin/Master/Kategori/EditCategory', ['category' => $category]);
    }
    public function update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->update(
                $request->validate([
                    'code' => 'required|unique:categories,code,' . $id,
                    'name' => 'required'
                ])
            );
            \Message::success('Berhasil merubah data!');
            return to_route('admin.category.index');
        } catch (\Throwable $th) {
            \Message::danger('Gagal merubah data!');
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $product = Product::where('category_id', $category->id)->get();
            if ($product->isEmpty()) {
                $category->delete();
                return to_route('admin.category.index');
            }
            return redirect()->back();
            \Message::success('Berhasil menghapus data!');
        } catch (\Throwable $th) {
            \Message::danger('Gagal menghapus data!');
            return redirect()->back();
        }
    }
}
