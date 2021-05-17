<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstadisticaController extends Controller
{
    public function index($accion = 'general', $dato_uno = '', $dato_dos = '')
    {

        date_default_timezone_set('UTC');
        date_default_timezone_set("America/Costa_Rica");
        $mes_anterior = date("Y") . '-' . date('m', strtotime('-1 month')) . '-' . date("d");

        $monto_general = 0;
        $monto_general_entregados = 0;
        $cant_consulta = 0;
        $monto_mes = 0;
        $cant = 0;
        $cant2 = 0;
        $cant_trab = 0;
        switch ($accion) {
            case 'general':
                foreach (Auth::user()->clientes as $c) {
                    foreach ($c->trabajos as $t) {
                        $monto_general += $t->precio;
                    }
                }
                $monto_mes = json_decode(json_encode(DB::select('SELECT sum(precio) as total FROM trabajos WHERE fecha_entrega BETWEEN ? and ? and trabajos.user_id = ?', [$mes_anterior, date("Y-m-d"), Auth::user()->id])), true);

                $monto_general_entregados = json_decode(json_encode(DB::select('SELECT sum(precio) as total FROM trabajos where trabajos.user_id = ? and estado = ?', [Auth::user()->id, 1])), true);

                $cant_consulta = json_decode(json_encode(DB::select('SELECT COUNT(estado) as total FROM trabajos WHERE estado = 0 and trabajos.user_id = ' . Auth::user()->id)), true);

                $cant2 = json_decode(json_encode(DB::select('SELECT COUNT(estado) as total FROM trabajos WHERE estado = 1 and trabajos.user_id = ' . Auth::user()->id)), true);

                $cant_trab = json_decode(json_encode(DB::select('SELECT COUNT(estado) as total FROM trabajos where trabajos.user_id = ' . Auth::user()->id)), true);

                break;
            case 'fecha':

                foreach (Auth::user()->clientes as $c) {
                    foreach ($c->trabajos as $t) {
                        $monto_general += $t->precio;
                    }
                }
                $monto_mes = json_decode(json_encode(DB::select('SELECT sum(precio) as total FROM trabajos WHERE fecha_entrega BETWEEN ? and ? and trabajos.user_id = ?', [$dato_uno, $dato_dos, Auth::user()->id])), true);

                $monto_general_entregados = json_decode(json_encode(DB::select('SELECT sum(precio) as total FROM trabajos where fecha_entrega BETWEEN ? and ? and trabajos.user_id = ? and estado = ?', [$dato_uno, $dato_dos,Auth::user()->id, 1])), true);

                $cant_consulta = json_decode(json_encode(DB::select('SELECT COUNT(estado) as total FROM trabajos WHERE created_at BETWEEN ? and ? and estado = 0 and trabajos.user_id = ' . Auth::user()->id,[$dato_uno, $dato_dos])), true);

                $cant2 = json_decode(json_encode(DB::select('SELECT COUNT(estado) as total FROM trabajos WHERE fecha_entrega BETWEEN ? and ? and  estado = 1 and trabajos.user_id = ' . Auth::user()->id,[$dato_uno, $dato_dos])), true);

                $cant_trab = json_decode(json_encode(DB::select('SELECT COUNT(estado) as total FROM trabajos where created_at BETWEEN ? and ? and  trabajos.user_id = ' . Auth::user()->id,[$dato_uno, $dato_dos])), true);

                break;
            default:
                break;
        }

        //SELECT sum(precio) as total FROM trabajos WHERE fecha_entrega BETWEEN '2020-07-25' and '2020-07-26' and trabajos.user_id = 1 

        
        $cant = json_decode(json_encode(DB::select('SELECT COUNT(estado) as total FROM trabajos WHERE estado = 0 and trabajos.user_id = ' . Auth::user()->id)), true);

        return view('gestor.estadistica', ['cant_consulta'=>$cant_consulta[0]['total'],'name' => 'Estadística', 'cant' => $cant[0]['total'], 'entregados' => $cant2[0]['total'], 'trabajos' => $cant_trab[0]['total'], 'monto_general_entregados' => number_format($monto_general_entregados[0]['total'], 0, ',', ','), 'monto_general' => number_format($monto_general, 0, ',', ','), 'monto_mes' =>number_format($monto_mes[0]['total'], 0, ',', ',')]);

        
    }
}
