<x-layout>
    <x-slot:title>Iniciar Sesión</x-slot>

    <div class="container mt-5" style="max-width: 400px;">
        <h1 class="mb-4 text-center">Iniciar Sesión</h1>

        <form method="POST" action="{{ route('auth.authenticate') }}">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-control"
                    placeholder="Ingrese su usuario"
                    required
                    autofocus
                >
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Contraseña</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    placeholder="Ingrese su contraseña"
                    required
                >
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>
</x-layout>
