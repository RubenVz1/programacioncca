//Script para liberar las semblanzas si se selecciona que habra programa de mano
$('#pm').change(function(){
    if($('#pm').is(":checked"))
    {
        $('#cstvalor').append("<div id='si'><p>Semblanza de la compañía grupo, artista, ponente, ciclo, etc:</p><br><textarea name='semcom' rows='5' cols='30'></textarea><br><p>Semblanza de la actividad:</p><br><textarea name='semact' rows='5' cols='30'></textarea><br></div>");
    }
    else
    {
        $('#si').remove();
    }
});
var numl = js_numlogos;
var numf = js_numfotos;
var fi=0;
var li=0;   

$('#masImagenes').click(function()
{
    //console.log("Imagenes (+) antes: "+fi);
    fi++;
	$('#imagenes').append("<p id='p"+fi+"'>Fotografia en alta resolucion: </p><input id='ufoto"+fi+"' type='file' accept='image/x-png,image/gif,image/jpeg' name='uphoto"+fi+"'><br id='s"+fi+"'>");
    $('#numeroImagenes').val(fi);
    //console.log("numero de fotos: "+fi);
});

$('#menosImagenes').click(function()
{
    //console.log("Fotos (-) antes:"+fi);
	if(fi > 0)
	{
        
		$("#ufoto"+fi).remove();
		$("#p"+fi).remove();
		$("#s"+fi).remove();
        fi--;
		$('#numeroImagenes').val(fi); 
	}
    else
    {
        //console.log("ya esta en 0");
    }
    //console.log("Fotos (-) despues: "+fi);
});


$('#masLogos').click(function()
{
    //console.log("logos (+) antes: "+li);
    li++;
    $('#logos').append("<p id='q"+li+"'>Logo en alta resolucion: </p><input id='ulogo"+li+"' type='file' accept='image/x-png,image/gif,image/jpeg' name='ulog"+li+"'><br id='r"+li+"'>");
    $('#numeroLogos').val(li); 
    //console.log("numero de logos: "+li);
});

$('#menosLogos').click(function()
{
    //console.log("Logos (-) antes:"+li);
    if(li > 0)
    {
        $("#ulogo"+li).remove();
        $("#q"+li).remove();
        $("#r"+li).remove();
        li--;
        $('#numeroLogos').val(li);
    }
    else 
    {
        //console.log("ya esta en 0");
    }
    //console.log("Logos (-) despues: "+li);
});