<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\AdminSetting;

class AdminSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$settings = AdminSetting::all();

    	return view('admin.setting.index')
    				->with('settings', $settings);
    }

    public function create()
    {
        return view('admin.setting.create');
    }

    public function store(Request $request)
    {
        $setting = new AdminSetting;
        $setting->name = $request->name;
        $setting->value = $request->value;
        $setting->save();

        return redirect('/admin/settings');
    }

    public function edit($id)
    {
        $setting = AdminSetting::find($id);

        return view('admin.setting.edit')
                ->with('setting', $setting);
    }

    public function update(Request $request, $id)
    {
      $setting = AdminSetting::find($id);
      $setting->name = $request->name;
      $setting->value = $request->value;
      $setting->save();

      return redirect('/admin/settings');
    }
}
