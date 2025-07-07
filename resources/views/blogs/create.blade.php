<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
?>

<x-layout>
    <x-slot:title>Crear Entrada</x-slot>

    <style>
        /* Para que el botón volver tenga un hover más marcado y cursor pointer */
        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: white !important;
            text-decoration: none;
            cursor: pointer;
        }

        /* Inputs y textarea más agradables al tacto y enfoque */
        input.form-control,
        textarea.form-control {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 1.05rem;
            transition: box-shadow 0.3s ease;
        }

        input.form-control:focus,
        textarea.form-control:focus {
            box-shadow: 0 0 8px rgba(13, 110, 253, 0.5);
            border-color: #0d6efd;
        }

        /* El botón publicar con sombra y texto más grande */
        button.btn-success {
            font-weight: 600;
            font-size: 1.1rem;
            padding: 0.75rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
            transition: background-color 0.3s ease;
        }

        button.btn-success:hover {
            background-color: #198754cc;
        }

        /* Centrar el título con más estilo */
        h1.mb-4 {
            font-weight: 700;
            color: #2c3e50;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
    </style>

    <div class="container mt-4" style="max-width: 700px;">
        <a href="{{ route('blogs.index') }}"
           class="btn btn-outline-primary mb-4 d-inline-flex align-items-center gap-2 shadow-sm"
           style="font-weight: 600; border-radius: 0.5rem; transition: background-color 0.3s, color 0.3s;">
            <i class="bi bi-arrow-left-short fs-4"></i>
            Volver al Blog
        </a>

        <h1 class="mb-4 text-center">Ingresa una Nueva Entrada</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                La información ingresada contiene errores.
                Por favor, revisá los campos y probá de nuevo.
            </div>
        @endif
        <form method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="mb-3">
                <input
                    type="text"
                    name="titulo"
                    class="form-control @error('titulo') is-invalid @enderror"
                    placeholder="Título"
                    value="{{ old('titulo') }}"
                    required
                >
                @error('titulo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input
                    type="text"
                    name="resumen"
                    class="form-control @error('resumen') is-invalid @enderror"
                    placeholder="Resumen"
                    value="{{ old('resumen') }}"
                    required
                >
                @error('resumen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <textarea
                    name="contenido"
                    class="form-control @error('contenido') is-invalid @enderror"
                    placeholder="Contenido"
                    rows="7"
                    required
                >{{ old('contenido') }}</textarea>
                @error('contenido')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <input
                    type="text"
                    name="autor"
                    class="form-control @error('autor') is-invalid @enderror"
                    placeholder="Autor"
                    value="{{ old('autor') }}"
                    required
                >
                @error('autor')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">

                 <fieldset class="mb-3">
                    <lengend><h3>Categorías:</h3> </lengend>
                    @foreach($categorias as $categoria)
                        <label class="mb-3">
                            <input
                                type="checkbox"
                                name="categoria_id[]"
                                value="{{ $categoria->categoria_id }}"
                                @checked(in_array($categoria->categoria_id, old('categoria_id', [])))
                            >
                            {{ $categoria->name }}
                        </label>
                    @endforeach
                </fieldset>
                {{-- <input
                    type="text"
                    name="categoria"
                    class="form-control @error('categoria') is-invalid @enderror"
                    placeholder="Categoría"
                    value="{{ old('categoria') }}"
                    required
                > --}}
                @error('categoria')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">

                <select
                    id="rating_fk"
                    name="rating_fk"
                    class="form-control"
                >
                 <option disabled selected>Seleccioná una clasificación</option>

                @foreach($ratings as $rating)
                    <option value="{{ $rating->rating_id }}"
                        @selected($rating->rating_id == old('rating_fk'))
                        >
                        {{ $rating->name}}
                    </option>
                @endforeach
                </select>
            </div>

            <div class="mb-4">
                <input
                    type="file"
                    name="imagen"
                    class="form-control @error('imagen') is-invalid @enderror"
                    accept="image/*"
                >
                @error('imagen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success w-100">Publicar</button>
        </form>
    </div>
</x-layout>
