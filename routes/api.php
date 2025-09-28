<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController as ControllersLoginController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\NombreDelControlador;
use App\Http\Controllers\LimiteController;
use App\Http\Controllers\MetodoController;
use App\Http\Controllers\PerdidaController;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Cliente;
use App\Models\Limite;
use App\Models\Metodo;
use App\Models\Perdida;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login',[ControllersLoginController::class,'login']);

Route::get('categorias',[CategoriaController::class,'listAPI']);
Route::post('categoria',[CategoriaController::class,'getAPI']);
Route::post('categoria/guardar',[CategoriaController::class,'saveAPI']);
//Route::post('categoria/actu',[CategoriaController::class,'updateAPI']);
Route::put('categoria/{id}/actu',[CategoriaController::class,'updateAPI']);
Route::delete('categoria/{id}/borrar',[CategoriaController::class,'deleteAPI']);

Route::get('subcategorias',[SubcategoriaController::class,'listAPI']);
Route::post('subcategoria',[SubcategoriaController::class,'getAPI']);
Route::post('subcategoria/guardar',[SubcategoriaController::class,'saveAPI']);
Route::put('subcategoria/{id}/actu',[SubcategoriaController::class,'updateAPI']);
Route::delete('subcategoria/{id}/borrar',[SubcategoriaController::class,'deleteAPI']);

Route::get('clientes',[ClienteController::class,'listAPI']);
Route::post('cliente',[ClienteController::class,'getAPI']);
Route::post('cliente/guardar',[ClienteController::class,'saveAPI']);
Route::put('cliente/{id}/actu',[ClienteController::class,'updateAPI']);
Route::delete('cliente/{id}/borrar',[ClienteController::class,'deleteAPI']);

Route::get('categ',[NombreDelControlador::class,'listAPIC']);
Route::post('cate',[NombreDelControlador::class,'getAPIC']);
Route::get('subcat',[NombreDelControlador::class,'listAPIS']);
Route::post('subca',[NombreDelControlador::class,'getAPIS']);

Route::get('limites',[LimiteController::class,'listAPI']);
Route::post('limite',[LimiteController::class,'getAPI']);
Route::post('limite/guardar',[LimiteController::class,'saveAPI']);
Route::put('limite/{id}/actu',[LimiteController::class,'updateAPI']);
Route::delete('limite/{id}/borrar',[LimiteController::class,'deleteAPI']);

Route::get('metodos',[MetodoController::class,'listAPI']);
Route::post('metodo',[MetodoController::class,'getAPI']);
Route::post('metodo/guardar',[MetodoController::class,'saveAPI']);
Route::put('metodo/{id}/actu',[MetodoController::class,'updateAPI']);
Route::delete('metodo/{id}/borrar',[MetodoController::class,'deleteAPI']);

Route::get('perdidas',[PerdidaController::class,'listAPI']);
Route::post('perdida',[PerdidaController::class,'getAPI']);
Route::post('perdida/guardar',[PerdidaController::class,'saveAPI']);
Route::post('perdida/actu',[PerdidaController::class,'updateAPI']);
Route::post('perdida/borrar',[PerdidaController::class,'deleteAPI']);