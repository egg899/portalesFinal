<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function index()
    {
        // Solo admins pueden acceder
        if(Auth::user()->role !== 'admin') {
            abort(403, 'Acceso no autorizado');
        }

        // $usuarios = Usuario::orderBy('username')->get();

        $usuarios = Usuario::with('compras.producto')->orderBy('username')->get();

         //dd($usuarios);
        return view('admin.usuarios.index', ['usuarios' => $usuarios]);


    }
}
