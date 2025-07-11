<x-layout>

    <x-slot:title>Mi Carrito - Success</x-slot:title>

    <div class="container mt-5">
        <div class="text-center">
            <h1 class="mb-4">¡Gracias por tu compra!</h1>

            <div class="alert alert-success mx-auto" style="max-width: 500px;">
                Tu pedido ha sido procesado correctamente.
                En breve recibirás un correo con los detalles de la transacción.
            </div>

            <a href="{{ route('producto.index') }}" class="btn btn-primary mt-3">
                Seguir comprando
            </a>
        </div>
    </div>

</x-layout>
