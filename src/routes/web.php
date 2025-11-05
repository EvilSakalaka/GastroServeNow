<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Waiter\DashboardController as WaiterDashboard;
use App\Http\Controllers\Chef\DashboardController as ChefDashboard;
use App\Http\Controllers\Bartender\DashboardController as BartenderDashboard;
use App\Http\Controllers\Manager\AdminPageController as ManagerAdminPage;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Waiter\OrderController;

Route::get('/', function () {
    if (Auth::guest()) {
        return redirect()->route('login');
    }
    return redirect()->route('dashboard');
});

//Route::get('/dashboard', function () {
//   return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    $role = Auth::user()->role;

    if ($role == 'manager') {
        return redirect()->route('manager.admin_page');
    }
    if ($role == 'waiter') {
        return redirect()->route('waiter.dashboard');
    }
    if ($role == 'chef') {
        return redirect()->route('chef.dashboard');
    }
    if ($role == 'bartender') {
        return redirect()->route('bartender.dashboard');
    }
    // alap esetben a sima dashboard oldalat jeleníti meg, ilyen elv nem kellene hogy legyen
    return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    // A PINCÉR oldala (Csak 'waiter' ÉS 'manager' láthatja)
    Route::get('/waiter/dashboard', WaiterDashboard::class)
        ->middleware('role:waiter,manager')
        ->name('waiter.dashboard');

    //Státusz módosítás pincérnek
    Route::patch('/waiter/tables/{table}/make-available', [WaiterDashboard::class, 'makeAvailable'])
        ->middleware('role:waiter,manager')
        ->name('waiter.tables.makeAvailable');
    // ======================

    // A SZAKÁCS oldala (Csak 'chef' ÉS 'manager' láthatja)
    Route::get('/chef/dashboard', ChefDashboard::class)
        ->middleware('role:chef,manager')
        ->name('chef.dashboard');

    // A PULTOS oldala (Csak 'bartender' ÉS 'manager' láthatja)
    Route::get('/bartender/dashboard', BartenderDashboard::class)
        ->middleware('role:bartender,manager')
        ->name('bartender.dashboard');

    // A MANAGER admin oldala (CSAK 'manager' láthatja)
    Route::prefix('manager')->group(function () {

        Route::get('/', ManagerAdminPage::class)->name('manager.admin_page');
        Route::get('items', [ManagerAdminPage::class, 'showItemsPage'])->name('manager.items_page');
        Route::get('tip', [ManagerAdminPage::class, 'showTipPage'])->name('manager.tip_page');
        Route::get('workers', [ManagerAdminPage::class, 'showWorkersPage'])->name('manager.workers_page');

        Route::post('add-worker', [ManagerAdminPage::class, 'addWorker'])->name('manager.add_worker');
        Route::patch('edit-worker', [ManagerAdminPage::class, 'editWorker'])->name('manager.edit_worker');
        Route::delete('delete-worker', [ManagerAdminPage::class, 'deleteWorker'])->name('manager.delete_worker');

    
        
    })->middleware('role:manager');
    
        Route::patch('/waiter/tables/{table}/make-reserved', [WaiterDashboard::class, 'makeReserved'])
        ->middleware('role:waiter,manager')
        ->name('waiter.tables.makeReserved');
    // Új útvonal a "Felszolgálás" (occupied) állapothoz.
    Route::patch('/waiter/tables/{table}/make-occupied', [WaiterDashboard::class, 'makeOccupied'])
        ->middleware('role:waiter,manager')
        ->name('waiter.tables.makeOccupied');
    // 1. GET: Megjeleníti a rendelésfelvételi oldalt
    Route::get('/waiter/orders/create/{guest_session}', [OrderController::class, 'create'])
        ->middleware('role:waiter,manager')
        ->name('waiter.orders.create');
        // 2. POST: Elmenti az új rendelést az adatbázisba
    Route::post('/waiter/orders', [OrderController::class, 'store'])
        ->middleware('role:waiter,manager')
        ->name('waiter.orders.store');
        //befejezett rendelés.
     Route::get('/waiter/orders/success/{order}', [OrderController::class, 'showSuccess'])
    ->middleware('role:waiter,manager')
    ->name('waiter.orders.success');
    

        
});

require __DIR__.'/auth.php';