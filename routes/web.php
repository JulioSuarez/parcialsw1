<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\FotosController;
use App\Http\Controllers\VentaController;
// use App\Http\Controllers\EventoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FormatoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DiagramaController;
use App\Http\Controllers\InvitadoController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\OrdenPagoController;
use App\Http\Controllers\FotoestudioController;
use App\Http\Controllers\OrganizadorController;
use Laravel\Cashier\Http\Controllers\WebhookController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Mail\CorreosMailable;
use illuminate\Support\Facades\Mail;

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

Route::get('/novedades', [ClienteController::class, 'index'])->middleware('auth')->name('novedades');

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified']);

Route::get('/', function () {
    return view('auth.login');
});


// Route::get('/dashboard',[AuthenticatedSessionController::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/old', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard.old');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    ////////////////////////////////////////////////////////////////////////////////eventos
    Route::resource('Cliente', clienteController::class)
        ->Parameters(['cliente' => 'c'])->names('Cliente');

    ////////////////////////////////////////////////////////////////////////////////eventos
    // Route::resource('evento', EventoController::class)
    //     ->Parameters(['evento' => 'e'])->names('evento');

    ////////////////////////////////////////////////////////////////////////////////organizadores
    Route::resource('organizadores', OrganizadorController::class)
        ->Parameters(['organizadores' => 'o'])->names('organizadores');

    Route::get('organizadores.reportes', [OrganizadorController::class, 'reportes'])->middleware('auth')->name('organizadores.reportes');
    Route::post('organizadores.aprobado', [OrganizadorController::class, 'aprobadoTodo'])->middleware('auth')->name('organizadores.aprobado');
    Route::post('organizadores.aprobado.store', [OrganizadorController::class, 'aprobadoTodoStore'])->middleware('auth')->name('organizadores.aprobado.store');
    ////////////////////////////////////////////////////////////////////////////////fotoestudio
    Route::resource('fotoestudio', FotoestudioController::class)
        ->Parameters(['fotoestudio' => 'f'])->names('fotoestudio');

    Route::get('fotoestudio.reportes', [FotoestudioController::class, 'reportes'])->middleware('auth')->name('fotoestudio.reportes');
    Route::post('subir.fotos', [FotoestudioController::class, 'create'])->name('subir.fotos');
    Route::post('subir.fotos.store', [FotoestudioController::class, 'store'])->name('subir.fotos.store');
    ////////////////////////////////////////////////////////////////////////////////fotos
    Route::resource('foto', FotosController::class)
        ->Parameters(['foto' => 'f'])->names('foto')->except(['create']);
    ////////////////////////////////////////////////////////////////////////////////ventas
    Route::resource('ventas', VentaController::class)
        ->Parameters(['ventas' => 'v'])->names('ventas');

    ////////////////////////////////////////////////////////////////////////////////ventas
    Route::resource('orden', OrdenPagoController::class)
        ->Parameters(['orden' => 'o'])->names('orden');
    ////////////////////////////////////////////////////////////////////////////////
    Route::get('/pagos', [PagoController::class, 'index'])->middleware('auth')->name('metodo.pagos');
    ////////////////////////////////////////////////////////////////////////////////
    Route::get('/suscripcion', [PagoController::class, 'suscripcion2'])->middleware('auth')->name('suscripcion');
    ////////////////////////////////////////////////////////////////////////////////
    Route::get('/felicidades', [PagoController::class, 'suscripcionPagada'])->middleware('auth')->name('felicidades');
    ////////////////////////////////////////////////////////////////////////////////
    Route::get('/suscripcion.fallida', [PagoController::class, 'suscripcionFallida'])->middleware('auth')->name('suscripcion.fallida');
    ////////////////////////////////////////////////////////////////////////////////
    Route::get('compararFotos', [FotoestudioController::class, 'compararFotos'])->name('compararFotos');
    ////////////////////////////////////////////////////////////////////////////////
    Route::get('crear.evento', [OrganizadorController::class, 'crearEvento'])->middleware('auth')->name('crear.evento');
    ////////////////////////////////////////////////////////////////////////////////
});

require __DIR__ . '/auth.php';

