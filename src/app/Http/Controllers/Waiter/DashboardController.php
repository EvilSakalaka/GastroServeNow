<?php

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\TableLocation;
use App\Models\GuestSession;   
use Illuminate\Support\Str;


class DashboardController extends Controller
{
    
    public function __invoke(Request $request)
    {
        
        $tables = TableLocation::where('active', 1)
                               ->orderBy('table_number')
                               ->get(); 
        
        return view('waiter.dashboard', compact('tables'));
    }

    
    public function makeAvailable(TableLocation $table): RedirectResponse 
    {
        
        $table->status = 'available';
        $table->save(); 

        
        return redirect()->route('waiter.dashboard')
                         ->with('status', 'A(z) ' . $table->table_number . '. számú asztal sikeresen "Szabad" státuszra állítva.');
    }
    
    public function makeReserved(TableLocation $table): RedirectResponse
    {
        $table->status = 'reserved';
        $table->save();
        return redirect()->route('waiter.dashboard')
                         ->with('status', 'A(z) ' . $table->table_number . '. számú asztal sikeresen "Foglalva" státuszra állítva.');
    }

    public function makeOccupied(TableLocation $table): RedirectResponse
    {
       
        $table->status = 'occupied';
        $table->save();
        
       
        $session = GuestSession::create([
            'table_number' => $table->table_number,
            'session_token' => Str::random(40), 
            'started_at' => now(),
            'active' => 1
        ]);

        return redirect()->route('waiter.orders.create', $session);
        
    }

}
