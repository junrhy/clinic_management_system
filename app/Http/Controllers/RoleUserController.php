<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Model\Role;
use App\Model\RoleUser;

use Auth;

class RoleUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $roles = $roles = Role::where('client_id', Auth::user()->client_id)->get();
      $users = User::where('client_id', Auth::user()->client_id)->get();

      return view('role_member.index')
            ->with('users', $users)
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role_user = RoleUser::where('user_id', $request->user_id)
                            ->where('role_id', $request->role_id)
                            ->first();

        if ($role_user) {
          $status = "User already exist!";
        } else {
          $role_user = new RoleUser;
          $role_user->role_id = $request->role_id;
          $role_user->user_id = $request->user_id;
          $role_user->save();

          $status = "User successfully added!";
        }

        return redirect('users/role_members/'.$request->role_id)->with('status', $status);;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);

        $users = User::where('client_id', Auth::user()->client_id)->get()->pluck('name', 'id');

        return view('role_member.show')
              ->with('role', $role)
              ->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user_id = $id;

        $role_user = RoleUser::where('user_id', $user_id)
                            ->where('role_id', $request->role_id)
                            ->first();

        $role_user->delete();

        return redirect('users/role_members/'.$request->role_id);
    }
}
