<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReport;
use Illuminate\Http\Request;
use Inertia\Inertia;
use PhpParser\Node\Stmt\Return_;

class AdminReportController extends Controller
{
    public function index()
    {
        $report = ProductReport::join('qr_codes', 'product_reports.qr_code_id', '=', 'qr_codes.id')->paginate(10);
        return Inertia::render('Admin/Report', ['reports' => $report]);
    }
}
