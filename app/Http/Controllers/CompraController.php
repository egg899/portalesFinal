<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{

    //mostrar el carrito del usuario autenticado
    public function index()
    {

        $compras = Compra::with('producto')
            ->where('usuario_id', Auth::id())
            ->get();

        return view('carrito.index', compact('compras'));

    }//index

    // Agregar producto al carrito
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'nullable|integer|min:1'
        ]);

        $cantidad = $request->input('cantidad', 1);

        $compra = Compra::where('usuario_id', Auth::id())
            ->where('producto_id', $request->producto_id)
            ->first();

        if($compra) {
            $compra->increment('cantidad', $cantidad);
        } else {
            Compra::create([
                'usuario_id' => Auth::id(),
                'producto_id' => $request->producto_id,
                'cantidad' => $cantidad,
            ]);
        }

        return redirect()->back()->with('success', 'Producto añadido al carrito');

    }//Store


    // Actualizar cantidad de un producto en el carrito
    public function update(Request $request, Compra $compra)
    {
        // $this->authorize('update', $compra);//Asegura que el usuario pueda modificar esta compra
        // Validar que el usuario sea dueño de esta compra
        if ($compra->usuario_id !== Auth::id()) {
            abort(403, 'No autorizado');
        }

        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $compra->update([
            'cantidad' => $request->cantidad
        ]);

        return redirect()->back()->with('success', 'Cantidad actualizada');


    }//update


    // Eliminar producto del carrito
    public function destroy($id)
    {
        // $this->authorize('delete', $compra);//Asegura que el usuario pueda eliminar esta compra
        // Validar que el usuario sea dueño de esta compra
        $compra = Compra::where('id', $id)
            ->where('usuario_id', Auth::id())
            ->firstOrFail();

        $compra->delete();

        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }



}
?>
