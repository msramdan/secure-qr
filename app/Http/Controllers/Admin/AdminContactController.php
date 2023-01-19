<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminContactController extends Controller
{
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $contact = Contact::when($request->input('search'), function ($query, $search) {
            $query->where('nama_lengkap', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('subjek', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        })->paginate($paginate)
            ->withQueryString()
            ->through(fn ($cont) => [
                'id' => $cont->id,
                'nama_lengkap' => $cont->nama_lengkap,
                'email' => $cont->email,
                'subjek' => $cont->subjek,
                'deskripsi' => $cont->deskripsi,
            ]);
        return Inertia::render('Admin/Kontak', [
            'contacts' => $contact,
            'filters' => $request->only(['search'])
        ]);
    }
}
