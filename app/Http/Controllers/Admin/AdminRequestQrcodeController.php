<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRequestQrcodeController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Request/RequestQR');
    }
    public function show($id)
    {
        return Inertia::render('Admin/Request/DetailRequestQR');
    }
}
