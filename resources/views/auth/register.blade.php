<x-layout>
    <x-slot:title>Registrarse</x-slot>

    <div class="container mt-5" style="max-width: 400px;">
        <h1 class="mb-4 text-center">Registrarse</h1>

        <form method="POST" action="{{ route('auth.register.submit') }}">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-control @error('username') is-invalid @enderror"
                    placeholder="Usuario"
                    required
                    value="{{ old('username') }}"
                >
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Contraseña"
                    required
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Repetir Contraseña</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="Repetir Contraseña"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary w-100">Registrarse</button>
        </form>
    </div>
</x-layout>
