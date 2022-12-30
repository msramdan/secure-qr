<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDasboardController extends Controller
{
    public function __invoke(Request $request)
    {
        return Inertia::render('Admin/Dashboard');
    }
}
