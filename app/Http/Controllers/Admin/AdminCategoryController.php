<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class AdminCategoryController extends Controller
{
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
        Category::create(
            $request->validate([
                'code' => 'required|unique:categories,code',
                'name' => 'required|min:1'
            ])
        );
        return to_route('admin.category.index');
    }
    public function edit($id)
    {
        $category = Category::findorFail($id);
        return Inertia::render('Admin/Master/Kategori/EditCategory', ['category' => $category]);
    }
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update(
            $request->validate([
                'code' => 'required|unique:categories,code,' . $id,
                'name' => 'required'
            ])
        );
        return to_route('admin.category.index');
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $product = Product::where('category_id', $category->id)->get();
        if ($product->isEmpty()) {
            $category->delete();
            return to_route('admin.category.index');
        }
        return redirect()->back();
    }
}
