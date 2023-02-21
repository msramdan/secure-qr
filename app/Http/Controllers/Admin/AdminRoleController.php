<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class AdminRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission::role_show')->only('index');
        $this->middleware('permission::role_create')->only('create', 'store');
        $this->middleware('permission::role_update')->only('edit', 'update');
        $this->middleware('permission::role_delete')->only('destroy');
        $this->middleware('permission::role_detail')->only('show');
    }
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $roles = Role::when($request->input('search'), function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('guard_name', 'like', "%{$search}%");
        })
            ->paginate($paginate)
            ->withQueryString();
        return Inertia::render('Admin/Utilities/Roles/Roles', [
            'roles' => $roles,
            'filters' => $request->only(['search']),
        ]);
    }
    public function create()
    {
        $roles = config('permission.authorities');
        return Inertia::render('Admin/Utilities/Roles/CreateRoles', [
            'roles' => $roles
        ]);
    }
    public function store(Request $request)
    {
        dd($request->all());
    }
    public function show($id)
    {
        return Inertia::render('Admin/Utilities/Roles/DetailRoles');
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
