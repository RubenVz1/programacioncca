//Script que pone la fecha del dia
$(document).ready(function(){
    var d = new Date();
    var meshoy,diahoy;
    meshoy= d.getMonth()+1;
    if(meshoy <= 9)
    {
        meshoy= "0"+ meshoy;
    }

    if(d.getDay() <= 9)
    {
        diahoy= "0"+ d.getDay();
    }
    else
    {
        diahoy=d.getDay();
    }

    var fechahoy = d.getFullYear() + "-" + meshoy + "-" + diahoy;
    $('#diadehoy').append(fechahoy);
});

//Script para agreegar y quitar horarios 
$(document).ready(function(){


$('#mas').click(function(){
    $('#agrhor').append("<br id='br1'><input id='hrs' type='number' min='0' max='24' step='1' value='0'><p id='jsjsjs'>hrs</p><input type='number' min='0' max='60' step='5' id='mns' value='0'><p id='jsjs'>min</p>");
});
$('#menos').click(function(){
    $('#hrs').remove();
    $('#mns').remove();
    $('#br1').remove();
    $('#jsjs').remove();
    $('#jsjsjs').remove();
});


});
//Script para aperecer la opcion de introducir costo al seleccionar la opcion de costo y bloque la opcion de libre
$('#cst').change(function(){
    if($(this).is(":checked"))
    {
        $('#cstvalor').append("<div id='si'><p>Costo: $</p><input type='number' name='costo' value=''><br></div>");
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
var faltancampos = true;
$('#boton').click(function()
{
    if($('#fch').val() != "" && $('#activa').val() != "" && $('#actividad').val() != "" && $('#disc').val() != "" && $('#place').val() != "" && $('#horas').val() != "" && $('#minutos').val() != "" && $('#durh').val() != "" && $('#durmin').val() != "")
    {
        $('#boton').attr("href","reqdis.php");
    }
    else
    {
        if(faltancampos == true)
        {
            $('#fin').append("<p id='error' style='color:red'>Faltan campos por llenarse</p>");
            faltancampos=false;
        }
    }
});

//Script para mostrar alerta si hay días de retraso
var errores=0;
$('#fch').change(function(){
    var f = new Date();
    var mes,dia;
    mes = f.getMonth()+1;
    if(mes <= 9)
    {
        mes= "0"+ mes;
    }
    if(f.getDay() <= 9)
    {
        dia= "0"+ f.getDay();
    }
    else
    {
        dia=f.getDay();
    }
    var textofecha1 = f.getFullYear() + "-" + mes + "-" + dia;
    var textofecha2 = $('#fch').val();
    var fecha1 = new Date(textofecha1);
    var fecha2 = new Date(textofecha2);
    var diasDif = fecha2.getTime() - fecha1.getTime();
    var dias = Math.round(diasDif/(1000 * 60 * 60 * 24));
    if(dias < 30)
    {
        var retraso = 30-dias;
        if(errores==0)
        {
            $('#retraso').append("<p id='advertencia' style='color: red;'>"+retraso+" días de retraso</p>");
            errores=1;
        }
        else
        {
            $('#advertencia').remove();
            $('#retraso').append("<p id='advertencia' style='color: red;'>"+retraso+" días de retraso</p>");
        }
    }
    if(errores ==1 && dias >=30)
    {
        $('#advertencia').remove();
    }
});