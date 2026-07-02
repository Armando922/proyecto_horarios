<?php

namespace App\Http\Controllers;

use App\Models\Audit;

class AuditController extends Controller
{
    public function index()
    {
        $audits = Audit::latest()->paginate(10);

        return view('audits.index', compact('audits'));
    }
}