<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formulario de registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Registrar usuario
public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
       'password' => 'required|min:4|confirmed',
        'role' => 'required|in:cliente,administrador',
        'clave_admin' => 'nullable'
    ]);

    if ($request->role === "administrador") {
        if ($request->clave_admin !== "HOTEL-ADMIN-999") {
            return back()->withErrors(['clave_admin' => 'Clave de administrador incorrecta.'])->withInput();
        }
    }

    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => $request->role,
    ]);

    return redirect()->route('login')->with('success', 'Cuenta creada. Inicia sesión.');
}


    // Mostrar formulario de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login
 public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {


        $request->session()->regenerate();
        return redirect()->route('welcome.hotel');
    }

    return back()->withErrors([
        'email' => 'Credenciales incorrectas.',
    ]);
}


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}