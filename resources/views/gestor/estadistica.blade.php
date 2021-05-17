@extends('gestor.plantilla')
@section('cuerpo')

<div class="container-fluid p-4">
    <div class="card" style="background-color: #32373d; color: yellow">
        <div class="card-header">
            
            <h3>Ganancias:</h3>
           <div class="row">
               <div class="col-sm-12 col-md-4">
               <form action="">
                <input type="hidden" name="" id="route" value="{{ route('estadistica') }}">
                
                <div class="form-group">
                    <label for="my-input"> Ordenar por:</label>
                    <select class="form-control" name="" id="sta_opt">
                        <option value="general">General</option>
                        <option value="fecha">Fechas</option>
                    </select>
                  </div>
                  {{-- fechas --}}
                <div class="form-group  " id="fechas_menu" style="display: none">
                    <label for="my-input">Fechas</label>
                    <input type="text" value="" name="dates" id="dates" class="form-control">
                    <input type="hidden" value="" name="startdate" id="startdate">
                    <input type="hidden" value="" name="enddate" id="enddate">
    
                </div>
                <a type="button" id="boton" class="btn btn-primary btn-lg btn-block">Buscar</a>
            
               </form>
               </div>
               <div class="col-sm-12 col-md-8">
                <div class="card" style="background-color: #32373d; color: yellow">
                    <div class="card-header">
                        <h3>Estimado en Trabajos:</h3>
                    </div>
                    <div class="card-body text-center"  style="background-color: white; color: black;">
                        <h5 class="card-title " style="">₡ {{ $monto_general }}</h5>
                    </div>
                </div>
               </div>
           </div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6 p-2">
                    <div class="card" style="background-color: #32373d; color: yellow">
                        <div class="card-header">
                            <h3>Trabajos (entregados):</h3>
                        </div>
                        <div class="card-body text-center"  style="background-color: white; color: black;">
                            <h5 class="card-title " style="">₡ {{ $monto_general_entregados }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 p-2">
                    <div class="card" style="background-color: #32373d; color: yellow">
                        <div class="card-header">
                            <h3>Mes:</h3>
                        </div>
                        <div class="card-body text-center"  style="background-color: white; color: black;">
                            <h5 class="card-title">₡ {{ $monto_mes }}</h5>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm-12 col-md-4 p-2">
                    <div class="card" style="background-color: #32373d; color: yellow">
                        <div class="card-header">
                            <h4>Trabajos ingresados:</h4>
                        </div>
                        <div class="card-body text-center"  style="background-color: white; color: black;">
                            <h5 class="card-title">{{ $trabajos }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 p-2">
                    <div class="card" style="background-color: #32373d; color: yellow">
                        <div class="card-header">
                            <h4>Trabajos entregados:</h4>
                        </div>
                        <div class="card-body text-center"  style="background-color: white; color: black;">
                            <h5 class="card-title">{{ $entregados }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 p-2">
                    <div class="card" style="background-color: #32373d; color: yellow">
                        <div class="card-header">
                            <h4>Trabajos pendientes:</h4>
                        </div>
                        <div class="card-body text-center"  style="background-color: white; color: black;">
                            <h5 class="card-title ">{{ $cant_consulta }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="{{ asset('js/formEstadistica.js') }}"></script>
@endsection