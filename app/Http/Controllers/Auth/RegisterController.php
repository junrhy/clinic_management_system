<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Model\Client;
use App\Model\Clinic;
use App\Model\Doctor;
use App\Model\AdminSetting;
use App\Model\FeatureUser;
use App\User;

use App\Mail\NewClient;

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
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:255',
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
        $client->contact = $data['contact'];
        $client->save();

        $user = User::create([
            'client_id' => $client->id,
            'first_name'=> $data['first_name'],
            'last_name' => $data['last_name'],
            'username'  => $data['username'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'type'      => User::DEFAULT_TYPE,
            'is_client' => true,
        ]);

        $features = FeatureUser::all();
        $features->each(function ($feature, $key) use ($user) {
            $feature = FeatureUser::find($feature->id);

            $user_ids = array_map('intval', explode(',', $feature->user_ids));

            sort($user_ids);
            
            array_push($user_ids, $user['id']);

            if (($key = array_search(0, $user_ids)) !== false) {
                unset($user_ids[$key]);
            }

            $feature->user_ids = implode(',', $user_ids);
            $feature->save();
        });

      // Mail::to($data['email'])->send(new NewClient());

        return $user;
    }
}
