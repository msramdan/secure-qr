<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard');
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
