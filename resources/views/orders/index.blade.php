<x-layout>
    <x-slot:title>Mis Órdenes</x-slot:title>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-5 text-primary">Tu Historial de Compras</h1>
            <p class="lead text-secondary">Revisá tus órdenes pasadas y los productos que adquiriste.</p>
        </div>

        @forelse($orders as $order)
            <div class="card shadow-lg mb-4 border-0">
                <div class="card-header bg-primary text-white">
                    <strong>Orden #{{ $order->id }}</strong> -
                    Fecha: {{ $order->created_at->format('d/m/Y H:i') }} -
                    Total: ${{ number_format($order->total, 2) }} -
                    Estado: {{ ucfirst($order->status) }}
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach($order->items as $item)
                            <div class="col d-flex align-items-stretch">
                                <div class="card h-100 w-100 shadow-sm">
                                    @if ($item->producto && $item->producto->imagen)
                                        <img
                                            src="{{ asset('storage/' . $item->producto->imagen) }}"
                                            class="card-img-top p-3"
                                            alt="{{ $item->producto->nombre }}"
                                            style="height: 180px; object-fit: contain;"
                                        >
                                    @else
                                        <img
                                            src="{{ asset('images/default-image.jpg') }}"
                                            class="card-img-top p-3"
                                            alt="Imagen no disponible"
                                            style="height: 180px; object-fit: contain;"
                                        >
                                    @endif

                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $item->producto->nombre ?? 'Producto eliminado' }}</h5>
                                        <p class="card-text">{{ $item->producto->descripcion ?? 'Sin descripción disponible' }}</p>
                                        <p class="fw-bold text-primary mb-1">Cantidad: {{ $item->quantity }}</p>
                                        <p class="fw-bold text-secondary">Precio: ${{ number_format($item->price, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted">
                <p>No tenés órdenes todavía.</p>
            </div>
        @endforelse
    </div>
</x-layout>
