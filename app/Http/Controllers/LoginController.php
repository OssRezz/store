<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function iniciarSesion(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = request()->only('email', 'password');
        $user = User::where('email', $request->email)->get()->take(1);
        if (count($user) != 0) {
            if ($user[0]['estado'] == 0) {
                return redirect()->to('/')->with('message', 'No puedes ingresar a este sistema de información');
            }
        }

        if (Auth::attempt($credentials)) {
            return redirect()->to('admin/home')->with('message', 'Bienvenido');
        } else {
            return redirect()->to('/')->with('message', 'Las credenciales de ingreso son incorrectas.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to('/')->with('message', 'Sesion cerrada.');
    }
}
