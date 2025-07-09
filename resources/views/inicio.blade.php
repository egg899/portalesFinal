<x-layout>
    <x-slot:title>Inicio</x-slot:title>

    {{-- Hero principal --}}
    <div class="text-center py-5 bg-light mb-5 rounded shadow-sm">
        <h1 class="display-4 fw-bold text-primary">Bienvenido a ElectroCore</h1>
        <p class="lead">Experimentá el sonido como nunca antes.</p>
        <p class="text-muted">ElectroCore combina tecnología de última generación con diseño moderno para ofrecerte una experiencia auditiva premium.</p>
    </div>

    {{-- Productos destacados --}}
    <div class="container mb-5">
        <h2 class="text-center mb-4 text-dark">Nuestros Productos</h2>
        <div class="row justify-content-center">
            @forelse ($productos as $producto)
                <div class="col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                    <div class="card shadow-sm border-0">
                        <div class="text-center p-4">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                        </div>
                        @if ($producto->imagen)
                            <img
                                src="{{ asset('storage/' . $producto->imagen) }}"
                                class="card-img-top px-4 pb-4"
                                alt="{{ $producto->nombre }}"
                                style="height: 300px; object-fit: contain;">
                        @else
                            <img
                                src="https://via.placeholder.com/300x200"
                                class="card-img-top"
                                alt="Imagen no disponible"
                                style="height: 300px; object-fit: contain;">
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center mt-5">
                    <p class="text-muted">No hay productos cargados aún.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Características destacadas --}}
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-6">
                <div class="p-4 border rounded bg-white shadow-sm h-100">
                    <h3 class="text-primary"><i class="bi bi-person-heart me-2"></i>Diseñados para vos</h3>
                    <p>Ya sea que escuches música, juegues o trabajes, ElectroPods se adapta a tu ritmo de vida.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 border rounded bg-white shadow-sm h-100">
                    <h3 class="text-primary"><i class="bi bi-bluetooth me-2"></i>Conectividad sin límites</h3>
                    <p>Bluetooth 5.3, cancelación activa de ruido y batería de larga duración para acompañarte donde vayas.</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
