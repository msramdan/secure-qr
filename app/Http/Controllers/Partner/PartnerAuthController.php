<?php

namespace App\Http\Controllers\Partner;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function handleLogin(Request $req)
    {
        if (Auth::guard('partners')->attempt($req->only(['email', 'password']))) {
            \Message::success('Selamat datang kembali');
            return to_route('partner.dashboard');
        }
        \Message::danger('Gagal, Email atau Password salah!');
        return redirect()->back();
    }
    public function logout()
    {
        Auth::guard('partners')->logout();
        return to_route('home');
    }
}
