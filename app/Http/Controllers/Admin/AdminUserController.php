<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $user = User::when($request->input('search'), function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->paginate($paginate)
            ->withQueryString();
        return Inertia::render('Admin/Utilities/Users/User', [
            'users' => $user
        ]);
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
