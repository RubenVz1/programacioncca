//Script que libera la fecha tentativa
$('#si').change(function(){
    if($(this).is(":checked"))
    {
        $('#ok').append("<div id='no'><p>Fecha tentativa de pago</p><input type='date' name='fechapago' value=''><br><br><div>");
    }
    else
    {
        $('#no').remove();
    }
});