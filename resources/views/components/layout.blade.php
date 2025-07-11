<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($title) && $title !== '' ? "$title : " : '' }}Escuela DaVinci</title>

    <!-- Bootstrap desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

        <!-- Estilos personalizados -->
    {{-- <link rel="stylesheet" href="{{ url('css/styles.css') }}"> --}}
    <link rel="stylesheet" href="https://1f1f28f5ad75.ngrok-free.app/css/styles.css">

  </head>
  <body class="d-flex flex-column min-vh-100">
    <div id="app">

      <!-- Navbar mejorada -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ route('home') }}">ElectroCore</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="mainNavbar">
            <!-- Menú izquierdo -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <x-nav-link route="home">Inicio</x-nav-link>
              <x-nav-link route="about">¿Quiénes Somos?</x-nav-link>
              <x-nav-link route="producto.index">Productos</x-nav-link>
              <x-nav-link route="blogs.index">Blog</x-nav-link>
            </ul>

            <!-- Menú derecho -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              @auth
                <!-- Carrito -->
                <li class="nav-item">
                  <a href="{{ route('compras.index') }}" class="nav-link position-relative">
                    🛒 Carrito
                    @php
                        $carritoCount = $carritoCount ?? 0;
                    @endphp
                    @if($carritoCount > 0)
                      <span class="position-absolute top-10 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $carritoCount }}
                        <span class="visually-hidden">items en el carrito</span>
                      </span>
                    @endif
                  </a>
                </li>
              @endauth

              @guest
                <li class="nav-item">
                  <x-nav-link route="auth.login">Iniciar Sesión</x-nav-link>
                </li>
                <li class="nav-item">
                  <x-nav-link route="auth.register">Registrarse</x-nav-link>
                </li>
              @else
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle ms-3" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ auth()->user()->username }}
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    @if(auth()->user()->role === 'admin')
                      <li>
                        <a class="dropdown-item" href="{{ url('/admin/usuarios') }}">Lista de Usuarios</a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a>
                      </li>
                    @endif
                    <li>
                      <form method="POST" action="{{ url('/cerrar-sesion') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Cerrar sesión</button>
                      </form>
                    </li>
                  </ul>
                </li>
              @endguest
            </ul>
          </div>
        </div>
      </nav>
      <!-- Fin Navbar -->

      <main class="p-4 flex-grow-1 mb-5">
        @if(session()->has('feedback.message'))
          <div class="alert alert-{{ session('feedback.type', 'success') }}">
            {!! session('feedback.message') !!}
          </div>
        @endif

        <div class="container-fluid">
          {{ $slot }}
        </div>
      </main>

      <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">&copy; Da Vinci 2024</p>
      </footer>

    </div>

    <!-- Bootstrap JS desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
