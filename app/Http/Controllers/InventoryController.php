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
        $inventory = new Inventory;
        $inventory->client_id = Auth::user()->client_id;
        $inventory->name = $request->name;
        $inventory->qty = $request->qty;
        $inventory->price = $request->price;
        $inventory->expire_at = $request->expire_at != '' ? date('Y-m-d', strtotime($request->expire_at)) : null;
        $inventory->location = $request->location;
        $inventory->created_by = Auth::user()->name;
        $inventory->save();

        return redirect('inventory')->with('message', $request->qty . ' x '. $request->name .' successfully added!');
    }

    public function show($name)
    {
        $inventories = Inventory::where('name', $name)
                                ->where('client_id', Auth::user()->client_id)
                                ->whereNull('is_hidden')
                                ->orWhere('is_hidden', 0)
                                ->orderBy('created_at', 'DESC')
                                ->get();

        return view('inventory.show')
                    ->with('name', $name)
                    ->with('inventories', $inventories);
    }

    public function add_by_sku($name)
    {
        return view('inventory.add_by_sku')
                    ->with('name', $name);
    }

    public function inventory_in_store(Request $request)
    {
        for ($i=0; $i < count($request->sku); $i++) { 
            $inventory = new Inventory;
            $inventory->client_id = Auth::user()->client_id;
            $inventory->name = $request->inventory_name;
            $inventory->sku = $request->sku[$i];
            $inventory->qty = $request->qty[$i];
            $inventory->price = $request->price[$i];
            $inventory->expire_at = $request->expire_at != '' ? date('Y-m-d', strtotime($request->expire_at[$i])) : null;
            $inventory->location = $request->location[$i];
            $inventory->created_by = Auth::user()->name;
            $inventory->save();
        }

        return redirect('inventory')->with('message','New '. $request->inventory_name .'has been added successfully.');
    }
}
