<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Model\FeatureUser;

use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where('client_id', Auth::user()->client_id)->where('type', 'default')->get();

        return view('user.index')
              ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user = new User();
        $user->client_id = Auth::user()->client_id;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        
        $features = FeatureUser::all();

        return view('user.show')
                ->with('user', $user)
                ->with('features', $features);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit')
                ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        $password = isset($request->password) ? $request->password : null;
        if ($password)
          $user->password = bcrypt($password);

        $user->save();

        return redirect('user');
    }

    public function update_privilege(Request $request, $id)
    {
        $user_id = $id;


        foreach($request->user_features as $key => $feature){
            $feature_id = $feature['feature_id'];

            $UserFeature = FeatureUser::find($feature_id);

            if ($UserFeature != null) {
                $user_ids = array_map('intval', explode(',', $UserFeature->user_ids));

                if ($feature['is_checked'] == "false") {
                    if (($key = array_search($user_id, $user_ids)) !== false) {
                        unset($user_ids[$key]);
                    }
                } elseif ($feature['is_checked'] == "true") {
                    if (($key = array_search($user_id, $user_ids)) !== false) {
                        // do nothing
                    } else {
                        array_push($user_ids, $user_id);
                    }
                }

                if (($key = array_search(0, $user_ids)) !== false) {
                    unset($user_ids[$key]);
                }

                sort($user_ids);

                $UserFeature->user_ids = implode(',', $user_ids);
                $UserFeature->save();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->forceDelete();
    }
}
