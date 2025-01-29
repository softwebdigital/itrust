<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Validator;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'phone' => ['required', 'string'],
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'ssn' => 'required',
            'dob' => 'required',
            'nationality' => ['required', 'string'],
            'currency_id' => 'required',
            'experience' => ['required', 'string'],
            'employment' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'ssn.required' => 'This field is required',
            'dob.required' => 'This field is required',
            'q1.required' => 'Please provide an answer',
            'q2.required' => 'Please provide an answer',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $mailBody = '<p>You have a new user by the name <b>' . $data['first_name'] . ' ' . $data['last_name'] . '</b>.</p>';

        $admin = new User;
        $admin['email'] = env('TRANX_EMAIL');
        $adminMail = [
            'subject' => 'New User',
            'body' => $mailBody
        ];
        
        MailController::sendTransactionNotificationToAdmin($admin, $adminMail);
        
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'phone' => $data['phone_code'].$data['phone'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'zip_code' => $data['zip_code'],
            'ssn' => $data['ssn'],
            'dob' => $data['dob'],
            'nationality' => $data['nationality'],
            'currency_id' => $data['currency_id'],
            'experience' => $data['experience'],
            'employment' => $data['employment'],
            'related' => $data['related'],
            'referrer_id' => $data['referral'] ? $data['referral'] : null,
        ]);
    }
}
