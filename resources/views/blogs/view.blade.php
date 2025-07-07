

<x-layout>
    <x-slot:title>{{ $blog->titulo }}</x-slot:title>

    {{-- Título del Blog --}}
    <div class="text-center my-5">
        <h1 class="display-5 fw-bold text-primary">{{ $blog->titulo }}</h1>
        <p class="text-muted">
            Publicado el {{ $blog->fecha->format('d/m/Y') }} | Categoría: <span class="fw-semibold">{{ $blog->categoria }}</span>
        </p>
    </div>

    {{-- Imagen del Blog --}}
    <div class="text-center mb-4">
        @if ($blog->imagen && \Illuminate\Support\Facades\Storage::has($blog->imagen))
            <img
                src="{{ asset('storage/' . $blog->imagen) }}"
                {{-- src="{{ \Illuminate\Support\Facades\Storage::url($blog->imagen)  }}" --}}
                alt="{{ $blog->titulo }}"
                class="img-fluid rounded shadow-sm"
                style="max-height: 500px; object-fit: cover;"
            >
        @else
            <img
                src="{{ asset('images/default-image.jpg') }}"
                alt="Imagen no disponible"
                class="img-fluid rounded shadow-sm"
                style="max-height: 300px; object-fit: contain;"
            >
        @endif
    </div>

    {{-- Contenido --}}
    <div class="container">
        <div class="mx-auto bg-white p-4 rounded shadow-sm" style="max-width: 800px; line-height: 1.7; font-size: 1.1rem;">
            {!! $blog->contenido !!}
        </div>

        {{-- Botón volver --}}
        <div class="text-center mt-4">
            <a href="{{ route('blogs.index') }}" class="btn btn-outline-primary">
                ← Volver al Blog
            </a>
        </div>
    </div>
</x-layout>
