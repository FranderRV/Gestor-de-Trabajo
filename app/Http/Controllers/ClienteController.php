<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cant = json_decode(json_encode(DB::select('SELECT COUNT(estado) as total FROM trabajos WHERE estado = 0 and user_id ='.Auth::user()->id)), true);
        $lista = [];
        foreach (Auth::user()->clientes as $c) {
            $monto = 0;
            foreach ($c->trabajos as $trab) {
                $monto += ($trab->precio);
            }
            $lista[] = [
                'id' => $c->id,
                'nombre' => $c->nombre,
                'telefono' => $c->telefono,
                'trabajos' => count($c->trabajos),
                'monto' => $monto,
            ];
        }

        return view('gestor.clientes', ['name' => 'Clientes', 'cant' => $cant[0]['total'], 'cliente' => null, 'clientes' => $lista,'accion'=>'insertar']);
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
        $cliente = new Cliente();
        $cliente->create([
            'nombre' =>  $request->nombre,
            'telefono' => $request->telefono ,
            'user_id' => Auth::user()->id,
            
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
        $flag = false;
        foreach (Auth::user()->clientes as $t) {
            if ($id == $t->id) {
                $flag = true;
            }
        }
        if (!$flag) {
            return redirect()->to('/');
        } 

       

        $cliente_trabajos =Cliente::findOrFail($id);
        $monto_ind = 0;
        foreach ($cliente_trabajos->trabajos as $t) {
            $monto_ind+=$t->precio;
        }


        $cant = json_decode(json_encode(DB::select('SELECT COUNT(estado) as total FROM trabajos WHERE estado = 0')), true);
        $lista = [];
        foreach (Auth::user()->clientes as $c) {
            $monto = 0;
            foreach ($c->trabajos as $trab) {
                $monto += ($trab->precio);
            }
            $lista[] = [
                'id' => $c->id,
                'nombre' => $c->nombre,
                'telefono' => $c->telefono,
                'trabajos' => count($c->trabajos),
                'monto' => number_format($monto, 0, ',', ',')
            ];
        }

        return view('gestor.clientes', ['name' => 'Clientes', 'cant' => $cant[0]['total'], 'cliente' =>  $cliente_trabajos, 'clientes' => $lista,'accion'=>'ver','trabajos_cliente'=>$cliente_trabajos->trabajos,'monto_ind'=>number_format($monto_ind, 0, ',', ',')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
       

        $flag = false;
        foreach (Auth::user()->clientes as $t) {
            if ($id == $t->id) {
                $flag = true;
            }
        }
        if (!$flag) {
            return redirect()->to('/');
        } 

        $cliente_trabajos =Cliente::findOrFail($id);
        $cant = json_decode(json_encode(DB::select('SELECT COUNT(estado) as total FROM trabajos WHERE estado = 0')), true);
        $lista = [];
        foreach (Auth::user()->clientes as $c) {
            $monto = 0;
            foreach ($c->trabajos as $trab) {
                $monto += ($trab->precio);
            }
            $lista[] = [
                'id' => $c->id,
                'nombre' => $c->nombre,
                'telefono' => $c->telefono,
                'trabajos' => count($c->trabajos),
                'monto' => $monto,
            ];
        }

        return view('gestor.clientes', ['name' => 'Clientes', 'cant' => $cant[0]['total'], 'cliente' => $cliente_trabajos, 'clientes' => $lista,'accion'=>'editar']);
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
        $flag = false;
        foreach (Auth::user()->clientes as $t) {
            if ($id == $t->id) {
                $flag = true;
            }
        }
        if (!$flag) {
            return redirect()->to('/');
        } 

        $cliente_trabajos =Cliente::findOrFail($id);
        $cliente_trabajos->update([
            'nombre'=>$request->nombre,
            'telefono'=>$request->telefono,
        ]);
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
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return back();
    }
}
