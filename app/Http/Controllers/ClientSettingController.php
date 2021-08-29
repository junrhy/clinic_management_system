<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\ClientSettings;

use Auth;

class ClientSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $settings = ClientSettings::all();

        return view('settings.index')
                    ->with('settings', $settings);
    }

    public function set_setting(Request $request)
    {
        $setting = ClientSettings::where('name', $request->name)->first();

        $isCheck = $request->is_check == 'true' ? true : false;

        if ($isCheck) {
            $setting = new ClientSettings;
            $setting->client_id = Auth::user()->client_id;
            $setting->name = $request->name;
            $setting->value = $request->value;
            $setting->save();
        } else {
            $setting->delete();
        }
    }
}
