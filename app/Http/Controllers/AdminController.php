<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        Log::info('AdminController: Rendering admin.dashboard');
        return view('admin.dashboard');
    }
}
