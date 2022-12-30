<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Utilities/Users/User');
    }
    public function create()
    {
        return Inertia::render('Admin/Utilities/Users/CreateUser');
    }
    public function store(Request $request)
    {
    }
    public function edit($id)
    {
        return Inertia::render('Admin/Utilities/Users/EditUser');
    }
    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {
    }
}
