<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginView()
    {

        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $this->validate(
            request(),
            [
                'email' => ['email', 'required', 'string', 'exists:users,email'],
                'password' => ['required', 'string']
            ]
        );

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('ventas');
        }
        return back()
            ->withErrors(['email' => 'La contraseña es incorrecta.'])
            ->withInput(request(['email']));
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login_view');
    }
}
