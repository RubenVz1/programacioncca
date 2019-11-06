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
var numerodehorarios = js_hcount;

var time2 = js_timef1_2;
var time3 = js_timef1_3;

for(var i = 2; i<=numerodehorarios;i++)
{
    if(i==2)
    {
         $('#agrhor').append("<br id='br1"+i+"'><input id='horas"+i+"' name='horariohoras"+i+"' type='number' min='0' max='24' step='1' value='"+time2[0]+time2[1]+"'required><p id='jsjsjs"+i+"'> hrs </p><input type='number' min='0' max='60' step='5' id='minutos"+i+"' name='horariominutos"+i+"' value='"+time2[3]+time2[4]+"'required><p id='jsjs"+i+"'> min</p>");
    }
    if(i==3)
    {
         $('#agrhor').append("<br id='br1"+i+"'><input id='horas"+i+"' name='horariohoras"+i+"' type='number' min='0' max='24' step='1' value='"+time3[0]+time3[1]+"'required><p id='jsjsjs"+i+"'> hrs </p><input type='number' min='0' max='60' step='5' id='minutos"+i+"' name='horariominutos"+i+"' value='"+time3[3]+time3[4]+"'required><p id='jsjs"+i+"'> min</p>");
    }
}

$(document).ready(function()
    {
        $('#mas').click(function()
        {
            if(numerodehorarios < 3)
            {
                numerodehorarios++;
                $('#agrhor').append("<br id='br1"+numerodehorarios+"'><input id='horas"+numerodehorarios+"' name='horariohoras"+numerodehorarios+"' type='number' min='0' max='24' step='1' value=''required><p id='jsjsjs"+numerodehorarios+"'> hrs </p><input type='number' min='0' max='60' step='5' id='minutos"+numerodehorarios+"' name='horariominutos"+numerodehorarios+"' value=''required><p id='jsjs"+numerodehorarios+"'> min</p>");
                $('#numeroHorarios').val(numerodehorarios);
                console.log(numerodehorarios);
            }
    }
);


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

//Script que no permite seleccionar los 3 tipos de entrada a la vez
$('#lbr').change(function(){
    if($('#lbr').is(":checked"))
    {
        $('#cst').hide();
        $('#nobox2').append("<p id='croxbox2'><b> X </b></p>");
        $('#cort').hide();
        $('#nobox3').append("<p id='croxbox3'><b> X </b></p>");
    }
    else
    {
        $('#cst').show();
        $('#croxbox2').remove();
        $('#cort').show();
        $('#croxbox3').remove();
    }
});

$('#cort').change(function(){
    if($('#cort').is(":checked"))
    {
        $('#lbr').hide();
        $('#nobox1').append("<p id='croxbox1'><b> X </b></p>");
        $('#cst').hide();
        $('#nobox3').append("<p id='croxbox3'><b> X </b></p>");
    }
    else
    {
        $('#lbr').show();
        $('#croxbox1').remove();
        $('#cst').show();
        $('#croxbox3').remove();
    }
});

var price = js_price;

$('#cst').change(function(){
    if($('#cst').is(":checked"))
    {
        $('#cstvalor').append("<div id='si'><p><b>Costo: </b>$</p><input type='number' name='costo' value='"+price+"'><br></div>");
        $('#lbr').hide();
        $('#nobox1').append("<p id='croxbox1'><b> X </b></p>");
        $('#cort').hide();
        $('#nobox2').append("<p id='croxbox2'><b> X </b></p>");
    }
    else
    {
        $('#si').remove();
        $('#lbr').show();
        $('#croxbox1').remove();
        $('#cort').show();
        $('#croxbox2').remove();
    }
});

$('#cort').change(function(){
    if($('#cort').is(":checked"))
    {
        $('#si').remove();
    }
});

$('#lbr').change(function(){
    if($('#lbr').is(":checked"))
    {
        $('#si').remove();
    }
});

//Script para mostrar alerta si hay días de retraso
/*var errores=0;
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
});*/
