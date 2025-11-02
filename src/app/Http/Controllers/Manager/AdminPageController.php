<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function workersPage(Request $request)
    {
        $workers = User::all();
        return view('manager.workers', ['workers' => $workers]);
    }

    public function itemsPage(Request $request)
    {
        return view('manager.items');
    }
    public function tipPage(Request $request)
    {
        return view('manager.tip');
    }

    public function addWorker(Request $request)
    {
        
    }
    public function __invoke(Request $request)
    {
        return view('manager.dashboard');
    }
}
