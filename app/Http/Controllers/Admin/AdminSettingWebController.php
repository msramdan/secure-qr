<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SettingWeb;

class AdminSettingWebController extends Controller
{
    public function index()
    {
        $setting = SettingWeb::first();
        return Inertia::render('Admin/Utilities/Setting', ['setting' => $setting]);
    }
    public function update(Request $request, $id)
    {
        dd($request->all());
    }
}
