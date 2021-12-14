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

//---actualizar contraseña
Route::get('/perfil/nuevo', [App\Http\Controllers\Admin\ProfileController::class, 'create'])->name('create');
Route::post('/perfil/actualizar',[App\Http\Controllers\Admin\ProfileController::class, 'update_pass']);
Route::post('/perfil/fin/{id}',[App\Http\Controllers\Admin\ProfileController::class, 'update_end']);

//---Usuarios---
Route::get('/usuarios', [App\Http\Controllers\Web\UserController::class, 'index'])->name('index');
Route::get('/usuarios/{id}',[App\Http\Controllers\Web\UserController::class, 'show'])->name('show');

