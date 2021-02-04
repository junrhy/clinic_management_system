<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\BillingStatement;

class AdminBillingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$billings = BillingStatement::all();

    	return view('admin.billing.index')
    				->with('billings', $billings);
    }
}
