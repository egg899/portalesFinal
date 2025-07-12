<x-layout>
    <x-slot:title>Iniciar Sesión</x-slot>

    <div class="container mt-5" style="max-width: 400px;">
        <h1 class="mb-4 text-center">Iniciar Sesión</h1>

        <form method="POST" action="{{ route('auth.authenticate') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    placeholder="Ingrese su correo electrónico"
                    required
                    autofocus
                    value="{{ old('email') }}"
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
