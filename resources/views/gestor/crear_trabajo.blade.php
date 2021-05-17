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
        <div class="col-sm-12 col-md-4 p-2">
            <div class="card" style="width: auto;">
                <div class="card-header text-center " style="font-size: 20px">
                    {{ $accion=='insertar'?'CREAR':'EDITAR' }} TRABAJO
                </div>
                <div class="card-body">
                    <form
                        action="{{ $accion == 'insertar'?route('trabajos.store'):route('trabajos.update',$trabajo->id) }} "
                        id="formulario" method="POST">
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
                            <label for="cliente">Cliente</label>
                            <div class="input-group mb-3">
                                <select class="form-control js-example-basic-single" name="cliente" style="" required>
                                    @foreach ($clientes as $c)
                                    <option value="{{ $c->id }}"
                                        {{ $trabajo!=null?($c->id==$trabajo->cliente_id?'selected':''):'' }}>
                                        {{ $c->nombre }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="date"
                                    value="{{ $trabajo==null?$fecha_actual:substr($trabajo->created_at,0,10) }}"
                                    name="fecha" id="fecha" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control"
                                value="{{ $trabajo==null?'':$trabajo->descripcion }}" id="descripcion"
                                aria-describedby="descripcion" name="descripcion" placeholder="Descripción" required>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" class="form-control" value="{{ $trabajo==null?0:$trabajo->precio }}"
                                min="0"   id="precio" aria-describedby="descripcion" name="precio"
                                placeholder="Precio" required>
                        </div>
                        <button class="btn btn-block btn-{{ $accion=='insertar'?'success':'warning text-light' }}">
                            {{ $accion=='insertar'?'Agregar':'Actualizar' }}</button>
                            
                        <a class="btn btn-block btn-primary" type="button" href="{{ route('trabajos') }}" >Nuevo</a>
                        @if ($accion == 'insertar')
                        <button class="btn btn-block btn-warning text-light" type="button" id="clear">Limpiar</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-8 p-2 ">
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
                    <h5 class="card-title">Trabajos</h5>
                    <hr>
                    <table class="myTable table table-light table-responsive " style="">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lista_trabajos as $t)
                            <tr>
                                <td>{{ substr($t->created_at,0,10) }}</td>
                                <td>{{ $t->nombre }}</td>
                                <td>{{ $t->descripcion }}</td>
                                <td>{{ $t->precio }}</td>
                                <td>
                                    <a href="{{ route('trabajos.update_estado',$t->id) }}"
                                        class="btn btn-block btn-{{  $t->estado==1?'success':'danger' }} text-light fa fa-toggle-{{ $t->estado==0?'off':'on' }}"
                                        data-toggle="tooltip" data-placement="left"
                                        title="{{ $t->estado==0?'Pendiente':'Entregado' }}"></a>
                                </td>
                                <td>
                                    <div class="links">

                                        <form action="{{ route('trabajos.destroy',$t->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf

                                            <a href="{{ route('trabajos.edit',$t->id) }}"
                                                class="btn btn-small btn-warning text-light" data-toggle="tooltip"
                                                data-placement="left" title="Editar"><span
                                                    class="fa fa-edit"></span></a>
                                                    
                                            <button type="submit" class="btn btn-small btn-danger text-light"
                                                data-toggle="tooltip" data-placement="left" title="Eliminar"><span
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
<script src="{{ asset('js/clean.js') }}"></script>
@endsection