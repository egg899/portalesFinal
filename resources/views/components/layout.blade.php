<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? '' }} : Escuela DaVinci</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/styles.css') }}">
  </head>
  <body class="d-flex flex-column min-vh-100">
    <div id="app">

      <!-- Navbar mejorada -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ route('home') }}">ElectroPods</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <x-nav-link route="home">Inicio</x-nav-link>
              <x-nav-link route="about">Quienes Somos?</x-nav-link>
              <x-nav-link route="producto.index">Producto</x-nav-link>
              <x-nav-link route="blogs.index">Blog</x-nav-link>
              @auth
                  @if(auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.usuarios.index') }}">Lista de Usuarios</a>
                    </li>
                  @endif
              @endauth
            </ul>

                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @if (!auth()->check())
                            <li class="nav-item">
                            <x-nav-link route="auth.login">Iniciar Sesión</x-nav-link>
                            </li>
                            <li class="nav-item">
                            <x-nav-link route="auth.register">Registrarse</x-nav-link>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->username }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                {{-- <form method="POST" action="{{ route('auth.logout') }}"> --}}
                                <form method="POST" action="{{ url('/cerrar-sesion') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Cerrar sesión</button>
                                </form>
                                </li>
                            </ul>
                            </li>
                        @endif
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

      <footer class="bg-dark text-white text-center py-3 ">
        <p class="mb-0">&copy; Da Vinci 2024</p>
      </footer>

    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-YUe2LzesAfftltw+PEaao2tjU/QATaW/rOitAq67e0CT0Zi2VVRL0oC4+gAaeBKu" crossorigin="anonymous"></script>

  </body>
</html>
