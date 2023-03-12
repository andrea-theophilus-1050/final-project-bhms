<?php

namespace App\Http\Controllers\TenantRole;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HandleTenantController extends Controller
{
    public function index()
    {
        return view('tenants-pages.index')->with('title', 'Tenant Dashboard');
    }
}
