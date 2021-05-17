@extends('gestor.plantilla')
@section('cuerpo')
<style>
    .card {
        background-color: #32373d;
        color: yellow;
    }
</style>
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-sm-6 p-2">
            <div class="card" style="width: auto;">
                <div class="card-header text-center " style="font-size: 20px">
                    CREAR CLIENTE
                </div>
                <div class="card-body">
                    <form
                        action="{{ $accion == 'insertar'?route('clientes.store'):route('clientes.update',$  ->id) }} "
                        id="" method="POST">
                        @csrf
                        @switch($accion)

                        @case('insertar')
                        @method('POST')
                        @break

                        @case('editar')
                        @method('PUT')
                        @break
                        @default

                        @endswitch
                        <div class="form-group">
                            <label for="descripcion">Nombre</label>
                            <input type="text" class="form-control" id="nombre" aria-describedby="nombre" name="nombre"
                                placeholder="Nombre" value="{{  $cliente!=null? $cliente['nombre']:'' }}">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Telefono</label>
                            <input type="text" class="form-control" id="telefono" aria-describedby="telefono"
                                name="telefono" placeholder="Telefono"
                                value="{{  $cliente!=null? $cliente['telefono']:'' }}">
                        </div>
                        <div class="form-group">

                            @if ($accion=='ver')    
                            <div class="card">
                                <div class="card-header">
                                    <div class="row ">
                                        <div class="col-6">
                                            Trabajos del cliente
                                        </div>
                                        <div class="col-6 text-right   ">Ingreso: ₡{{ $monto_ind }}</div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <table class="myTable table table-light table-responsive " style="">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="color: yellow">Descripción</th>
                                        <th style="color: yellow">Precio</th>
                                        <th style="color: yellow">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trabajos_cliente as $t)
                                    <tr>
                                        <td>{{ $t->descripcion }}</td>
                                        <td>{{ $t->precio }}</td>
                                        <td>
                                            <div class="row justify-content-end  ">

                                                <div class="col-12 md-3">
                                                    <form action="{{ route('trabajos.destroy',$t->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf

                                                        <a href="{{ route('trabajos.update_estado',$t->id) }}"
                                                            class="btn btn-small btn-{{  $t->estado==1?'success':'danger' }} text-light fa fa-toggle-{{ $t->estado==0?'off':'on' }} mt-2"
                                                            data-toggle="tooltip" data-placement="left"
                                                            title="{{ $t->estado==0?'Pendiente':'Entregado' }}"></a>

                                                        <a href="{{ route('trabajos.edit',$t->id) }}"
                                                            class="btn btn-small btn-warning text-light mt-2"
                                                            data-toggle="tooltip" data-placement="left"
                                                            title="Editar"><span class="fa fa-edit"></span></a>
                                                        <button type="submit"
                                                            class="btn btn-small btn-danger text-light mt-2"
                                                            data-toggle="tooltip" data-placement="left"
                                                            title="Eliminar"><span class="fa fa-trash"></span></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                            @endif
                        </div>
                        @if ($accion!='ver')
                        <button
                            class="btn btn-block btn-{{ $accion=='editar'?'warning text-light':'success' }}">{{ $accion=='editar'?'Actualizar':'Agregar' }}</button>
                        @endif
                        <a href="{{ route('clientes') }}" class="btn btn-block btn-primary">Nuevo</a>
                    </form>
                </div>
            </div>
        </div>
        {{-- TABLA --}}
        <div class="col-sm-6 p-2 ">
            <style>
                th {
                    background-color: #32373d;
                    color: yellow;
                }

                table th {
                    text-align: center;
                }
            </style>

            <div class="card ">
                <div class="card-body">
                    <h5 class="card-title">Clientes</h5>
                    <hr>
                    <table class="myTable table table-light table-responsive " style="">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Número</th>
                                <th># Trabajos</th>
                                <th>Ingresos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $c)
                            <tr>
                                <td>{{ $c['nombre'] }}</td>
                                <td>{{ $c['telefono'] }}</td>
                                <td>{{ $c['trabajos'] }}</td>
                                <td>₡{{$c['monto']}}</td>

                                <td>
                                    <div class="links">
                                        <form action="{{ route('clientes.destroy',$c['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <a href="{{ route('clientes.show',$c['id']) }}"
                                                class="btn btn-small btn-primary text-light mt-2"><span
                                                    class="fa fa-eye"></span></a>
                                            <a href="{{ route('clientes.edit',$c['id']) }}"
                                                class="btn btn-small btn-warning text-light mt-2"><span
                                                    class="fa fa-edit"></span></a>

                                            <button class="btn btn-small btn-danger text-light mt-2"><span
                                                    class="fa fa-trash"></span></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection