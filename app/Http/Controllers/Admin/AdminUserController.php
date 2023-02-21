<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission::user_show')->only('index');
        $this->middleware('permission::user_create')->only('create', 'store');
        $this->middleware('permission::user_update')->only('edit', 'update');
        $this->middleware('permission::user_delete')->only('destroy');
    }
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $user = User::when($request->input('search'), function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })
            ->with('roles')
            ->paginate($paginate)
            ->withQueryString();
        return Inertia::render('Admin/Utilities/Users/User', [
            'users' => $user,
            'filters' => $request->only(['search'])
        ]);
    }
    public function create()
    {
        $roles = Role::all();
        return Inertia::render('Admin/Utilities/Users/CreateUser', [
            'roles' => $roles
        ]);
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:50|unique:users,name',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:7|confirmed',
                'role' => 'required',
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            $user->assignRole($request->role);
            \Message::success('Berhasil menyimpan data!');
            return redirect()->back();
        } catch (\Throwable $th) {
            \Message::danger('Gagal menyimpan data!');
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return Inertia::render('Admin/Utilities/Users/EditUser', [
            'user' => $user->load('roles'),
            'roles' => $roles
        ]);
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'nullable|min:7|confirmed',
                'role' => 'required',
            ]);
            $user = User::find($id);
            if ($request->password == '' || $request->password == null) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);
            } else {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password)
                ]);
            }
            $user->syncRoles($request->role);
            \Message::success('Berhasil merubah data!');
            return to_route('admin.users.index');
        } catch (\Throwable $th) {
            \Message::danger('Gagal merubah data!');
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->removeRole($user->roles->first());
            $user->delete();
            \Message::success('Berhasil menghapus data!');
            return to_route('admin.users.index');
        } catch (\Throwable $th) {
            \Message::danger('Gagal menghapus data!');
            return to_route('admin.users.index');
        }
    }
}
