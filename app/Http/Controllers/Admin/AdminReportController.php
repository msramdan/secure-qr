<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use PhpParser\Node\Stmt\Return_;

class AdminReportController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Report');
    }
}
