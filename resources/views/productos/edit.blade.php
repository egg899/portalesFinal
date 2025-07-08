<x-layout>
    <x-slot:title>Editar Producto</x-slot>

    <style>
        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: white !important;
            text-decoration: none;
            cursor: pointer;
        }

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

        h1.mb-4 {
            font-weight: 700;
            color: #2c3e50;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
    </style>

    <div class="container mt-4" style="max-width: 700px;">
        <a href="{{ route('producto.index') }}"
           class="btn btn-outline-primary mb-4 d-inline-flex align-items-center gap-2 shadow-sm"
           style="font-weight: 600; border-radius: 0.5rem;">
            <i class="bi bi-arrow-left-short fs-4"></i>
            Volver a Productos
        </a>

        <h1 class="mb-4 text-center">Editar Producto</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                Hay errores en el formulario. Revisá los campos.
            </div>
        @endif

        <form method="POST" action="{{ route('producto.update', $producto) }}" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input
                    type="text"
                    name="nombre"
                    id="nombre"
                    class="form-control @error('nombre') is-invalid @enderror"
                    value="{{ old('nombre', $producto->nombre) }}"
                    required
                >
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea
                    name="descripcion"
                    id="descripcion"
                    class="form-control @error('descripcion') is-invalid @enderror"
                    rows="4"
                    required
                >{{ old('descripcion', $producto->descripcion) }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input
                    type="number"
                    step="0.01"
                    name="precio"
                    id="precio"
                    class="form-control @error('precio') is-invalid @enderror"
                    value="{{ old('precio', $producto->precio) }}"
                    required
                >
                @error('precio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if ($producto->imagen)
                <div class="mb-3 text-center">
                    <p class="mb-2">Imagen actual:</p>
                    <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid rounded" style="max-height: 200px;">
                </div>
            @endif

            <div class="mb-4">
                <label for="imagen" class="form-label">Cambiar imagen (opcional)</label>
                <input
                    type="file"
                    name="imagen"
                    id="imagen"
                    class="form-control @error('imagen') is-invalid @enderror"
                    accept="image/*"
                >

                    @if ($producto->imagen && \Illuminate\Support\Facades\Storage::disk('public')->exists($producto->imagen))
                    <div class="mb-4">
                        <label class="form-label fw-semibold d-block">Imagen Actual</label>
                        <img
                            src="{{ asset('storage/' . $producto->imagen) }}"
                            alt="Imagen actual de {{ $producto->nombre }}"
                            class="img-fluid rounded shadow-sm"
                            style="max-height: 320px; object-fit: contain;"
                        >
                    </div>
                @else
                    <img
                        src="{{ asset('images/default-image.jpg') }}"
                        alt="Imagen no disponible"
                        class="img-fluid rounded shadow-sm"
                        style="max-height: 300px; object-fit: contain;"
                    >
                    @endif



                @error('imagen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success w-100">Guardar Cambios</button>
        </form>
    </div>
</x-layout>
