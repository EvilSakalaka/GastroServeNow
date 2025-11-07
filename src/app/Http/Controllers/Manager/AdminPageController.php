<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\manager\WorkerAddRequest;
use App\Http\Requests\manager\WorkerEditRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminPageController extends Controller
{
    #region Show Pages
    public function showWorkersPage(Request $request)
    {
        \Log::info('Dolgozók oldal megtekintve');
        $workers = User::all();
        return view('manager.workers', ['workers' => $workers]);
    }

    public function showItemsPage(Request $request)
    {
        return view('manager.items');
    }
    public function showTipPage(Request $request)
    {
        return view('manager.tip');
    }
    #endregion
    public function addWorker(WorkerAddRequest $request)
    {
        if ($request->validated()) {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ]);
        }
        return redirect()->route('manager.workers_page');
    }

    public function editWorker(WorkerEditRequest $request)
    {
        
        if ($request->validated()) {
            $worker = User::find($request->worker_id);
            $worker->name = $request->name;
            $worker->username = $request->username;
            if ($request->password != null && $request->password != '') {
                $worker->password = bcrypt($request->password);
            }
            $worker->role = $request->role;
            $worker->status = $request->status;
            $worker->save();
        } else {
            \Log::warning('Validáció sikertelen');
        }
        return redirect()->route('manager.workers_page');
    }

    public function deleteWorker(Request $request)
    {
        \Log::info('Dolgozó törlés indítva',['worker_id' => $request->worker_id]);
        $worker = User::find($request->worker_id);
        if ($worker) {
            \Log::info('Dolgozó törölve: ' . $worker->username);
            $worker->delete();
        }
        return redirect()->route('manager.workers_page');
    }
    public function __invoke(Request $request)
    {
        return view('manager.dashboard');
    }
}
