<!doctype html>
<html lang="en">

<head>
    <title>Gestor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('css/precarga.css') }}">


</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button  type="button" id="sidebarCollapse" class="btn btn-primary"
                    style="background-color: #32373d !important; ">
                </button>
            </div>
            <div class="img bg-wrap text-center py-4"
                style="background-image: url(https://www.covao.ac.cr/diurno/images/demo/portfolio/MP_Porta01.jpg);">
                <div class="user-logo">
                    <h3 class="display-2 p-3 ">GESTOR DE TRABAJOS</h3>
                </div>
            </div>
            <style>
                .list-unstyled li span {
                    color: yellow
                }

                .list-unstyled li small {
                    font-size: 30px;
                }
            </style>
            <ul class="list-unstyled components mb-5 text-capitalize">
                <li class="{{ Route::getFacadeRoot()->current()->uri()=='trabajos'?'active':''}}">
                    <a href="{{ route('trabajos') }}"><span class="fa fa-cogs mr-3 "></span>Trabajos</a>
                </li>
                <li class="{{ Route::currentRouteName()=='pendientes'?'active':''}}">
                    <a href="{{ route('pendientes','general') }}"><span class="fa fa-download mr-3 notif"><small
                                class="d-flex align-items-center justify-content-center">{{ $cant }}</small></span>
                        Pendientes</a>
                </li>
                <li class="{{ Route::getFacadeRoot()->current()->uri()=='clientes'?'active':''}}">
                    <a href="{{ route('clientes') }}"><span class="fa fa-users mr-3"></span> Clientes</a>
                </li>
                <li class="{{ Route::getFacadeRoot()->current()->uri()=='estadistica'?'active':''}}">
                    <a href="{{ route('estadistica') }}"><span class="fa fa-trophy mr-3"></span> Estadística</a>
                </li>
                <li>

                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        <span class="fa fa-sign-out mr-3"></span> {{ __('Salir') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>

        </nav>

        <!-- Page Content  -->
        <style>
            label {
                color: yellow;

            }

            #content {
                background-color: #575757;
            }
        </style>

        <div id="content" class=" ">
            <div class="center section" id="precarga">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="loading"></div>
                        </div>
                    </div>
                </div>
            </div>

            <label
                style="  position: relative; top:0px; width: 100%; background-color: #32373d; color: white !important; "
                class=" text-center p-2" for=""><span class=" fa fa-gears p-2"
                    style=" text-transform: capitalize; font-size: 35px">
                    {{ $name }}</span></label>
            @yield('cuerpo')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"> </script>



    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script src="{{ asset('js/main.js') }}"></script>

</body>
<script>
    $(window).on('load', function () {
      setTimeout(function () {
    $("#precarga").css({visibility:"hidden",opacity:"0"})
  }, 1000);
     
});     
</script>

</html>