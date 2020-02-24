//Script que libera la fecha tentativa
$('#si').change(function() {
    if ($(this).is(":checked")) {
        $('#ok').append("<div class='my-3' id='no'><p><b>Fecha tentativa de pago:</b> </p><input type='date' name='fechapago' value=''><div>");
    } else {
        $('#no').remove();
    }
});