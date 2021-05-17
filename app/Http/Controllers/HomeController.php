<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Trabajo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        date_default_timezone_set('UTC');
        date_default_timezone_set("America/Costa_Rica");
        
        $fecha_actual = date('Y-m-d');
        $cant = json_decode(json_encode(DB::select('SELECT COUNT(estado) as total FROM trabajos WHERE estado = 0 and user_id ='.Auth::user()->id)), true);
        $accion = 'insertar';
      
        $user = User::findOrFail(Auth::user()->id);
        $trabajos = DB::select('select t.*, c.nombre from trabajos t inner join clientes as c on c.id = t.cliente_id and t.user_id = ?', [Auth::user()->id]);

        return view('gestor.crear_trabajo', ['name' => 'Trabajos', 'lista_trabajos' => $trabajos,'clientes' => $user->clientes,'accion'=>$accion, 'trabajo' => null,'cant'=>$cant[0]['total'],'fecha_actual'=>$fecha_actual]);
    }
}
