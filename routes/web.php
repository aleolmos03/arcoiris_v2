<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//---Sistema---
Route::get('/backups', [App\Http\Controllers\Admin\BackupController::class, 'index'])->name('index');
Route::post('/backups/crear', [App\Http\Controllers\Admin\BackupController::class,  'store']);

//--History
//Route::get('historial/', [App\Http\Controllers\Admin\LoginController::class, 'index'])->name('index');
Route::get('/historial/{filtro}', [App\Http\Controllers\Admin\LoginController::class, 'index'])->name('index');

//---Profile---
Route::get('/perfil', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('edit');
Route::post('/perfil/editar',[App\Http\Controllers\Admin\ProfileController::class, 'update']);

//---Actualizar contraseña
Route::post('/perfil/actualizar', [App\Http\Controllers\Admin\ProfileController::class, 'update']);

//---Finalizar voluntariado
Route::post('/perfil/fin', [App\Http\Controllers\Admin\ProfileController::class, 'update']);

//---Usuarios---
Route::get('/usuarios', [App\Http\Controllers\Web\UserController::class, 'index'])->name('index');
Route::get('/usuario/{id}', [App\Http\Controllers\Web\UserController::class, 'show'])->name('show');

Route::post('/usuarios/pdf/{estado}/{rol}/{orden}/{tblood}/{buscar}', [App\Http\Controllers\Web\UserController::class, 'index_pdf'])->name('index_pdf');

Route::get('/usuario', [App\Http\Controllers\Web\UserController::class, 'create'])->name('create');
Route::post('/usuario/crear', [App\Http\Controllers\Web\UserController::class, 'store']);

Route::get('/usuario/{id}/editar', [App\Http\Controllers\Web\UserController::class, 'edit'])->name('edit');
Route::post('/usuario/{id}/actualizar', [App\Http\Controllers\Web\UserController::class, 'update']);
Route::post('/usuario/{id}/fin', [App\Http\Controllers\Web\UserController::class, 'update_end']);

Route::get('/usuario/{id}/borrar', [App\Http\Controllers\Web\UserController::class, 'destroy'])->name('destroy');


