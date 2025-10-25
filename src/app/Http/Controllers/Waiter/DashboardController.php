<?php

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\TableLocation;

class DashboardController extends Controller
{
    
    public function __invoke(Request $request)
    {
        
        $tables = TableLocation::orderBy('table_number')->get(); 
        
        return view('waiter.dashboard', compact('tables'));
    }

    
    public function makeAvailable(TableLocation $table): RedirectResponse 
    {
        
        $table->status = 'available';
        $table->save(); 

        
        return redirect()->route('waiter.dashboard')
                         ->with('status', 'A(z) ' . $table->table_number . '. számú asztal sikeresen "Szabad" státuszra állítva.');
    }
}