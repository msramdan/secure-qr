<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSettingWebController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Utilities/Setting');
    }
    public function update(Request $request, $id)
    {
    }
}
