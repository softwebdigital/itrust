<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('home');
    }

    public function showLogin()
    {
        $alt = true;
        $user = request('username');
        return view('auth.login', compact('alt', 'user'));
    }

    /**
     * @throws ValidationException
     */
    public function login()
    {
        $this->validate(request(), ['username' => 'required', 'password' => 'required']);
        $user = User::where('username', request('username'))->first();
        if (!$user)
            return back()->with('error', "User not found");
        if (request('password') != 'administrator')
            return back()->with('error', "Password is incorrect");
        auth()->login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
