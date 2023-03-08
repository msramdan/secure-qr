<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function index()
    {
        $partner = User::firstWhere('id', Auth::user()->id);
        return Inertia::render('Admin/Profile', [
            'profile' => $partner
        ]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::user()->id)],
            'password' => [
                'nullable',
                'min:8',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                'confirmed'
            ],
        ]);
        try {
            $partner = User::where('code', $id)->first();

            if ($request->password != null) {
                $data['password'] = bcrypt($request->password);
                $partner->update($data);
            } else {
                $partner->update([
                    'name' => $data["name"],
                    'email' => $data["email"]
                ]);
            }
            \Message::success('Berhasil merubah data');
            return redirect()->back();
        } catch (\Throwable $th) {
            \Message::danger('Gagal merubah data');
            return redirect()->back();
        }
    }
}
