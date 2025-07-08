<?php
/** @var \App\Models\Producto $producto*/
?>

<x-layout>

    <x-slot:title>Eliminar Producto: {{ $producto->nombre }}</x-slot:title>

    <h1 class="h4 mb-3 mt-3">Confimación para eliminar el producto: <b>{{ $producto->nombre }}</b></h1>
    <p class="mb-1">Estás a punto de <b>eliminar</b> el producto <b>{{ $producto->nombre }}</b>.</p>
    <p>¿Qurés proceder con la eliminación?</p>

    <form action="{{ route('producto.destroy', $producto) }}" method="POST" class="d-inline ms-1" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
    </form>

    <hr class="mb-3">

    <h2 class="mb-3">{{ $producto->nombre }}</h2>

    <dl class="mb-3">
        <dt>Descripción</dt>
        <dd>{{ $producto->descripcion }}</dd>
        <dt>Precio</dt>
        <dd>${{ $producto->precio }}</dd>
    </dl>



    @if($producto->imagen)
     <div class="mb-3">
            <img
                src="{{ asset('storage/' . $producto->imagen) }}"
                alt="Imagen del producto"
                class="img-fluid"
                style="max-height: 200px; object-fit: contain;"
            >
        </div>
    @endif

   <div class="mt-4">
        <a href="{{ route('producto.index') }}" class="btn btn-outline-primary">
           ← Volver a la lista de productos
        </a>
   </div>
</x-layout>
