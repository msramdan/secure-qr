<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission::customer_data_show')->only('index');
    }
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $contact = Contact::when($request->input('search'), function ($query, $search) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('telepon', 'like', "%{$search}%")
                ->orWhere('perusahaan', 'like', "%{$search}%")
                ->orWhere('industri', 'like', "%{$search}%")
                ->orWhere('informasi', 'like', "%{$search}%");
        })->paginate($paginate)
            ->withQueryString()
            ->through(fn ($cont) => [
                'id' => $cont->id,
                'nama' => $cont->nama,
                'email' => $cont->email,
                'telepon' => $cont->telepon,
                'perusahaan' => $cont->perusahaan,
                'industri' => $cont->industri,
                'informasi' => $cont->informasi,
            ]);
        return Inertia::render('Admin/Kontak', [
            'contacts' => $contact,
            'filters' => $request->only(['search'])
        ]);
    }
}
