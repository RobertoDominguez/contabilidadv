<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginView()
    {

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $this->validate(
            request(),
            [
                'email' => ['email', 'required', 'string', 'exists:admins,email'],
                'password' => ['required', 'string']
            ]
        );

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.ventas');
        }
        return back()
            ->withErrors(['email' => 'La contraseña es incorrecta.'])
            ->withInput(request(['email']));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login_view');
    }
}
