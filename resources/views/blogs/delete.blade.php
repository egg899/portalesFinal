<?php
/** @var \App\Models\Movie $movie */
?>


<x-layout>
    <x-slot:title>El Blog: {{ $blog->titulo }}</x-slot:title>



    <h1 class="h4 mb-3 mt-3"> Confirmación para eliminar  la entrada:  {{ $blog->titulo }}</h1>


    <p class="mb-1"> Estás a punto de <b>eliminar</b> la pelíccula <b>{{ $blog->titulo }}</b></p>
    <p>¿Querés proceder con  la eliminación?</p>

    <form action="{{ route('blogs.destroy', ['id'=>$blog->id]) }}" method="POST" class="d-inline ms-1" onsubmit="return confirm('¿Estás seguro de eliminar esta entrada?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
    </form>
    <hr class="mb-3">
    <h2 class="mb-3">{{ $blog->titulo }}</h2>


    <dl class="mb-3">
        <dt>Contenido</dt>
        <dd>{{ $blog->contenido }}</dd>
        <dt>Autor</dt>
        <dd>{{ $blog->autor }}</dd>
    </dl>
    {{-- Botón volver --}}
            <div class="mt-4">
                <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary">
                    ← Volver al Blog
                </a>
            </div>
</x-layout>
