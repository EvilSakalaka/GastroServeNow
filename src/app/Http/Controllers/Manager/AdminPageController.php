<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\manager\ProductAddRequest;
use App\Http\Requests\manager\ProductEditRequest;
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
        $areas = \App\Models\Area::all();
        $allergens = \App\Models\Allergen::all();
        $products = \App\Models\Product::with('area')->orderBy('is_featured', 'desc')->orderBy('name', 'asc')->get();
        return view('manager.items', ['areas' => $areas, 'products' => $products, 'allergens' => $allergens]);
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

    public function addProduct(ProductAddRequest $request)
    {
        \Log::info('Termék hozzáadás indítva', ['name' => $request->name]);
        if ($request->validated()) {
            \Log::info('Új termék hozzáadva: ' . $request->name);
            \App\Models\Product::create([
                'name' => $request->name,
                'category' => $request->category,
                'price' => $request->price,
                'status' => $request->status,
                'photo_url' => $request->photo_url,
                'is_featured' => $request->is_featured ?? false,
                'area_id' => $request->area_id,
            ]);
        }
        return redirect()->route('manager.items_page');
    }

    public function editProduct(ProductEditRequest $request)
    {
        \Log::info('Termék szerkesztés indítva', $request->all());
        if ($request->validated()) {
            $product = \App\Models\Product::find($request->product_id);
            $product->name = $request->name;
            $product->category = $request->category;
            $product->price = $request->price;
            $product->status = $request->status;
            $product->photo_url = $request->photo_url;
            $product->is_featured = $request->is_featured ?? false;
            $product->area_id = $request->area_id;
            $product->allergens()->sync($request->allergens ?? []);
            $product->save();
        }
        return redirect()->route('manager.items_page');
    }

    public function deleteProduct(Request $request)
    {
        //\Log::info('Termék törlés indítva', ['product_id' => $request->product_id]);
        $product = \App\Models\Product::find($request->product_id);
        if ($product) {
            \Log::info('Termék törölve: ' . $product->name);
            $product->delete();
        }
        return redirect()->route('manager.items_page');
    }
}
