<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Waiter\DashboardController as WaiterDashboard;
use App\Http\Controllers\Chef\DashboardController as ChefDashboard;
use App\Http\Controllers\Bartender\DashboardController as BartenderDashboard;
use App\Http\Controllers\Manager\AdminPageController as ManagerAdminPage;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    if (Auth::guest()) {
        return redirect()->route('login');
    }
    return redirect()->route('dashboard');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
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

    // A SZAKÁCS oldala (Csak 'chef' ÉS 'manager' láthatja)
    Route::get('/chef/dashboard', ChefDashboard::class)
        ->middleware('role:chef,manager')
        ->name('chef.dashboard');

    // A PULTOS oldala (Csak 'bartender' ÉS 'manager' láthatja)
    Route::get('/bartender/dashboard', BartenderDashboard::class)
        ->middleware('role:bartender,manager')
        ->name('bartender.dashboard');

    // A MANAGER admin oldala (CSAK 'manager' láthatja)
    Route::get('/manager/admin', ManagerAdminPage::class)
        ->middleware('role:manager')
        ->name('manager.admin_page');

});

require __DIR__.'/auth.php';
