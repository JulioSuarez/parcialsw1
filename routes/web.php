<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\FotoestudioController;
use App\Http\Controllers\OrganizadorController;
use App\Http\Controllers\PlanesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuscripcionController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    ////////////////////////////////////////////////////////////////////////////////clientes
    Route::resource('cliente',ClienteController::class)//->except(['show'])
    ->Parameters(['cliente' => 'c'])->names('Cliente');

    ////////////////////////////////////////////////////////////////////////////////suscripcion
    Route::resource('suscripcion',SuscripcionController::class)
    ->Parameters(['suscripcion' => 's'])->names('suscripcion');

    ////////////////////////////////////////////////////////////////////////////////eventos
    Route::resource('evento',EventoController::class)
    ->Parameters(['evento' => 'e'])->names('evento');

    ////////////////////////////////////////////////////////////////////////////////organizadores
    Route::resource('organizadores',OrganizadorController::class)
    ->Parameters(['organizadores' => 'o'])->names('organizadores');

    ////////////////////////////////////////////////////////////////////////////////fotoestudio
    Route::resource('fotoestudio',FotoestudioController::class)
    ->Parameters(['fotoestudio' => 'f'])->names('fotoestudio');

    ////////////////////////////////////////////////////////////////////////////////ventas
    Route::resource('ventas',VentaController::class)
    ->Parameters(['ventas' => 'v'])->names('ventas');

    ////////////////////////////////////////////////////////////////////////////////
    Route::resource('/planes',PlanesController::class )
    ->Parameters(['planes' => 'p'])->names('planes');
    ////////////////////////////////////////////////////////////////////////////////
});

require __DIR__.'/auth.php';

Route::get('/template', function () {return view('template.template');})->name('template');
Route::get('/template2', function () {return view('template.profile');})->name('template2');
Route::get('/template3', function () {return view('template.dashboard');})->name('template3');
