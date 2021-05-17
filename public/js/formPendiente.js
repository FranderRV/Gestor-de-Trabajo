var accion = '';
$(document).ready(function () {
    ejecutar();
});
$('#selectbox').change(function (e) {
    ejecutar();
});

function ejecutar() {
    mes = ((new Date().getMonth() + 1) < 10) ? '0' + Number(new Date().getMonth() + 1) : (new Date().getMonth() + 1);
    dia = new Date().getDate() < 10 ? '0' + new Date().getDate() : new Date().getDate();

    fecha = new Date().getFullYear() + '-' + mes + '-' + dia;
    accion = document.getElementById("selectbox").value;
    $('#form-control').empty();
    switch (accion) {
        case 'fecha':
            $('#form-control-selec').css('display', 'none');

            $('#form-control').append(
                `<label for="cliente">Fecha</label>
            <div class="input-group mb-3">
                <input class="form-control" type="date" value="${fecha}" name="fecha" id="fecha">
            </div>`
            );
            break;

        case 'cliente':
            $('#form-control-selec').css('display', 'block');

            break;
        case 'precio':
            $('#form-control-selec').css('display', 'none');

            $('#form-control').append(
                ` <label for="cliente">Precio</label>
        <div class="input-group mb-3">
            <input class="form-control" type="number" value="0" name="precio" id="precio">
        </div>`
            );
            break;
        case 'general':

            $('#form-control-selec').css('display', 'none');
            $('#form-control').empty();
            break;
        default:

            $('#form-control-selec').css('display', 'none');
            $('#form-control').empty();
            break;
    }
}
$('#buscar').click(function (e) {

    switch (accion) {
        case 'fecha':

            location.href =($('#route').val() + '/' + accion + '/' + $('#fecha').val());
            break;

        case 'cliente':

            location.href = ($('#route').val() + '/' + accion + '/' + $('#cliente').val());
            break;

        case 'precio':

            location.href = ($('#route').val() + '/' + accion + '/' + $('#precio').val());

            break;
        default:
            location.href = ($('#route').val() + '/general');
            break;
    }

});
