<x-layout>
    <x-slot:title>Usuarios Registrados</x-slot:title>

    <div class="container py-5">
        <h1 class="mb-4">Lista de Usuarios</h1>

        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Rol</th>
                    <th>Fecha de Registro</th>
                    <th>Compras</th>
                </tr>
            </thead>

            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                   <td>
                        <a href="{{ route('admin.usuarios.historial', $usuario) }}">
                            {{ $usuario->username }}
                        </a>
                    </td>
                    <td>{{ $usuario->role }}</td>
                    <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                    <td>
                         @if ($usuario->compras->isEmpty())
                                <span class="text-muted">Sin compras</span>
                            @else
                                <ul class="mb-0">
                                    @foreach ($usuario->compras as $compra)
                                        <li>
                                            {{ $compra->producto->nombre ?? 'Producto eliminado' }} (x{{ $compra->cantidad }})
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                    </td>


                </tr>
                @endforeach
            </tbody>

        </table>


    </div>

</x-layout>
