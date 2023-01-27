<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PartnerRequestQrcodeController extends Controller
{
    public function index()
    {
        return Inertia::render('Partner/Request/RequestQR');
    }
}
