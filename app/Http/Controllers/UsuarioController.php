<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        // Solo admins pueden acceder
        if(Auth::user()->role !== 'admin') {
            abort(403, 'Acceso no autorizado');
        }

        // $usuarios = Usuario::orderBy('username')->get();

        // $usuarios = Usuario::with('compras.producto')->orderBy('id')->get();
           $usuarios = Usuario::with('ordenes.items.producto')->orderBy('id')->get();


         //dd($usuarios);
        return view('admin.usuarios.index', ['usuarios' => $usuarios]);


    }//index



    public function showPerfil()
{
    $usuario = Auth::user();
    return view('perfil.show', compact('usuario'));
}

public function editPerfil()
{
    $usuario = Auth::user();
    return view('perfil.edit', compact('usuario'));
}

public function updatePerfil(Request $request)
{
    $usuario = Auth::user();

    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
        'password' => 'nullable|string|min:4|confirmed',
    ]);

    $usuario->username = $request->username;
    $usuario->email = $request->email;

    if ($request->filled('password')) {
        $usuario->password = Hash::make($request->password);
    }

    $usuario->save();

    return redirect()->route('perfil.show')->with('success', 'Perfil actualizado correctamente.');
}



}
