<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Role;

use App\User;

use Auth;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = User::where('client_id', Auth::user()->client_id)->get();

        return view('staff.index')
              ->with('staffs', $staffs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role_default = Role::where('name', 'Staff User')->first();

        $staff = new User();
        $staff->client_id = Auth::user()->client_id;
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->password = bcrypt($request->password);
        $staff->save();
        $staff->roles()->attach($role_default);

        return redirect('client/staff');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = User::find($id);

        return view('staff.show')
                ->with('staff', $staff);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = User::find($id);

        return view('staff.edit')
                ->with('staff', $staff);
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
        $staff = User::find($id);
        $staff->name = $request->name;
        $staff->email = $request->email;

        $password = isset($request->password) ? $request->password : null;
        if ($password)
          $staff->password = bcrypt($password);

        $staff->save();

        return redirect('client/staff');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role_users = RoleUser::where('user_id', $id)->get();

        foreach ($role_users as $role_user_key => $role_user) {
          $role_user->delete();
        }

        $staff = User::find($id);
        $staff->delete();

        return redirect('client/staff');
    }
}
