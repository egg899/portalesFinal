<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Rating;
use App\Models\Categorias;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with(['rating', 'categorias'])->orderBy('fecha', 'desc')->get();
        //dd($blogs);
        return view('blogs.index', ['blogs'=> $blogs]);
    }

    public function view($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.view', ['blog' => $blog]);
    }

    public function edit(int $id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', ['blog' => $blog,
        'ratings'=> Rating::all(),
        'categorias' => Categorias::orderBy('name')->get(),
    ]);

    }



    public function update(Request $request, int $id)
    {
        $blog = Blog::findOrFail($id);

        $data = $request->validate([
                    'titulo' => 'required|string|max:255',
                    'resumen' => 'nullable|string|max:500', // Mejor agregar un límite razonable
                    'contenido' => 'required|string',
                    'imagen' => 'nullable|image|max:2048', // 2048 KB = 2MB
                    'rating_fk' => 'required|exists:ratings,rating_id',
                ], [
                    'titulo.required' => 'El título es obligatorio.',
                    'titulo.max' => 'El título no debe superar los :max caracteres.',

                    'resumen.max' => 'El resumen no debe superar los :max caracteres.',

                    'contenido.required' => 'El contenido es obligatorio.',

                    'imagen.image' => 'El archivo debe ser una imagen válida.',
                    'imagen.max' => 'La imagen no debe pesar más de 2MB.',
                ]);


        // Verificamos si se subió la imagen
        if($request->hasFile('imagen')) {
            //Eliminar la imagen anterior si existe
            if($blog->imagen && \Storage::disk('public')->exists($blog->imagen)) {
                \Storage::disk('public')->delete($blog->imagen);
            }

            //Guardar la imagen nueva
            $data['imagen'] = $request->file('imagen')->store('images', 'public');
        }






     $blog->update($data);
     // $blog->update($request->all());
      $blog->categorias()->sync($request->input('categoria_id'));

    return redirect()
        ->route('blogs.view', $blog->id)
        ->with('feedback.message', 'La entrada <b>'.e($blog['titulo']).'</b> actualizada');
    }

    public function delete(int $id)
    {
        return view('blogs.delete', [
            'blog' => Blog::findOrFail($id)
        ]);
    }


    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);


          // Si existe una imagen asociada, eliminarla del almacenamiento
    if ($blog->imagen && \Storage::disk('public')->exists($blog->imagen)) {
        \Storage::disk('public')->delete($blog->imagen);
    }

        $blog->categorias()->detach();
        $blog->delete($id);

        return redirect('/blogs')->with(['feedback.message' => 'La entrada <b>'.e($blog['titulo']).'</b> eliminada', 'feedback.type'=>'danger']);
    }


    public function create()
    {
        return view('blogs.create', [
            'categorias' => Categorias::orderBy('name')->get(),
            'ratings' => Rating::all(),
        ]);
    }



//    public function store(Request $request)
// {
//     // dd($request->input('categoria_id'));
//     $input = $request->all();

//                 $request->validate([
//                 'titulo' => 'required|string|min:4|max:255',
//                 'resumen' => 'nullable|string|max:500|min:10',
//                 'contenido' => 'required|string',
//                 'autor' => 'required|string|max:100',

//                 'imagen' => 'nullable|image|max:2048',
//                 ], [
//                 'titulo.required' => 'El título debe tener un valor.',
//                 'titulo.min' => 'El título debe tener al menos :min caracteres.',
//                 'titulo.max' => 'El título no puede superar los :max caracteres.',

//                 // 'resumen.required' => 'El resumen es obligatorio.',
//                 'resumen.max' => 'El resumen no debe superar los :max caracteres.',
//                 'resumen.min' => 'El reusme debe de tener al menos :min caracteres.',

//                 'contenido.required' => 'El contenido es requerido.',

//                 'autor.required' => 'El autor es requerido.',
//                 'autor.max' => 'El autor no debe superar los :max caracteres.',


//                 'imagen.image' => 'El archivo debe ser una imagen.',
//                 'imagen.max' => 'La imagen no debe superar los 2MB.',
//             ]);

//     $input = $request->only(['titulo', 'resumen', 'contenido', 'autor', 'categoria']);

//     $rutaImagen = null;
//     if ($request->hasFile('imagen')) {
//         $rutaImagen = $request->file('imagen')->store('images', 'public');
//     }

//     // Blog::create([
//     //     'titulo' => $request->titulo,
//     //     'resumen' => $request->resumen,
//     //     'contenido' => $request->contenido,
//     //     'autor' => $request->autor,
//     //     'categoria' => $request->categoria,
//     //     'imagen' => $rutaImagen,
//     // ]);

//         // $blog = new Blog();
//         // $blog->titulo = $request->titulo;
//         // $blog->resumen = $request->resumen;
//         // $blog->contenido = $request->contenido;
//         // $blog->autor = $request->autor;
//         // $blog->categoria = $request->categoria;
//         // $blog->imagen = $rutaImagen;
//         // $blog->save();


//         //$input = $request->all();
//         $blog  =  Blog::create($input);
//         $blog->categorias()->attach($input['categoria_id'] ?? []);

//         return redirect()
//             ->route('blogs.index')
//             ->with('feedback.message', 'La entrada <b>'.e($blog['titulo']).'</b> ha sido creada correctamente.');
// }



public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|min:4|max:255',
        'resumen' => 'nullable|string|max:500|min:10',
        'contenido' => 'required|string',
        'autor' => 'required|string|max:100',
        'imagen' => 'nullable|image|max:2048',
    ], [
        'titulo.required' => 'El título debe tener un valor.',
        'titulo.min' => 'El título debe tener al menos :min caracteres.',
        'titulo.max' => 'El título no puede superar los :max caracteres.',
        'resumen.max' => 'El resumen no debe superar los :max caracteres.',
        'resumen.min' => 'El resumen debe de tener al menos :min caracteres.',
        'contenido.required' => 'El contenido es requerido.',
        'autor.required' => 'El autor es requerido.',
        'autor.max' => 'El autor no debe superar los :max caracteres.',
        'imagen.image' => 'El archivo debe ser una imagen.',
        'imagen.max' => 'La imagen no debe superar los 2MB.',
    ]);

    // Obtenés todos los datos del formulario
    $input = $request->all();

    // Guardás la imagen si existe
    if ($request->hasFile('imagen')) {
        $rutaImagen = $request->file('imagen')->store('images', 'public');
        $input['imagen'] = $rutaImagen; // Acá agregás la ruta al array $input
    }

    // Creamos el blog con los datos, incluyendo la imagen
    $blog = Blog::create($input);

    // Asociamos categorías si existen
    $blog->categorias()->attach($input['categoria_id'] ?? []);

    return redirect()
        ->route('blogs.index')
        ->with('feedback.message', 'La entrada <b>' . e($blog['titulo']) . '</b> ha sido creada correctamente.');
}


}



