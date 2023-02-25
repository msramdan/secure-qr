<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\User;

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
        $request->validate([
            'name' => 'required|string|max:50|unique:roles,name',
            'permissions' => 'required'
        ]);
        try {
            $role = Role::create(['name' => $request->name]);
            $role->givePermissionTo($request->permissions);
            \Message::success('Berhasil menyimpan data!');
            return to_route('admin.roles.index');
        } catch (\Throwable $th) {
            \Message::danger('Gagal menyimpan data!');
            return redirect()->back();
        }
    }
    public function show($id)
    {
        $role = Role::findOrFail($id);
        $permission =  $role->permissions()->pluck('name');
        return Inertia::render('Admin/Utilities/Roles/DetailRoles', [
            'dataRoles' => config('permission.authorities'),
            'role' => $role,
            'permissionUser' => $permission
        ]);
    }
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permission =  $role->permissions()->pluck('name');
        // dd(config('permission.authorities'));
        return Inertia::render('Admin/Utilities/Roles/EditRoles', [
            'dataRoles' => config('permission.authorities'),
            'role' => $role,
            'permissionUser' => $permission
        ]);
    }
    public function update(Request $request, $id)
    {
        dd($request->all(), $id);
    }
    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            if (User::role($role->name)->count()) {
                \Message::danger('Data gagal dihapus, data sudah berelasi');
                return to_route('admin.roles.index');
            }
            $role->revokePermissionTo($role->permissions()->pluck('name')->toArray());
            $role->delete();
            \Message::success('Data berhasil di hapus!');
            return to_route('admin.roles.index');
        } catch (\Throwable $th) {
            \Message::danger('Data gagal dihapus!');
            return to_route('admin.roles.index');
        }
    }
}
