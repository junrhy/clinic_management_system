<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\FeatureUser;

class AdminFeatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $features = FeatureUser::all();

        return view('admin.feature.index')
                ->with('features', $features);
    }

    public function create()
    {
        return view('admin.feature.create');
    }

    public function store(Request $request)
    {
        $feature = new FeatureUser;
        $feature->name = $request->name;
        $feature->parent_id = $request->parent_id;
        $feature->order = $request->order;
        $feature->save();

        return redirect('/admin/features');
    }

    public function edit($id)
    {
        $feature = FeatureUser::find($id);

        return view('admin.feature.edit')
                ->with('feature', $feature);
    }

    public function update(Request $request, $id)
    {
        $feature = FeatureUser::find($id);
        $feature->parent_id = $request->parent_id;
        $feature->order = $request->order;
        $feature->save();

        return redirect('/admin/features');
    }
}
