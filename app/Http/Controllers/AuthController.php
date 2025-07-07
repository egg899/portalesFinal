<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class AuthController extends Controller
{

    public function showRegister()
    {
        return view('auth.register');
    }


    public function register(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255',
        'password' => 'required|string|min:4|confirmed',
    ], [
        'password.confirmed' => 'Las contraseñas no coinciden.',
    ]);

    Usuario::create([
        'username' => $request->username,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('auth.login')->with([
        'feedback.message' => 'Usuario registrado correctamente. Iniciá sesión.',
        'feedback.type' => 'success'
    ]);
}




    public function login()
    {
        return view("auth.login");
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()
                ->intended(route('blogs.index'))
                ->with('feedback.message', "Sesión iniciada correctamente")
                ->with('feedback.type', 'success');
        }

       return redirect()
            ->back()
            ->withInput()
            ->with('feedback.message', "Las credenciales son incorrectas")
            ->with('feedback.type', 'danger');

    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();


         return redirect()
            ->route('auth.login')
            ->with('feedback.message', "Sesión cerrada correctamente")
            ->with('feedback.type', 'success');



    }




}
