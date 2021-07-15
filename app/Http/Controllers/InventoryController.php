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

    public function index(Request $request)
    {
        if (Auth::user()->client->account_type == 'free') {
            return redirect('home');
        }

        $inventories = Inventory::select('name', DB::raw("SUM(qty) AS qty"), DB::raw("SUM(price) AS inventory_value"))
                                ->where('client_id', Auth::user()->client_id)
                                ->where('name', 'like', $request->namelist . '%')
                                ->whereNull('is_hidden')
                                ->orWhere('is_hidden', 0)
                                ->groupBy('name')
                                ->orderBy('name')
                                ->paginate(30);

        return view('inventory.index')
            ->with('inventories', $inventories)
            ->with('namelist', $request->namelist);
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
        $inventory->sku = $request->sku;
        $inventory->qty = $request->qty;
        $inventory->price = $request->price;
        $inventory->expire_at = $request->expire_at != '' ? date('Y-m-d', strtotime($request->expire_at)) : null;
        $inventory->location = $request->location;
        $inventory->created_by = Auth::user()->name;
        $inventory->save();

        return redirect('inventory')->with('message', $request->qty . ' x '. $request->name .' successfully added!');
    }

    public function show($name, Request $request)
    {
        $inventories = Inventory::where('name', $name)
                                ->where('client_id', Auth::user()->client_id)
                                ->whereNull('is_hidden')
                                ->orWhere('is_hidden', 0)
                                ->orderBy('created_at', 'ASC')
                                ->get();

        if (isset($request->sku) || $request->sku == "n/a") {
            $sku = $request->sku != "n/a" ? $request->sku : "";

            $output_inventories = $inventories->where('sku', $sku);
        } else {
            $output_inventories = $inventories;
        }

        return view('inventory.show')
                    ->with('name', $name)
                    ->with('inventories', $output_inventories);
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
            $inventory->expire_at = $request->expire_at[$i] != '' ? date('Y-m-d', strtotime($request->expire_at[$i])) : null;
            $inventory->location = $request->location[$i];
            $inventory->created_by = Auth::user()->name;
            $inventory->save();
        }

        return redirect('inventory')->with('message','New '. $request->inventory_name .' has been added successfully.');
    }

    public function inventory_out($name, Request $request)
    {
        $inventories = Inventory::select(
                                    DB::raw('MAX(name) as name'),
                                    'sku', 
                                    DB::raw('SUM(qty) as qty'),
                                    DB::raw('MAX(price) as price'),
                                    DB::raw('MAX(expire_at) as expire_at'),
                                    DB::raw('MAX(location) as location')
                                )
                                ->where('name', $name)
                                ->where('client_id', Auth::user()->client_id)
                                ->whereNull('is_hidden')
                                ->orWhere('is_hidden', 0)
                                ->orderBy('sku', 'ASC')
                                ->groupBy(['sku', 'price', 'expire_at', 'location'])
                                ->get();
        
        if (isset($request->sku) || $request->sku == "n/a") {
            $sku = $request->sku != "n/a" ? $request->sku : "";

            $output_inventories = $inventories->where('sku', $sku);
        } else {
            $output_inventories = $inventories;
        }

        return view('inventory.inventory_out')
                    ->with('name', $name)
                    ->with('inventories', $output_inventories->where('qty', '!=', 0));
    }

    public function inv_out_search(Request $request)
    {
        $name = $request->name;
        $keyword = $request->keyword;
        
        $multiple_keyword = explode(' ', $request->keyword);


        $inventories = Inventory::select(
                                    DB::raw('MAX(name) as name'),
                                    'sku', 
                                    DB::raw('SUM(qty) as qty'),
                                    DB::raw('MAX(price) as price'),
                                    DB::raw('MAX(expire_at) as expire_at'),
                                    DB::raw('MAX(location) as location')
                                )
                                ->where('name', $name)
                                ->whereIn('sku', $multiple_keyword)
                                ->orWhere('sku', 'like', '%' . $keyword . '%')
                                ->where('client_id', Auth::user()->client_id)
                                ->whereNull('is_hidden')
                                ->orWhere('is_hidden', 0)
                                ->orderBy('sku', 'ASC')
                                ->groupBy(['sku', 'price', 'expire_at', 'location'])
                                ->get();

        if (empty($keyword)) {
            $inventories = Inventory::select(
                                    DB::raw('MAX(name) as name'),
                                    'sku', 
                                    DB::raw('SUM(qty) as qty'),
                                    DB::raw('MAX(price) as price'),
                                    DB::raw('MAX(expire_at) as expire_at'),
                                    DB::raw('MAX(location) as location')
                                )
                                ->where('name', $name)
                                ->where('client_id', Auth::user()->client_id)
                                ->whereNull('is_hidden')
                                ->orWhere('is_hidden', 0)
                                ->orderBy('sku', 'ASC')
                                ->groupBy(['sku', 'price', 'expire_at', 'location'])
                                ->get();
        }

        if ($keyword == "n/a") {
            $inventories = Inventory::select(
                                    DB::raw('MAX(name) as name'),
                                    'sku', 
                                    DB::raw('SUM(qty) as qty'),
                                    DB::raw('MAX(price) as price'),
                                    DB::raw('MAX(expire_at) as expire_at'),
                                    DB::raw('MAX(location) as location')
                                )
                                ->where('name', $name)
                                ->where('client_id', Auth::user()->client_id)
                                ->whereNull('is_hidden')
                                ->orWhere('is_hidden', 0)
                                ->orderBy('sku', 'ASC')
                                ->groupBy(['sku', 'price', 'expire_at', 'location'])
                                ->get();

            $output_inventories = $inventories->where('sku', "");
        } else {
            $output_inventories = $inventories;
        }

        return view('inventory._inv_out_table_data')
                ->with('name', $name)
                ->with('inventories', $output_inventories->where('qty', '!=', 0));
    }

    public function inventory_out_update(Request $request)
    {
        $inventory = new Inventory;
        $inventory->client_id = Auth::user()->client_id;
        $inventory->status = 'OUT';
        $inventory->name = $request->name;
        $inventory->sku = $request->sku;
        $inventory->qty = $request->qty * -1; // save as negative value
        $inventory->price = $request->price;
        $inventory->expire_at = $request->expire_at != '' ? date('Y-m-d', strtotime($request->expire_at)) : null;
        $inventory->location = $request->location;
        $inventory->created_by = Auth::user()->name;
        $inventory->save();
    }

    public function hide_inventory(Request $request)
    {
        $inventory = Inventory::where('name', $request->name)
                            ->where('client_id', Auth::user()->client_id)
                            ->update(['is_hidden' => 1]);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        
        $multiple_keyword = explode(' ', $request->keyword);

        $inventories = Inventory::select('name', DB::raw("SUM(qty) AS qty"), DB::raw("SUM(price) AS inventory_value"))
                            ->where('client_id', Auth::user()->client_id)
                            ->whereIn('name', $multiple_keyword)
                            ->orWhere('name', 'like', '%' . $keyword . '%')
                            ->whereNull('is_hidden')
                            ->orWhere('is_hidden', 0)
                            ->groupBy('name')
                            ->orderBy('name')
                            ->paginate(30);

        return view('inventory._table_data')
              ->with('inventories', $inventories);
    }
}
