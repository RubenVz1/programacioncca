//Script para agreegar y quitar horarios 
var limpiaCasilla1 = "onFocus='if (this.value=='horas') this.value ='';'";
var limpiaCasilla2 = "onFocus= 'if (this.value=='minutos') this.value ='';'";
var jsjsjs = "'if (this.value=='horas') this.value='';'"
$('#mas').click(function(){
    $('#agrhor').append("<br id='br1'><input id='hrs' type='text' value='horas' required='required'><input type='text' id='mns' value='minutos' required='required'>");
});
$('#menos').click(function(){
    $('#hrs').remove();
    $('#mns').remove();
    $('#br1').remove();
});

//Script para aperecer la opcion de introducir costo al seleccionar la opcion de costo y bloque la opcion de libre
$('#cst').change(function(){
    if($(this).is(":checked"))
    {
        $('#cstvalor').append("<div id='si'><p>Costo: $</p><input type='text' name='costo' value='' required='required'><br></div>");
        $('#lbr').hide();
    }
    else
    {
        $('#si').remove();
        $('#lbr').show();
    }
});

//Script que no permite seleccionar los 3 tipos de entrada a la vez
$('#lbr').change(function(){
    if($(this).is(":checked"))
    {
        $('#cst').hide();
    }
    else
    {
        $('#cst').show();
    }
});

//Script que impide que continue con campos vacios

$('#boton').click(function()
{
    if($('#fch').val() != "" && $('#activa').val() != "" && $('#actividad').val() != "" && $('#disc').val() != "" && $('#place').val() != "" && $('#hrs').val() != "" && $('#mn').val() != "" && $('#durh').val() != "" && $('#durmin').val() != "")
    {
        $('#boton').attr("href","reqdis.php");
    }
    else
    {
        $('#fin').append("<p>Faltan campos por llenarse</p>");
    }
});
