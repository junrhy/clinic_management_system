<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Inventory;

use Auth;
use DB;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $inventories = Inventory::select('name', DB::raw("SUM(qty) AS qty"), DB::raw("SUM(price) AS inventory_value"))
                                ->where('client_id', Auth::user()->client_id)
                                ->groupBy('name')
                                ->orderBy('name')
                                ->get();

        return view('inventory.index')
            ->with('inventories', $inventories);
    }

    public function create()
    {
        return view('inventory.create');
    }

    public function store(Request $request)
    {
        $duplicates = Inventory::where('name', $request->name)
                                ->whereNull('is_hidden')
                                ->orWhere('is_hidden', 0)
                                ->get();

        if ($duplicates->count() == 0) {
            $inventory = new Inventory;
            $inventory->client_id = Auth::user()->client_id;
            $inventory->name = $request->name;
            $inventory->qty = 0;
            $inventory->created_by = Auth::user()->name;
            $inventory->save();

            return redirect('inventory')->with('message','New inventory name '. $request->name .' successfully added!');
        } else {
            return back()->withErrors(['Inventory name already exist. You can increase (+) the quantity instead in the inventory list.']);
        }
        
    }

    public function show($name)
    {
        $inventories = Inventory::where('name', $name)
                                ->where('client_id', Auth::user()->client_id)
                                ->orderBy('created_at')
                                ->get();

        return view('inventory.show')
                    ->with('inventories', $inventories);
    }

    public function increase($name)
    {
        return view('inventory.increase')
                    ->with('name', $name);
    }
}
