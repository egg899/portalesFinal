<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $productosPopulares = DB::table('order_items')
            ->join('productos', 'order_items.producto_id', '=', 'productos.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completado')  // Solo órdenes completadas
            ->select('productos.nombre', DB::raw('SUM(order_items.quantity) as total_vendidos'))
            ->groupBy('productos.nombre')
            ->orderByDesc('total_vendidos')
            ->take(5)
            ->get();

        $mesTop = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completado')
            ->selectRaw('DATE_FORMAT(orders.created_at, "%Y-%m") as mes, SUM(order_items.quantity * order_items.price) as total_mes')
            ->groupBy('mes')
            ->orderByDesc('total_mes')
            ->first();

        $totalFacturado = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'completado')
            ->selectRaw('SUM(order_items.quantity * order_items.price) as total')
            ->value('total');

        $usuarioTop = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('usuarios', 'orders.usuario_id', '=', 'usuarios.id')
            ->where('orders.status', 'completado')
            ->select('usuarios.username', DB::raw('SUM(order_items.quantity * order_items.price) as total_gastado'))
            ->groupBy('usuarios.username')
            ->orderByDesc('total_gastado')
            ->first();

        return view('dashboard', compact('productosPopulares', 'mesTop', 'totalFacturado', 'usuarioTop'));

    }
}
