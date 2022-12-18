<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPartnerController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission::partner_show')->only('index');
        // $this->middleware('permission::partner_create')->only('create', 'store');
        // $this->middleware('permission::partner_update')->only('edit', 'update');
        // $this->middleware('permission::partner_delete')->only('destroy');
        // $this->middleware('permission::partner_detail')->only('show');
    }
    public function index()
    {
        return Inertia::render('Admin/Partner/Partner');
    }
    public function create()
    {
        return Inertia::render('Admin/Partner/Create');
    }
    public function show($id)
    {
        return Inertia::render('Admin/Partner/Detail');
    }
    public function store(Request $request)
    {
    }
    public function edit($id)
    {
        return Inertia::render('Admin/Partner/Edit');
    }
    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {
    }
    public function list($id)
    {
        return Inertia::render('Admin/Partner/ListBisnis');
    }
}
