<?php

use App\Http\Controllers\EspeciesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CobroPendienteController;
use App\Http\Controllers\InventarioEspecieController;
use App\Http\Controllers\InventarioZonaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('login');
});
  */
//Auth::routes();

//Route::resource('/home', 'HomeController@index');//->name('home');
Route::get('/', [LoginController::class, 'index']);
//Route::get('/home', [HomeController::class, 'index']);
Route::get('/mantenimientoUser', [UsersController::class, 'mantenimientoUser'])->name('mantenimientoUser');
Route::get('/ETL', [Controller::class, 'ETL'])->name('ETL');
Route::get('/respaldo_restauracion', [Controller::class, 'respaldo_restauracion'])->name('respaldo_restauracion');
Route::get('/cobro_especies', [CobroPendienteController::class, 'cobro_especies'])->name('cobro_especies');
Route::get('/inventario_especies', [InventarioEspecieController::class, 'inventario_especies'])->name('inventario_especies');
Route::get('/especies_disponibles', [EspecieController::class, 'especies_disponibles'])->name('especies_disponibles');
Route::get('/cobros_zonas', [CobradorController::class, 'cobros_zonas'])->name('cobros_zonas');
Route::get('/especies_vendidas_zonas', [VentaController::class, 'especies_vendidas_zonas'])->name('especies_vendidas_zonas');
Route::get('/inventario_zonas', [InventarioZonaController::class, 'inventario_zonas'])->name('inventario_zonas');
//Route::get('/inventario_zonas', [InventarioZonaController::class, 'inventario_zonas'])->name('inventario_zona');
Route::get('/ETL/carga', [Controller::class, 'ejecucion'])->name('ejecucion');

Route::resource('users', 'UsersController'); //->middleware('can:isAdmin');
Route::resource('roles', 'RolesController'); //->middleware('can:isAdmin');
Route::resource('especie', 'EspecieController'); //->middleware('especies:isAdmin,isOperativo');
Route::resource('venta', 'VentaController'); //->middleware('especies:isAdmin,isOperativo');

Route::resource('cobrador', 'CobradorController'); //->middleware('especies:isAdmin,isOperativo');
Route::resource('embargo', 'EmbargoController'); //->middleware('especies:isAdmin,isOperativo');
// Route::get('especies/{especies}','EspecieController@show')->name('especies.show');

//Route::resource('users', 'UsersController')->middleware('especies:isAdmin,isOperativo');

// Route::resource('zonas', 'ZonasController', ['onlye' =>['index','create','edit','update','store'] ])->middleware('especies:isAdmin,isOperativo');
Route::resource('zonas', 'ZonasController'); //->middleware('especies:isAdmin,isOperativo');
Route::post('/actualizarzona', 'ZonasController@actualizarzona'); //->name('actualizarzona');

Route::resource('inventarioZonas', 'InventarioZonaController'); //->middleware('especies:isAdmin,isOperativo');

Route::get('/pdf', 'PDFController@PDF'); //->name('descargarPDF');

Route::get('/pdfVentas', 'PDFController@PDFVentas'); //->name('descargarPDFVentas');

Route::resource('cuenta', 'CuentaController'); //->middleware('especies:isAdmin,isOperativo');

Route::resource('cheque', 'ChequeController'); //->middleware('especies:isAdmin,isOperativo');

Route::post('/banco', 'ChequeController@getCuentasBancarias');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
