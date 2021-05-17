
(function ($) {

    "use strict";

    var fullHeight = function () {

        $('.js-fullheight').css('height', $(window).height());
        $(window).resize(function () {
            $('.js-fullheight').css('height', $(window).height());
        });

    };
    fullHeight();

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

})(jQuery);

$(document).ready(function () {

    if (screen.width < 800) {
        console.log('PASO');
        $('.myTable').addClass('table-responsive');
    } else {
        $('.myTable').removeClass('table-responsive');
    }


    $('.js-example-basic-single').select2({
        language: {

            noResults: function () {

                return "No hay clientes con ese nombre";
            },
            searching: function () {

                return "Buscando cliente";
            }
        }
    });
    $('.myTable').DataTable({
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        "aaSorting": [],

    });
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$(document).ready(function () {
 
    var f = new Date();
    var fecha = f.getFullYear() + '-' + (f.getMonth() + 1) + '-' + f.getDate();
    $('#startdate').val(fecha);
    $('#enddate').val(fecha);

});

$('input[name="dates"]').daterangepicker({
    "locale": {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "De",
        "toLabel": "Até",
        "customRangeLabel": "Custom",
        "daysOfWeek": [
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sáb"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Setiembre",
            "Outubre",
            "Novembre",
            "Diciembre"
        ],
        "firstDay": 0,
    }
});