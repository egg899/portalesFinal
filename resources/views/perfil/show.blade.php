<x-layout>
    <x-slot:title>Mi Perfil</x-slot:title>

    <div class="container mt-5" style="max-width: 600px;">
        <h1 class="mb-4 text-center">Perfil de Usuario</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <ul class="list-group mb-3">
            <li class="list-group-item"><strong>Usuario:</strong> {{ $usuario->username }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $usuario->email }}</li>
            <li class="list-group-item"><strong>Rol:</strong> {{ ucfirst($usuario->role) }}</li>
        </ul>

        <a href="{{ route('perfil.edit') }}" class="btn btn-primary w-100">Editar Perfil</a>
    </div>
</x-layout>
