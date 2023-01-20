<?php

namespace App\Http\Controllers\Partner;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnerTypeQrcodeController extends Controller
{
    public function index()
    {
        return Inertia::render('Partner/Request/RequestQR');
    }
}
