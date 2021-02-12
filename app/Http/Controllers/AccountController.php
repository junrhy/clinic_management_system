<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Hash;

use App\User;
use App\Model\Client;
use App\Model\Patient;

use Auth;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function business_information()
    {
        $client = auth()->user()->client;

        return view('account.business_information')->with('client', $client);
    }

    public function update_business_information(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $client = Client::find($request->id);
        $client->name = $request->name;
        $client->email = $request->email;
        $client->contact = $request->contact;

        // begin upload logo
        $FILESYSTEM_DRIVER = env('FILESYSTEM_DRIVER', 'local');

        $file = $request->file('attachment');

        if(!empty($file)):
            $folder_name = 'company_logo';
            $directory = 'client' . Auth::user()->client_id .'/' . $folder_name;

            Storage::disk($FILESYSTEM_DRIVER)->deleteDirectory($directory);
            Storage::disk($FILESYSTEM_DRIVER)->makeDirectory($directory);

            try {
                Storage::disk($FILESYSTEM_DRIVER)->put($directory . '/' . $file->getClientOriginalName(), file_get_contents($file), 'public');
            } catch (Exception $e) {
                dd($e);
            }

            $client->logo = $directory . '/' . $file->getClientOriginalName();
        endif;
        // end upload
        
        $client->save();
        
        return back()->with('success','Profile successfully updated!');
    }

    public function delete_company_logo($id)
    {
        $client = Client::find($id);
        $client->logo = null;
        $client->save();

        $folder_name = 'company_logo';
        $directory = 'client' . Auth::user()->client_id .'/' . $folder_name;

        $FILESYSTEM_DRIVER = env('FILESYSTEM_DRIVER', 'local');
        Storage::disk($FILESYSTEM_DRIVER)->deleteDirectory($directory);

        return back()->with('success','Company logo successfully deleted!');
    }

    public function change_password()
    {
    	$username = auth()->user()->username;

        return view('account.change_password')->with('username', $username);
    }

    public function update_password(Request $request)
    {
    	$request->validate([
		    'new_password' => ['required', 'string', 'max:255', 'alpha_dash']
		]);


    	$user = User::where('username', $request->username)->first();

    	if(!Hash::check($request->password, $user->password)){
	        return back()->withErrors('The password you have entered does not match your current one.');
	    }else{
	        $user->password = Hash::make($request->new_password);
      		$user->save();

      		return back()->with('success','Password successfully changed!');
	    }
    }

    public function success(Request $request)
    {
        // $client = Client::find(Auth::user()->client_id);
        // $client->account_type = 'business';
        // $client->save();

        return view('account.success');
    }

    public function failed()
    {
        return view('account.failed');
    }
}
