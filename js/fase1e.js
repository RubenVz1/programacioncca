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

//Script para aperecer la opcion de introducir costo al seleccionar la opcion de costo
$('#cst').change(function(){
    if($(this).is(":checked")){
        $('#cstvalor').append("<div id='si'><p>Costo: $</p><input type='text' name='costo' value='' required='required'><br></div>");
    }else{
        $('#si').remove();
    }
});
//Script para desplegar y ocultar los formularios
var banpro = 0;
$('#h1pro').click(function(){
    if(banpro == 0)
    {
        banpro =1;
        $('#pro').hide();
    }
    else
    {
        banpro=0;
        $('#pro').show();
    }
});

var bandis = 0;
$('#h1dis').click(function(){
    if(bandis == 0)
    {
        $('#reqdis').hide();
        bandis =1;
    }
    else
    {
        bandis=0;
        $('#reqdis').show();
    }
});
var bantec = 0;
$('#h1tec').click(function(){
    if(bantec==0)
    {
        bantec =1;
        $('#reqtec').hide();
    }
    else
    {
        bantec=0;
        $('#reqtec').show();
    }
});
var banpag = 0;
$('#h1pag').click(function(){
    if(banpag==0)
    {
        banpag =1;
        $('#reqpag').hide();
    }
    else
    {
        banpag=0;
        $('#reqpag').show();
    }
});
//Script que muestra la alerta de diías de retraso
