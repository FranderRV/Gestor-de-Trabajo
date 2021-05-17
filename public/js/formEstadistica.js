var accion =  $('#sta_opt').val(); 


$('#boton').click(function (e) { 
    ejecutar() ; 
});

$('input[name="dates"]').on('apply.daterangepicker', function (ev, picker) { 
    $('#startdate').val(picker.startDate.format('YYYY-MM-DD'));
    $('#enddate').val(picker.endDate.format('YYYY-MM-DD'));
});

$('#sta_opt').change(function (e) {
    e.preventDefault();
    if ($(this).val() == 'fecha') {
        $('#fechas_menu').css('display', 'block');
    } else {
        $('#fechas_menu').css('display', 'none');
    }
    accion =  $('#sta_opt').val();
});
function ejecutar() {
    switch (accion) {
        case 'fecha':
            location.href =($('#route').val() + '/' + accion + '/' + $('#startdate').val()+ '/' + $('#enddate').val());
            break;

        default:
            location.href =($('#route').val());
        
            break;
    }
}
