@extends('gestor.plantilla')
@section('cuerpo')


<div class="container-fluid p-4">
    <div class="row">
        <style>
            .card {
                background-color: #32373d;
                color: yellow;
            }
        </style>
        <div class="col-sm-6 col-md-4 p-3">
            <div class="card" style="width: auto;">
                <div class="card-header text-center " style="font-size: 20px">
                    ORDENAR POR
                </div>
                <div class="card-body">
                    <input type="hidden" name="" id="route" value="{{ route('pendientes') }}">
                    <div class="form-group">
                        <label for="precio">Tipo</label>
                        <select name="" id="selectbox" class="form-control">
                            <option value="general" {{ $accion=='general'?'selected':'' }}>
                                General
                            </option>
                            <option value="fecha" {{ $accion=='fecha'?'selected':'' }}>Fecha
                            </option>
                            <option value="cliente" {{ $accion=='cliente'?'selected':'' }}>
                                Cliente</option>
                            <option value="precio" {{ $accion=='precio'?'selected':'' }}>
                                Precio</option>
                        </select>
                    </div>

                    <hr>
                    <div class="form-group" id="form-control">

                    </div>
                    <div class="form-group" id="form-control-selec" style="display: none">

                        <label for="cliente">Cliente</label>
                        <div class="input-group mb-3">
                            <select class="form-control js-example-basic-single" name="cliente" id="cliente"
                                style="width: 100%">
                                @foreach ($clientes as $c)
                                <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <button class="btn btn-block btn-success" id="buscar">Buscar</button>
                </div>



            </div>
        </div>
        <div class="col-sm-6 col-md-8  ">
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
                    <h5 class="card-title">Pendientes</h5>
                    <hr>
                    <table class="myTable table table-light table-responsive " style="">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lista_t as $t)
                            <tr>
                                <td>{{ substr($t->created_at,0,10) }}</td>
                                <td>{{ $t->nombre }}</td>
                                <td>{{ $t->descripcion }}</td>
                                <td>{{ $t->precio }}</td>

                                <td>
                                    <div class="links">

                                        <form action="{{ route('trabajos.destroy',$t->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <a href="{{ route('trabajos.update_estado',$t->id) }}"
                                                class="btn btn-small btn-{{  $t->estado==1?'success':'danger' }} text-light fa fa-toggle-{{ $t->estado==0?'off':'on' }} mt-2"
                                                data-toggle="tooltip" data-placement="left"
                                                title="{{ $t->estado==0?'Pendiente':'Entregado' }}"></a>

                                            <a href="{{ route('trabajos.edit',$t->id) }}"
                                                class="btn btn-small btn-warning text-light mt-2" data-toggle="tooltip"
                                                data-placement="left" title="Editar"><span
                                                    class="fa fa-edit"></span></a>
                                            <button type="submit" class="btn btn-small btn-danger text-light mt-2"
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


<script src="{{ asset('js/formPendiente.js') }}"></script>
@endsection