<x-layout>

    <x-slot:title>Mi Carrito - Failure</x-slot:title>

    <div class="container mt-5">
        <div class="text-center">
            <h1 class="mb-4 text-danger">Pago Rechazado</h1>

            <div class="alert alert-danger mx-auto" style="max-width: 500px;">
                Hubo un problema al procesar tu pago.
                Por favor, intenta nuevamente o contacta con soporte.
            </div>

            <a href="{{ route('producto.index') }}" class="btn btn-primary mt-3">
                Volver a Productos
            </a>
        </div>
    </div>

</x-layout>