Route::get('/template', function () {
    return view('template.template');
})->name('template');
Route::get('/template2', function () {
    $id = auth()->user()->id;
    $usuario = User::join('clientes', 'clientes.user_id', '=', 'users.id')
        ->where('user_id', '=', $id)->first();
    return view('template.profile', compact('usuario'));
})->name('template2');
Route::get('/template3', function () {
    return view('index');
})->name('template3');
Route::get('/pages/billing', function () {
    return view('pages/billing');
})->name('pages/billing');
Route::get('/pages/dashboard.html', function () {
    return view('pages/dashboard');
})->name('pages/dashboard');
Route::get('/pages/profile.html', function () {
    return view('pages/profile');
})->name('pages/profile');
// Route::get('/pages/rtl.html', function () {return view('pages/rtl');})->name('pages/rtl');
Route::get('/pages/sign-in.html', function () {
    return view('pages/sign-in');
})->name('pages/sign-in');
Route::get('/pages/sign-up.html', function () {
    return view('pages/sign-up');
})->name('pages/sign-up');
Route::get('pages.tables', function () {
    return view('pages/tables');
})->name('pages.tables');
// Route::get('/pages/virtual-reality.html', function () {return view('pages/virtual-reality');})->name('pages/virtual-reality');
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
Route::post(
    '/stripe/webhook',
    [WebhookController::class, 'handleWebhook']
);

Route::get('cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('cart.add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('cart.remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('cart.update', [CartController::class, 'updateCart'])->name('cart.update');

Route::resource('diagramas', DiagramaController::class)
    ->Parameters(['diagramas' => 'd'])->names('diagramas')->except(['create','edit','update']);
Route::get('diagramas.edit', [DiagramaController::class, 'edit'])->name('diagramas.edit');
Route::get('diagramas.create', [DiagramaController::class, 'create'])->name('diagramas.create');

Route::post('diagramador', [DiagramaController::class, 'diagramador'])->name('diagramador');

Route::resource('formato', FormatoController::class)
    ->Parameters(['formato' => 'f'])->names('formato');
    Route::get('tipo.dato', [FormatoController::class, 'tipoDato'])->name('tipo.dato');
    Route::post('storeTipoDato', [FormatoController::class, 'storeTipoDato'])->name('storeTipoDato');

Route::resource('clase', ClaseController::class)
    ->Parameters(['clase' => 'c'])->names('clase')->except(['store','update']);

Route::post('relacionStore', [ClaseController::class, 'relacionStore'])->name('relacionStore');
Route::post('relacionUpdate', [ClaseController::class, 'relacionUpdate'])->name('relacionUpdate');
Route::post('relacionDestroy', [ClaseController::class, 'relacionDestroy'])->name('relacionDestroy');
Route::post('claseStore', [ClaseController::class, 'store'])->name('claseStore');
Route::post('claseUpdate', [ClaseController::class, 'update'])->name('clase.update');

Route::resource('relaciones', RelationController::class)
    ->Parameters(['relaciones' => 'r'])->names('relaciones');

Route::post('invitados.create', [InvitadoController::class, 'create'])->name('invitados.create');
Route::post('invitados.store', [InvitadoController::class, 'store'])->name('invitados.store');
// Route::post('invitados', [CorreosMailable::])->name('invitados.store');
Route::get('atributos', [ClaseController::class, 'atributos'])->name('atributos');
Route::post('atributoStore', [ClaseController::class, 'atributoStore'])->name('atributoStore');
Route::get('atributoTipo', [ClaseController::class, 'atributoTipo'])->name('atributoTipo');
Route::post('atributoTipoStore', [ClaseController::class, 'atributoTipoStore'])->name('atributoTipoStore');


Route::get('postgresql{d}', [DiagramaController::class, 'postgresql'])->name('postgresql');
Route::get('sqlserver{d}', [DiagramaController::class, 'sqlserver'])->name('sqlserver');

// Route::resource('sintaxis', SintaxiController::class)
// ->Parameters(['sintaxis' => 's'])->names('sintaxis');   //ya no usar

Route::get('pruebas', [DiagramaController::class, 'readData'])->name('pruebas');
// Route::get('/iprueba', function () {
//     return view('VistaEmail.index');
// });
