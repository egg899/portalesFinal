<x-layout>

    <x-slot:title>Mi Carrito</x-slot:title>

    <div class="container mt-4">
        <h1 class="mb-4 text-center">Tu Carrito de Compras</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($compras->isEmpty())
            <div class="alert alert-info text-center">
                Todavía no agregaste productos a tu carrito.
            </div>
        @else
            <table class="table table-bordered align-middle shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp

                    @foreach ($compras as $compra)
                        @php
                            $subtotal = $compra->producto->precio * $compra->cantidad;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $compra->producto->nombre }}</td>
                            <td>${{ number_format($compra->producto->precio, 2) }}</td>
                             <td>
                                <form method="POST" action="{{ route('compras.update', $compra) }}" class="d-flex align-items-center">
                                    @csrf
                                    @method('PUT')
                                    <input
                                        type="number"
                                        name="cantidad"
                                        value="{{ $compra->cantidad }}"
                                        class="form-control form-control-sm me-2"
                                        style="width: 70px;"
                                        min="1"
                                    >
                                    <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
                                </form>
                            </td>
                            <td>${{ number_format($subtotal, 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('compras.destroy', $compra) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este producto del carrito?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="3" class="text-end">Total:</th>
                        <th colspan="2">${{ number_format($total, 2) }}</th>
                    </tr>
                </tfoot>
            </table>


        @endif
    </div>


</x-layout>
