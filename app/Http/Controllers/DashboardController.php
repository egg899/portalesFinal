<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Productos más comprados
        $productosPopulares = DB::table('compras')
            ->join('productos', 'compras.producto_id', '=', 'productos.id')
            ->select('productos.nombre', DB::raw('SUM(compras.cantidad) as total_vendidos'))
            ->groupBy('productos.nombre')
            ->orderByDesc('total_vendidos')
            ->take(5)
            ->get();




       //Mes con mayor facturación
       $mesTop = DB::table('compras')
            ->join('productos', 'compras.producto_id', '=', 'productos.id')
            ->selectRaw('DATE_FORMAT(compras.created_at, "%Y-%m") as mes, SUM(compras.cantidad * productos.precio) as total_mes')
            ->groupBy('mes')
            ->orderByDesc('total_mes')
            ->first();

       //Total facturado
       $totalFacturado = DB::table('compras')
           ->join('productos', 'compras.producto_id', '=', 'productos.id')
           ->selectRaw('SUM(compras.cantidad * productos.precio) as total')
           ->value('total');



       //usuario que más gastó
       $usuarioTop = DB::table('compras')
            ->join('productos', 'compras.producto_id', '=', 'productos.id')
            ->join('usuarios', 'compras.usuario_id', '=', 'usuarios.id')
            ->select('usuarios.username', DB::raw('SUM(compras.cantidad * productos.precio) as total_gastado'))
            ->groupBy('usuarios.username')
            ->orderByDesc('total_gastado')
            ->first();

        return view('dashboard', compact('productosPopulares', 'mesTop', 'totalFacturado', 'usuarioTop'));

    }
}
