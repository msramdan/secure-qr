<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRoleController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Utilities/Roles/Roles');
    }
    public function create()
    {
        return Inertia::render('Admin/Utilities/Roles/CreateRoles');
    }
    public function show($id)
    {
        return Inertia::render('Admin/Utilities/Roles/DetailRoles');
    }
    public function store(Request $request)
    {
    }
    public function edit($id)
    {
        return Inertia::render('Admin/Utilities/Roles/EditRoles');
    }
    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {
    }
}
