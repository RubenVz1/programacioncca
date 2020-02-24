
        var indice1 = 0;
        var boton = 0;
        $('#masImagenes').click(function()
        {
        $('#imagenes').append("<p id='p"+indice1+"'>Diseño: </p><input id='photo"+indice1+"' type='file' accept='application/pdf,image/jpeg' name='archivo"+indice1+"'><br id='s"+indice1+"'>");
        indice1++;
        $('#numeroImagenes').val(indice1);
        console.log("numero de imagenes: "+indice1);
        if(indice1 >= 1 && boton == 0)
        {
        $('#imagenes').after("<input id='botondis' type='submit' name='agrega' value='Subir'>");
        boton = 1;
        }
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
        if(indice1 == 0)
        {
        $("#botondis").remove();
        boton = 0;
        }
        }
        else
        {
        console.log("ya esta en 0");
        }
        });
