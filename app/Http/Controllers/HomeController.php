<?php

namespace App\Http\Controllers;
use App\Models\Producto;
 class HomeController extends Controller
{
    public function home(){
        //return view('inicio');
        $productos = Producto::all(); // o con algún filtro, como ->latest()->take(3)

        return view('inicio', ['productos'=> $productos]);
    }
}
