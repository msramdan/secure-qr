<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReport;
use Illuminate\Http\Request;
use Inertia\Inertia;
use PhpParser\Node\Stmt\Return_;

class AdminReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission::customer_data_show')->only('index');
    }
    public function index(Request $request)
    {
        $paginate = $request->get('paginate') ?? 10;
        $report = ProductReport::join('qr_codes', 'product_reports.qr_code_id', '=', 'qr_codes.id')
            ->when($request->input('search'), function ($query, $search) {
                $query->where('product_reports.fullname', 'like', "%{$search}%")
                    ->orWhere('product_reports.phone_number', 'like', "%{$search}%")
                    ->orWhere('product_reports.kronologi', 'like', "%{$search}%")
                    ->orWhere('qr_codes.serial_number', 'like', "%{$search}%");
            })->paginate($paginate)
            ->withQueryString();
        return Inertia::render('Admin/Report', [
            'reports' => $report,
            'filters' => $request->only(['search'])
        ]);
    }
}
