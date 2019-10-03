<?php

namespace App\Http\Controllers\Auth;

use App\Model\Client;
use App\Model\Clinic;
use App\Model\Doctor;
use App\Model\AdminSetting;
use App\User;

use App\Mail\NewClient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $admin_setting = AdminSetting::where('name', 'allow_new_registration')->first();
        $allow_new_registration = (boolean) $admin_setting->value;

        if (!$allow_new_registration) {
            return abort(404, 'New registrations is disabled. Please contact admin for details.');
        }

        $client = new Client;
        $client->name  = $data['name'];
        $client->email = $data['email'];
        $client->save();

        $user = User::create([
            'client_id'=> $client->id,
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $clinic = new Clinic;
        $clinic->client_id = $client->id;
        $clinic->name = $client->name . ' Clinic';
        $clinic->address = null;
        $clinic->save();

        $doctor = new Doctor;
        $doctor->client_id = $client->id;
        $doctor->name = $client->name;
        $doctor->save();

      // Mail::to($data['email'])->send(new NewClient());

        return $user;
    }
}
