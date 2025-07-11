<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Compra;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function storeFromCarrito()
    {
        $user = Auth::user();
        $cartItems = Compra::where('usuario_id', $user->id)->get();

        if($cartItems->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }


        DB::transaction(function() use ($user, $cartItems) {
            $total = 0;

            foreach($cartItems as $item) {
                $producto = Producto::find($item->producto_id);
                $total += $producto->precio * $item->cantidad;
            }

            $order = Order::create([
                'usuario_id' => $user->id,
                'total' => $total,
                'status' => 'completado'
            ]);


            foreach($cartItems as $item) {
                $producto = Producto::find($item->producto_id);
                orderItem::create([
                    'order_id' => $order->id,
                    'producto_id' => $producto->id,
                    'quantity' => $item->cantidad,
                    'price' => $producto->precio,
                ]);
            }

            Compra::where('usuario_id', $user->id)->delete();
        });

        return redirect()->route('orders.index')->with('success', 'Orden registrada exitosamente.');

    }

    public function index()
    {
        $user = Auth::user();
        $orders = Order::with('items.producto')
                    ->where('usuario_id', $user->id)
                    ->latest()
                    ->get();

        return view('orders.index', compact('orders'));
    }
}
