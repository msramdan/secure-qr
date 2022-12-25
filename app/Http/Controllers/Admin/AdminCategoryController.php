<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Master/Kategori/Category');
    }
    public function create()
    {
        return Inertia::render('Admin/Master/Kategori/CreateCategory');
    }
    public function show($id)
    {
        return Inertia::render('Admin/Master/Kategori/DetailCategory');
    }
    public function store(Request $request)
    {
    }
    public function edit($id)
    {
        return Inertia::render('Admin/Master/Kategori/EditCategory');
    }
    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {
    }
}
