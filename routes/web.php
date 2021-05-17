<?php

use App\Cliente;
use App\Trabajo;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Event\ViewEvent;

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

Auth::routes();

// Route::get('/', function () {
//     $user_id = Auth::user()->id;
//         $new = new Trabajo();
//         $new->create([
//             'descripcion' => 'Empaques nuevos',
//             'precio' => '1600',
//             'user_id' => $user_id,
//             'cliente_id' => '3',
//             'created_at' => '2020-05-20 22:11:04',
//             'fecha_entrega' => null,
//             'estado' => 0
//         ]);
// });
 
Route::get('/', function () {
    if (Auth::user() == null) {
        return View('index');
    } else {
        return redirect()->to('/trabajos');
    }
});

//trabajos
Route::get('/trabajos', 'HomeController@index')->name('trabajos');
Route::post('/trabajos_store', 'TrabajoController@store')->name('trabajos.store');
Route::delete('/trabajos_destroy/{id}', 'TrabajoController@destroy')->name('trabajos.destroy');
Route::get('/trabajos_edit/{id}', 'TrabajoController@edit')->name('trabajos.edit');
Route::put('/trabajos_update/{id}', 'TrabajoController@update')->name('trabajos.update');
Route::get('/trabajos_update_estado/{id}', 'TrabajoController@update_estado')->name('trabajos.update_estado');



Route::get('/pendientes/{accion?}/{dato_uno?}/{dato_dos?}', 'PendienteController@index')->name('pendientes');

Route::get('/clientes', 'ClienteController@index')->name('clientes');
Route::post('/clientes_store', 'ClienteController@store')->name('clientes.store');
Route::get('/clientes_edit/{id}', 'ClienteController@edit')->name('clientes.edit');
Route::put('/clientes_update/{id}', 'ClienteController@update')->name('clientes.update');
Route::get('/clientes_show/{id}', 'ClienteController@show')->name('clientes.show');
Route::delete('/clientes_destroy/{id}', 'ClienteController@destroy')->name('clientes.destroy');

Route::get('/estadistica/{accion?}/{dato_uno?}/{dato_dos?}', 'EstadisticaController@index')->name('estadistica');
