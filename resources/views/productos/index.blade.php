<x-layout>
    <x-slot:title>Nuestro Producto</x-slot:title>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-5 text-primary">Conocé más sobre nuestro producto estrella</h1>
            <p class="lead text-secondary">
                Donde el diseño se encuentra con el sonido.
                <br>ElectroPods no es solo un auricular, es una experiencia que te acompaña a donde vayas.
            </p>
        </div>

        <div class="row justify-content-center">
            @forelse ($productos as $producto)
                <div class="col-md-6 col-lg-4 mb-5 d-flex align-items-stretch">
                    <div class="card shadow-lg border-0 w-100">
                        @if ($producto->imagen)
                            <img
                                src="{{ asset('images/' . $producto->imagen) }}"
                                class="card-img-top p-3"
                                alt="{{ $producto->nombre }}"
                                style="height: 220px; object-fit: contain;"
                            >
                        @else
                            <img
                                src="https://via.placeholder.com/300x220"
                                class="card-img-top p-3"
                                alt="Imagen no disponible"
                                style="height: 220px; object-fit: contain;"
                            >
                        @endif
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text">{{ $producto->descripcion }}</p>
                            <p class="fw-bold text-primary fs-5">${{ $producto->precio }}</p>
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
