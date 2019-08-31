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



    
var indice = 0;
					$('#mas').click(function(){
						indice++;
    					$('#fotos').append("<p id='p"+indice+"'>Fotografias en alta foto "+indice+":</p><input id='photo"+indice+"' type='file' name='foto"+indice+"'><br id='s"+indice+"'>");
						$('#numfotos').val(indice+1);
					});
					$('#menos').click(function(){
    					if(indice > 0)
    					{
        					$("#photo"+indice).remove();
        					$("#p"+indice).remove();
							$("#s"+indice).remove();
							indice--;
							$('#numfotos').val(indice+1);
    					}
});