<?php

namespace App\Http\Controllers\Partner;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Support\Facades\Auth;

class PartnerAuthController extends Controller
{
    public function index()
    {
        return Inertia::render('Auth/PartnerLogin');
    }
    public function register()
    {
        return Inertia::render('Auth/Register');
    }
    public function handleRegister(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|max:100',
                'phone' => 'required|min:10|max:15',
                'address' => 'required|string|max:255',
                'email' => ['required', 'email', 'unique:partners,email'],
                'password' => [
                    'nullable',
                    'min:8',
                    'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                    'confirmed'
                ],
            ]);
            $data['pic'] = 'John Doe';
            $data['photo'] = 'default.jpg';
            $data['password'] = bcrypt($request->password);
            $partner = Partner::create($data);
            if ($partner) {
                if (Auth::guard('partners')->attempt($request->only(['email', 'password']))) {
                    \Message::success('Selamat datang');
                    return to_route('partner.dashboard');
                }
            }
        } catch (\Throwable $th) {
            \Message::danger('Gagal melakukan register');
            return redirect()->back();
        }
    }

    public function handleLogin(Request $req)
    {
        if (Auth::guard('partners')->attempt($req->only(['email', 'password']))) {
            \Message::success('Selamat datang kembali');
            return to_route('partner.dashboard');
        }
        \Message::danger('Gagal, Email atau Password salah!');
        return redirect()->back();
    }
    public function logout(Request $request)
    {
        Auth::guard('partners')->logout();
        return to_route('home');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
