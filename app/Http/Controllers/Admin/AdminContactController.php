<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminContactController extends Controller
{
    public function index()
    {
        $contact = Contact::paginate(10);
        return Inertia::render('Admin/Kontak', ['contacts' => $contact]);
    }
}
