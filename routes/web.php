<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\PlanesController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FotoestudioController;
use App\Http\Controllers\OrganizadorController;
use App\Http\Controllers\SuscripcionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FotosController;

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
    return view('index');
});

// Route::get('/dashboard',[AuthenticatedSessionController::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', function () {
    return view('index');
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

    ////////////////////////////////////////////////////////////////////////////////fotos
    Route::resource('foto',FotosController::class)
    ->Parameters(['foto' => 'f'])->names('foto');

    ////////////////////////////////////////////////////////////////////////////////ventas
    Route::resource('ventas',VentaController::class)
    ->Parameters(['ventas' => 'v'])->names('ventas');

    ////////////////////////////////////////////////////////////////////////////////
    Route::resource('/planes',PlanesController::class )
    ->Parameters(['planes' => 'p'])->names('planes');
    ////////////////////////////////////////////////////////////////////////////////
    Route::get('compararFotos',[FotoestudioController::class,'compararFotos'])->name('compararFotos');
});

require __DIR__.'/auth.php';

Route::get('/template', function () {return view('template.template');})->name('template');
Route::get('/template2', function () {
    $id = auth()->user()->id;
    $usuario = User::join('clientes','clientes.user_id','=','users.id')
    ->where('user_id','=',$id)->first();
    return view('template.profile',compact('usuario'));})->name('template2');
Route::get('/template3', function () {return view('index');})->name('template3');
Route::get('/pages/billing.html', function () {return view('pages/billing');})->name('pages/billing');
Route::get('/pages/dashboard.html', function () {return view('pages/dashboard');})->name('pages/dashboard');
Route::get('/pages/profile.html', function () {return view('pages/profile');})->name('pages/profile');
// Route::get('/pages/rtl.html', function () {return view('pages/rtl');})->name('pages/rtl');
Route::get('/pages/sign-in.html', function () {return view('pages/sign-in');})->name('pages/sign-in');
Route::get('/pages/sign-up.html', function () {return view('pages/sign-up');})->name('pages/sign-up');
Route::get('/pages/tables.html', function () {return view('pages/tables');})->name('pages/tables');
// Route::get('/pages/virtual-reality.html', function () {return view('pages/virtual-reality');})->name('pages/virtual-reality');
