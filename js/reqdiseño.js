//Script para liberar las semblanzas si se selecciona que habra programa de mano
$('#pm').change(function(){
    if($(this).is(":checked"))
    {
        $('#cstvalor').append("<div id='si'><p>Semblanza de la compañía grupo, artista, ponente, ciclo, etc:</p><br><textarea name='semcom' rows='5' cols='30'></textarea><br><p>Semblanza de la actividad:</p><br><textarea name='semact' rows='5' cols='30'></textarea><br></div>");
    }
    else
    {
        $('#si').remove();
    }
});
   
var indice1 = 0;
$('#masImagenes').click(function()
{
	$('#imagenes').append("<p id='p"+indice1+"'>Fotografia en alta resolucion: </p><input id='photo"+indice1+"' type='file' accept='image/x-png,image/gif,image/jpeg' name='foto"+indice1+"'><br id='s"+indice1+"'>");
	indice1++;
    $('#numeroImagenes').val(indice1);
    console.log("numero de imagenes: "+indice1);
});

$('#menosImagenes').click(function()
{
	if(indice1 > 0)
	{
        indice1--;
		$("#photo"+indice1).remove();
		$("#p"+indice1).remove();
		$("#s"+indice1).remove();
		$('#numeroImagenes').val(indice1); 
	}
    else
        console.log("ya esta en 0");
});

var indice2 = 0;
$('#masLogos').click(function()
{
    $('#logos').append("<p id='q"+indice2+"'>Logo en alta resolucion: </p><input id='logo"+indice2+"' type='file' accept='image/x-png,image/gif,image/jpeg' name='logo"+indice2+"'><br id='r"+indice2+"'>");
    indice2++;
    $('#numeroLogos').val(indice2); 
    console.log("numero de imagenes: "+indice2);
});

$('#menosLogos').click(function()
{
    if(indice2 > 0)
    {
        indice2--;
        $("#logo"+indice2).remove();
        $("#q"+indice2).remove();
        $("#r"+indice2).remove();
        $('#numeroLogos').val(indice2);
    }
    else
        console.log("ya esta en 0");
});