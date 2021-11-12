<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required|min:2',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'nama' => $request['nama'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        // $request->session()->push('laravel_session', [token]);
        // $request->session()->regenerate();
        Auth::login($user);
        return redirect('dashboard/data');
    }
}
