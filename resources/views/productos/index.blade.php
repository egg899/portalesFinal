<x-layout>
    <x-slot:title>Nuestro Producto</x-slot:title>

    <div class="container py-5">
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


        @auth
            <div class="mb-4 text-end">
                @if(auth()->user()->role==='admin')
                <a href="{{ route('producto.create') }}" class="btn btn-success shadow-sm">
                    <i class="bi bi-plus-circle me-1"></i>  + Crear producto
                </a>
                @endif
            </div>
        @endauth

        <div class="text-center mb-5">
            <h1 class="display-5 text-primary">Conocé más sobre nuestro productos estrellas</h1>
            <p class="lead text-secondary">
                Donde el diseño se encuentra con el sonido.
                <br>ElectroPods no es solo un auricular, es una experiencia que te acompaña a donde vayas.
                <br>También puedes ver algunos mas de nuestros productos.

            </p>
        </div>

        <div class="row justify-content-center">
            @forelse ($productos as $producto)
                <div class="col-md-6 col-lg-4 mb-5 d-flex align-items-stretch">
                    <div class="card shadow-lg border-0 w-100">
                        @if ($producto->imagen)
                            <img
                                src="{{ asset('storage/' . $producto->imagen) }}"
                                class="card-img-top p-3"
                                alt="{{ $producto->nombre }}"
                                style="height: 220px; object-fit: contain;"
                            >
                        @else
                             <img
                                src="{{ asset('images/default-image.jpg') }}"
                                alt="Imagen no disponible"
                                class="img-fluid rounded shadow-sm"
                                style="max-height: 300px; object-fit: contain;"
                            >
                        @endif
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text">{{ $producto->descripcion }}</p>
                            <p class="fw-bold text-primary fs-5">${{ $producto->precio }}</p>


                       <div class="mt-3 text-center">
                         @auth
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('producto.edit', $producto) }}" class="btn btn-sm btn-warning ms-1">Editar</a>

                                   <a href="{{ route('producto.delete', $producto) }}" class="btn btn-sm btn-danger">Borrar</a>

                                @endif
                         @endauth

                        @auth
                            <form action="{{ route('compras.store') }}" method="POST" class="mt-2">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <input type="number" name="cantidad" value="1" min="1" class="form-control form-control-sm w-25">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="biu bi-cart-plus"></i> Agregar
                                    </button>
                                </div>
                            </form>
                        @endauth



                        </div>


                        </div>





                    </div>





                </div>
            @empty
                <div class="text-center">
                    <p class="text-muted">Aún no hay productos cargados.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
