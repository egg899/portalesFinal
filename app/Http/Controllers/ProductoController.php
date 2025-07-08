<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        // dd($productos);

        return view('productos.index', ['productos'=> $productos]);
    }



    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048'
        ]);

        if($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }


        Producto::create($data);

        return redirect()->route('producto.index')->with('success', 'Producto creado correctamente.');

    }//Store

    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }//Edit


    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
             'nombre' => 'required|string|max:255',
             'descripcion' => 'required|string',
             'precio' => 'required|numeric',
             'imagen' => 'nullable|image|max:2048',
        ]);


         if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto ->update($data);

        return redirect()->route('producto.index')->with('success', 'Producto actualizado correctamente.');

    }//update





    public function delete(Producto $producto)
    {
        return view('productos.delete', compact('producto'));
    }//delete

    public function destroy(Producto $producto)
    {

        //Si existe una imagen asociada
        if($producto->imagen && \Storage::disk('public')->exists($producto->imagen)){
            \Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();
        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');

    }//destroy





}//ProductoController
