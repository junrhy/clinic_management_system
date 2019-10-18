<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DentalChartController extends Controller
{
    public function __construct()
	{
	    $this->middleware('auth');
	}

	public function index()
	{
		return view('dentalchart.index');
	}

    public function store(Request $request)
    {
    	
        $dentalchart = new DentalChart;
        $dentalchart->client_id = Auth::user()->client_id;
        $dentalchart->patient_id = $request->patient_id;
       
        $dentalchart->upper_jaw = '{"root":[{"11":"11_root.gif","12":"12_root.gif","13":"13_root.gif","14":"14_root.gif","15":"15_root.gif","16":"18_root.gif","17":"17_root.gif","18":"18_root.gif","21":"21_root.gif","22":"22_root.gif","23":"23_root.gif","24":"24_root.gif","25":"25_root.gif","26":"26_root.gif","27":"27_root.gif","28":"28_root.gif"}],"crown":[{"11":"11_crown.gif","12":"12_crown.gif","13":"13_crown.gif","14":"14_crown.gif","15":"15_crown.gif","16":"18_crown.gif","17":"17_crown.gif","18":"18_crown.gif","21":"21_crown.gif","22":"22_crown.gif","23":"23_crown.gif","24":"24_crown.gif","25":"25_crown.gif","26":"26_crown.gif","27":"27_crown.gif","28":"28_crown.gif"}],"filling":[{"11":"fff,fff,fff,fff,fff","12":"fff,fff,fff,fff,fff","13":"fff,fff,fff,fff,fff","14":"fff,fff,fff,fff,fff","15":"fff,fff,fff,fff,fff","16":"fff,fff,fff,fff,fff","17":"fff,fff,fff,fff,fff","18":"fff,fff,fff,fff,fff","21":"fff,fff,fff,fff,fff","22":"fff,fff,fff,fff,fff","23":"fff,fff,fff,fff,fff","24":"fff,fff,fff,fff,fff","25":"fff,fff,fff,fff,fff","26":"fff,fff,fff,fff,fff","27":"fff,fff,fff,fff,fff","28":"fff,fff,fff,fff,fff"}]}';
        
        $dentalchart->lower_jaw = '{"root":[{"31":"31_root.gif","32":"32_root.gif","33":"33_root.gif","34":"34_root.gif","35":"35_root.gif","36":"36_root.gif","37":"37_root.gif","38":"38_root.gif","41":"41_root.gif","42":"42_root.gif","43":"43_root.gif","44":"44_root.gif","45":"45_root.gif","46":"48_root.gif","47":"47_root.gif","48":"48_root.gif"}],"crown":[{"31":"31_crown.gif","32":"32_crown.gif","33":"33_crown.gif","34":"34_crown.gif","35":"35_crown.gif","36":"36_crown.gif","37":"37_crown.gif","38":"38_crown.gif","41":"41_crown.gif","42":"42_crown.gif","43":"43_crown.gif","44":"44_crown.gif","45":"45_crown.gif","46":"48_crown.gif","47":"47_crown.gif","48":"48_crown.gif"}],"filling":[{"31":"fff,fff,fff,fff,fff","32":"fff,fff,fff,fff,fff","33":"fff,fff,fff,fff,fff","34":"fff,fff,fff,fff,fff","35":"fff,fff,fff,fff,fff","36":"fff,fff,fff,fff,fff","37":"fff,fff,fff,fff,fff","38":"fff,fff,fff,fff,fff","41":"fff,fff,fff,fff,fff","42":"fff,fff,fff,fff,fff","43":"fff,fff,fff,fff,fff","44":"fff,fff,fff,fff,fff","45":"fff,fff,fff,fff,fff","46":"fff,fff,fff,fff,fff","47":"fff,fff,fff,fff,fff","48":"fff,fff,fff,fff,fff"}]}';
       
        $dentalchart->save();
    }
}
