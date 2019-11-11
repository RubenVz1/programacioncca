//Script que pone la fecha del dia

$(document).ready(function(){
    var d = new Date();
    var meshoy,diahoy;
    meshoy= d.getMonth()+1;
    if(meshoy <= 9)
    {
        meshoy= "0"+ meshoy;
    }
    if(d.getDate() <= 9)
    {
        diahoy= "0"+ d.getDate();
    }
    else
    {
        diahoy=d.getDate();
    }

    var fechahoy = d.getFullYear() + "-" + meshoy + "-" + diahoy;
    $('#diadehoy').append(fechahoy);
});

//Script para agreegar y quitar horarios 
$(document).ready(function()
{
var numerodehorarios = 1;
$('#mas').click(function()
{
    if(numerodehorarios < 3)
    {
        numerodehorarios++;
        $('#agrhor').append("<br id='br1"+numerodehorarios+"'><input id='horas"+numerodehorarios+"' name='horariohoras"+numerodehorarios+"' type='number' min='0' max='24' step='1' value=''required><p id='jsjsjs"+numerodehorarios+"'> hrs </p><input type='number' min='0' max='60' step='5' id='minutos"+numerodehorarios+"' name='horariominutos"+numerodehorarios+"' value=''required><p id='jsjs"+numerodehorarios+"'> min</p>");
        $('#numeroHorarios').val(numerodehorarios);
        console.log(numerodehorarios);
    }
});
$('#menos').click(function()
{
    if(numerodehorarios > 1)
    {
        $("#horas"+numerodehorarios).remove();
        $("#minutos"+numerodehorarios).remove();
        $('#br1'+numerodehorarios).remove();
        $('#jsjs'+numerodehorarios).remove();
        $('#jsjsjs'+numerodehorarios).remove();
        numerodehorarios--;
        $('#numeroHorarios').val(numerodehorarios);
        console.log(numerodehorarios);
    }
});



});
//Script para aperecer la opcion de introducir costo al seleccionar la opcion de costo y bloque la opcion de libre
$('#cst').change(function(){
    if($(this).is(":checked"))
    {
        $('#cstvalor').append("<div id='si'><p><b>Costo: </b>$</p><input type='number' name='costo' value=''><br></div>");
        $('#lbr').hide();
        $('#cort').hide();
        $('#nobox').append("<p id='crossbox'><b> X </b></p>");
    }
    else
    {
        $('#si').remove();
        $('#lbr').show();
        $('#cort').show();
        $('#crossbox').remove();
    }
});

//Script que no permite seleccionar los 3 tipos de entrada a la vez
$('#lbr').change(function(){
    if($(this).is(":checked"))
    {
        $('#cst').hide();
        $('#cort').hide();
        $('#nobox2').append("<p id='croxbox'><b> X </b></p>");
    }
    else
    {
        $('#cst').show();
        $('#cort').show();
        $('#nobox2').remove();
    }
});

$('#cort').change(function(){
    if($(this).is(":checked"))
    {
        $('#cst').hide();
        $('#lbr').hide();
    }
    else
    {
        $('#cst').show();
        $('#lbr').show();
    }
});

//Script que impide que continue con campos vacios
//opcion 1
/*
var faltancampos = true;
var aparecerboton = 0;

$(document).change(function(){

    var valoresopciones = [$('#lbr').prop('checked') , $('#cort').prop('checked') , $('#cst').prop('checked')];
    var excepcion = 0;
    for(var i = 0 ; i < 3 ; i++)
    {
        if(valoresopciones[i] != false)
        {
            excepcion++;
        }
    }
    if(excepcion > 0 && $('#fch').val() != "" && $('#compañia').val() != "" && $('#actividad').val() != "" && $('#disc').val() != "" && $('#place').val() != "" && $('#horas').val() != "" && $('#minutos').val() != "" && $('#durh').val() != "" && $('#durmin').val() != "")
    {
        if($('#lbr').val() != 1 && $('#cort').val() != 1 && $('#cst').val() != 1)
        {
            if(aparecerboton == 0)
            {
                aparecerboton = 1;
                $('#fin').append("<button id ='crea' type='submit' name='confirma'>Confirmar</button>");
                $('#error').remove();
                faltancampos=true;
            }
        }
    }
    else
    {
        if(faltancampos == true)
        {
            if(excepcion == 0)
            {
                $('#fin').append("<p id='error' style='color:red'>Selecciona mínimo un tipo de entrada</p>");
                $('#crea').remove();
                aparecerboton=0;
                faltancampos=false;
            }
            else
            {
                $('#fin').append("<p id='error' style='color:red'>Faltan campos por llenarse</p>");
                $('#crea').remove();
                aparecerboton=0;
                faltancampos=false;
            }
        }
    }
});
*/
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
        dia= "0"+ f.getDate();
    }
    else
    {
        dia=f.getDate();
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
