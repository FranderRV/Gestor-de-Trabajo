<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PendienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($accion = 'c', $dato_uno = '', $dato_dos = 0)
    {

        if ($accion == 'cliente') {
            $flag = false;
            foreach (Auth::user()->clientes as $t) {
                if ($dato_uno == $t->id) {
                    $flag = true;
                }
            }

            if (!$flag) {
                return redirect()->to('/');
            }

        }


        $cant = json_decode(json_encode(DB::select('SELECT COUNT(estado) as total FROM trabajos WHERE estado = 0 and user_id ='.Auth::user()->id)), true);
        
        switch ($accion) {
            case 'cliente':
                $lista_t = DB::select('SELECT trabajos.*,clientes.nombre  from trabajos inner join clientes on trabajos.user_id = ? and clientes.id = trabajos.cliente_id and trabajos.cliente_id = ? and estado = 0 ', [Auth::user()->id, $dato_uno]);
                break;
            case 'precio':
                $lista_t = DB::select("SELECT trabajos.*,clientes.nombre  from trabajos inner join clientes on trabajos.user_id = ? and clientes.id = trabajos.cliente_id and trabajos.precio <= ? and estado = 0  ORDER by precio DESC", [Auth::user()->id, $dato_uno]);
                break;
            case 'fecha':
                $lista_t = DB::select('SELECT trabajos.*,clientes.nombre  from trabajos inner join clientes on trabajos.user_id = ? and clientes.id = trabajos.cliente_id  and trabajos.created_at = ? and estado = 0', [Auth::user()->id, $dato_uno]);
                break;
            default:
                $lista_t = DB::select('select t.*, c.nombre from trabajos t inner join clientes as c on c.id = t.cliente_id and t.user_id = ? and estado = 0', [Auth::user()->id]);;
                break;
        }
        return View('gestor.pendientes', ['accion' => $accion, 'name' => 'Pendientes', 'lista_t' => $lista_t, 'cant' => $cant[0]['total'], 'clientes' => Auth::user()->clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
