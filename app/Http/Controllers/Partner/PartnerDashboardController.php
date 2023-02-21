<?php

namespace App\Http\Controllers\Partner;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ProductScanned;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PartnerDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Partner/Dashboard', [
            'dataByCity' => getBycity(),
            'dataMap' => getMapData(),
            'chartByKategori' => getByCategory(),
            'chartByBisnis' => getByBisnis(),
            'allScan' => allScan(),
            'duplicateScan' => getDuplicate()
        ]);
    }
}
