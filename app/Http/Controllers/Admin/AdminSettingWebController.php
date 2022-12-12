<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSettingWebController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard');
    }
    public function show(Request $request)
    {
    }
    public function edit(Request $request)
    {
    }
    public function update(Request $request)
    {
    }
}
