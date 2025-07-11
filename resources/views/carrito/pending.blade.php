<x-layout>

    <x-slot:title>Mi Carrito - Pending</x-slot:title>

    <div class="container mt-5">
        <div class="text-center">
            <h1 class="mb-4">Pago Pendiente</h1>

            <div class="alert alert-warning mx-auto" style="max-width: 500px;">
                Tu pago está pendiente de confirmación.
                Por favor, espera mientras procesamos la información.
            </div>

            <a href="{{ route('producto.index') }}" class="btn btn-primary mt-3">
                Volver a Productos
            </a>
        </div>
    </div>

</x-layout>
