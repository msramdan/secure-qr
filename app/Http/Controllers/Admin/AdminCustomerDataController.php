<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCustomerDataController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Scanned/CustomerData');
    }
    public function show($id)
    {
        return Inertia::render('Admin/Scanned/DetailCustomerData');
    }
    public function lock(Request $request, $id)
    {
    }
}
