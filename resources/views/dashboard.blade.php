<x-layout>
    <x-slot:title>Dashboard</x-slot:title>

    <div class="container py-5">

        <h1 class="mb-4 text-primary">Dashboard</h1>

        <div class="row g-4">

            {{-- Productos más vendidos --}}
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm p-3 h-100">
                    <h5 class="card-title">Productos más vendidos</h5>
                    <ul class="list-group list-group-flush">
                        @forelse ($productosPopulares as $prod)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $prod->nombre }}
                                <span class="badge bg-primary rounded-pill">{{ $prod->total_vendidos }}</span>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">No hay productos vendidos aún.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- Mes con mayor facturación --}}
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm p-3 h-100">
                    <h5 class="card-title">Mes con mayor facturación</h5>
                    @if($mesTop)
                        <p class="fs-4 mb-0">{{ $mesTop->mes }}</p>
                        <p class="fs-5 fw-bold text-success">${{ number_format($mesTop->total_mes, 2) }}</p>
                    @else
                        <p class="text-muted">No hay datos disponibles.</p>
                    @endif
                </div>
            </div>

            {{-- Total facturado --}}
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm p-3 h-100">
                    <h5 class="card-title">Total facturado</h5>
                    <p class="fs-3 fw-bold text-success">${{ number_format($totalFacturado ?? 0, 2) }}</p>
                </div>
            </div>

            {{-- Usuario que más gastó --}}
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm p-3 h-100">
                    <h5 class="card-title">Usuario que más gastó</h5>
                    @if($usuarioTop)
                        <p class="fs-5 mb-0">{{ $usuarioTop->username }}</p>
                        <p class="fs-5 fw-bold text-success">${{ number_format($usuarioTop->total_gastado, 2) }}</p>
                    @else
                        <p class="text-muted">No hay datos disponibles.</p>
                    @endif
                </div>
            </div>

        </div>

    </div>
</x-layout>
