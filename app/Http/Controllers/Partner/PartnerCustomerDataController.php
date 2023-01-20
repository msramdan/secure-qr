<?php

namespace App\Http\Controllers\Partner;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnerCustomerDataController extends Controller
{
    public function index()
    {
        return Inertia::render('Partner/CustomerData/CustomerData');
    }
    public function show(Request $request)
    {
    }
    public function update(Request $request)
    {
    }
}
