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
    indice1++;
	$('#imagenes').append("<p id='p"+indice1+"'>Fotografia en alta resolucion: </p><input id='photo"+indice1+"' type='file' name='foto"+indice1+"'><br id='s"+indice1+"'>");
	$('#numeroImagenes').val(indice1+1);
});

$('#menosImagenes').click(function()
{
	if(indice1 > 0)
	{
		$("#photo"+indice1).remove();
		$("#p"+indice1).remove();
		$("#s"+indice1).remove();
		indice1--;
		$('#numeroImagenes').val(indice1+1);
	}
});

var indice2 = 0;
$('#masLogos').click(function()
{
    indice2++;
    $('#logos').append("<p id='q"+indice2+"'>Logo en alta resolucion: </p><input id='logo"+indice2+"' type='file' name='logo"+indice2+"'><br id='r"+indice2+"'>");
    $('#numeroLogos').val(indice2+1);
});

$('#menosLogos').click(function()
{
    if(indice2 > 0)
    {
        $("#logo"+indice2).remove();
        $("#q"+indice2).remove();
        $("#r"+indice2).remove();
        indice2--;
        $('#numeroLogos').val(indice2+1);
    }
});