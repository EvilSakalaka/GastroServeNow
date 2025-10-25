<?php

namespace App\Http\Controllers\Bartender;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
{
    return view('bartender.dashboard');
}
}
