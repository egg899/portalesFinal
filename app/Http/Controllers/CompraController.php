<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;
use App\Models\Compra;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\OrderController;

class CompraController extends Controller
{

    //mostrar el carrito del usuario autenticado
    public function index()
    {

       $compras = Compra::with('producto')
        ->where('usuario_id', Auth::id())
        ->get();

        $items = [];

        foreach ($compras as $compra) {
            $items[] = [
                'title' => $compra->producto->nombre,
                'quantity' => $compra->cantidad,
                'unit_price' => floatval($compra->producto->precio),
                'currency_id' => 'ARS'
            ];
        }
        // if (empty($items)) {
        //          dd('⚠️ El array $items está vacío. Verificá las compras del usuario.');
        //     }
        $preference = null;
        if(!$compras->isEmpty())
        {
             try {
                MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));
                $preferenceFactory = new PreferenceClient();

                // $back_urls = [
                //         'success' => route('compras.success'),
                //         'pending' => route('compras.pending'),
                //         'failure' => route('compras.failure'),
                // ];
                // $back_urls = [
                //         'success' => 'https://ba5800020952.ngrok-free.app/carrito/exito',
                //         'pending' => 'https://ba5800020952.ngrok-free.app/carrito/pendiente',
                //         'failure' => 'https://ba5800020952.ngrok-free.app/carrito/error',
                // ];
                 $back_urls = [
                        'success' => env('APP_URL') . '/carrito/exito',
                        'pending' => env('APP_URL') . '/carrito/pendiente',
                        'failure' => env('APP_URL') . '/carrito/error',
                ];

                $preference = $preferenceFactory->create([
                    'items' => $items,
                    'back_urls' =>  $back_urls,
                    'auto_return' => 'approved',
                ]);
            } catch (\MercadoPago\Exceptions\MPApiException $e) {
                dd([
                    'status' => $e->getApiResponse()->getStatusCode(),
                    'error' => $e->getApiResponse()->getContent()
                ]);
    }
        }


         return view('carrito.index', compact('compras', 'preference'));
       // return view('carrito.index', compact('compras'));

    }//index


    //Metodos para confirmación o negación de la compra en Mercado Pago
    public function success(Request $request) {
        // dd($request);
        app(OrderController::class)->storeFromCarrito();
        return view('carrito.success');
    }//success



      public function pending(Request $request) {
        // dd($request);
        return view('carrito.pending');
    }//pending

      public function failure(Request $request) {
        // dd($request);
        return view('carrito.failure');
    }//failure

    public function paymentConfirmation(Request $request){
        Log::info(collect($request->input()));
    }



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



    ///HACEMOS EL CHECKOUT CON MERCADO PAGO
    // public function showBuyForm()
    // {
    //             ///MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));



    //             $compras = Compra::with('producto')
    //                 ->where('usuario_id', Auth::id())
    //                 ->get();



    //             $items = [];

    //             foreach ($compras as $compra) {
    //                 $items[] = [
    //                     'title' => $compra->producto->nombre,
    //                     'quantity' => $compra->cantidad,
    //                     'unit_price' => floatval($compra->producto->precio),
    //                     'currency_id' => 'ARS'
    //                 ];
    //             }


    //             MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

    //             $preferenceFactory = new PreferenceClient();
    //             $preference = $preferenceFactory->create([
    //                 'items' => $items,
    //             ]);
    //             //dd($items);

    //            return view('mercadopago.buy-form', compact('compras', 'preference'));


    // }//checkout -showBuyForm

}
?>
