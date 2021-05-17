<?php

namespace App\Http\Controllers;

use App\Cliente as AppCliente;
use App\Trabajo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $user_id = Auth::user()->id;
        $new = new Trabajo();
        $new->create([
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'user_id' => $user_id,
            'cliente_id' => $request->cliente,
            'created_at' => $request->fecha,
            'fecha_entrega' => null,
            'estado' => 0

        ]);
        return back();
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
       
        $cant = json_decode(json_encode(DB::select('SELECT COUNT(estado) as total FROM trabajos WHERE estado = 0 and user_id ='.Auth::user()->id)), true);

        $flag = false;
        foreach (Auth::user()->trabajos as $t) {
            if ($id == $t->id) {
                $flag = true;
            }
        }
        if (!$flag) {
            return redirect()->to('/');
        }

        $trabajo = Trabajo::findOrFail($id);
        $accion = 'editar';
        $user = User::findOrFail(Auth::user()->id);
        $trabajos = DB::select('select t.*, c.nombre from trabajos t inner join clientes as c on c.id = t.cliente_id and t.user_id = ?', [Auth::user()->id]);

        return view('gestor.crear_trabajo', ['name' => 'Trabajos', 'lista_trabajos' => $trabajos, 'clientes' => $user->clientes, 'accion' => $accion, 'trabajo' => $trabajo,'cant'=>$cant[0]['total']]);
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
       
        $user_id = Auth::user()->id;
        $new =  Trabajo::findOrFail($id);

        $new->descripcion = $request->descripcion;
        $new->precio = $request->precio;
        $new->user_id = $user_id;
        $new->cliente_id = $request->cliente;
        $new->created_at = $request->fecha; 
        $new->save();
            
    }

    public function update_estado($id)
    {
        date_default_timezone_set('UTC');
        date_default_timezone_set("America/Costa_Rica");
        $flag = false;
        foreach (Auth::user()->trabajos as $t) {
            if ($id == $t->id) {
                $flag = true;
            }
        }
        if (!$flag) {
            return redirect()->to('/');
        } 
        $estado = DB::select('SELECT (case estado when 1 then 0 else 1 end) as estado from trabajos WHERE id = ?', [$id]);
        
        $fecha = DB::select('SELECT (case estado when 1 then null else ? end) as fecha from trabajos WHERE id = ?', [date('Y-m-d'),$id]);
       
        DB::update('update trabajos set estado = ?, fecha_entrega = ? where id = ?', [$estado[0]->estado,$fecha[0]->fecha,$id]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $trabajo = Trabajo::findOrFail($id);
        $trabajo->delete();
        return back();
    }
}
