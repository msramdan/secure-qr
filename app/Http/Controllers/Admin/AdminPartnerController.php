<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserPartner;

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
        $partner = UserPartner::all();
        return Inertia::render('Admin/Dashboard', compact('partner'));
    }
    public function create(Request $request)
    {
    }
    public function show(Request $request)
    {
    }
    public function store(Request $request)
    {
    }
    public function edit(Request $request)
    {
    }
    public function update(Request $request)
    {
    }
    public function destroy(Request $request)
    {
    }
}
