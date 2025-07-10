<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [\App\Http\Controllers\HomeController::class, 'home'])
    ->name('home');
Route::get('/quienes-somos', [\App\Http\Controllers\AboutController::class, 'about'])
    ->name('about');
// Route::get('/movies', [\App\Http\Controllers\MovieController::class, 'index'])->name('movies.index');
// Route::get('/producto', [\App\Http\Controllers\ProductoController::class, 'index'])
//     ->name('producto.index');

Route::get('/blogs', [\App\Http\Controllers\BlogController::class, 'index'])
    ->name('blogs.index')
    ->middleware('auth');


// Ver un blog individual
Route::get('/blog/{id}', [\App\http\Controllers\BlogController::class, 'view'])
    ->name('blogs.view')
    ->whereNumber('id');


// Editar
Route::get('/blog/{id}/editar', [\App\http\Controllers\BlogController::class, 'edit'])
        ->name('blogs.edit')
        ->whereNumber('id')
        ->middleware('auth');

// Actualizar
Route::put('/blog/{id}', [\App\http\Controllers\BlogController::class, 'update'])
        ->name('blogs.update')
        ->whereNumber('id')
        ->middleware('auth');


//Eliminar
Route::get('/blog/{id}/eliminar', [\App\http\Controllers\BlogController::class,'delete'])
    ->name('blogs.delete')
    ->middleware('auth');

Route::delete('/blog/{id}', [\App\http\Controllers\BlogController::class, 'destroy'])
        ->name('blogs.destroy')
        ->whereNumber('id')
        ->middleware('auth');


//Mostrar formulario para crear una entrada
Route::get('/blogs/crear',  [\App\http\Controllers\BlogController::class, 'create'])
    ->name('blogs.create')
    ->middleware('auth');

//Guardar entrada en la base de datos
Route::post('/blogs', [\App\http\Controllers\BlogController::class, 'store'])
    ->name('blogs.store')
    ->middleware('auth');


// Mostrar formulario de login
Route::get('/iniciar-sesion', [\App\http\Controllers\AuthController::class, 'login'])->name('auth.login');

// Procesar login
Route::post('/iniciar-sesion', [\App\http\Controllers\AuthController::class, 'authenticate'])->name('auth.authenticate');

// Mostrar formulario de registro
Route::get('/registro', [\App\http\Controllers\AuthController::class, 'showRegister'])->name('auth.register');

// Procesar registro
Route::post('/registro', [\App\http\Controllers\AuthController::class, 'register'])->name('auth.register.submit');

// Cerrar sesión
Route::post('cerrar-sesion', [\App\http\Controllers\AuthController::class, 'logout'])->name('auth.logout');



//Ver Usuarios registrados
Route::get('/admin/usuarios', [\App\Http\Controllers\UsuarioController::class, 'index'])
    ->name('admin.usuarios.index')
    ->middleware('auth');

//DASHBOARD
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth', 'admin']);

//PRODUCTOS
Route::get('/producto', [\App\Http\Controllers\ProductoController::class, 'index'])
    ->name('producto.index');


//Ver formulario para crear un producto
Route::get('/producto/crear', [\App\Http\Controllers\ProductoController::class, 'create'])
    ->name('producto.create')
    ->middleware(['auth', 'admin']);

//Guardar un nuevo producto
Route::post('/producto', [\App\Http\Controllers\ProductoController::class, 'store'])
    ->name('producto.store')
    ->middleware(['auth', 'admin']);

//Editar un producto
Route::get('/producto/{producto}/editar', [\App\Http\Controllers\ProductoController::class, 'edit'])
    ->name('producto.edit')
    ->middleware(['auth', 'admin']);

// Actualizar un producto
Route::put('/producto/{producto}', [\App\Http\Controllers\ProductoController::class, 'update'])
    ->name('producto.update')
    ->middleware(['auth', 'admin']);


// Eliminar un producto
Route::get('/producto/{producto}/eliminar', [\App\http\Controllers\ProductoController::class,'delete'])
    ->name('producto.delete')
    ->middleware('auth', 'admin');


Route::delete('/producto/{producto}', [\App\Http\Controllers\ProductoController::class, 'destroy'])
    ->name('producto.destroy')
    ->middleware(['auth', 'admin']);


//Compras
Route::get('/carrito', [\App\Http\Controllers\CompraController::class, 'index'])
    ->name('compras.index')
    ->middleware('auth');

//Agregar producto al carrito
Route::post('/carrito', [\App\Http\Controllers\CompraController::class, 'store'])
    ->name('compras.store')
    ->middleware('auth');

//Actualiza cantidad del producto en el carrito
Route::put('/carrito/{compra}', [\App\Http\Controllers\CompraController::class, 'update'])
    ->name('compras.update')
    ->middleware('auth');

//Eliminar producto del carrito
Route::delete('/carrito/{carrito}', [\App\Http\Controllers\CompraController::class, 'destroy'])
    ->name('compras.destroy')
    ->middleware('auth');



//Vistas para confirmación o negación de la compra
Route::get('/carrito/exito', [\App\Http\Controllers\CompraController::class, 'success'])
    ->name('compras.success')
    ->middleware('auth');

Route::get('/carrito/pendiente', [\App\Http\Controllers\CompraController::class, 'pending'])
    ->name('compras.pending')
    ->middleware('auth');

Route::get('/carrito/error', [\App\Http\Controllers\CompraController::class, 'error'])
    ->name('compras.failure')
    ->middleware('auth');
