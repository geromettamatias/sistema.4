<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@300;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/65086dff65.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="style.css"/>


    <div id="tituloDato"></div>
  </head>
  <body class="bg-dark"> <!-- class="bg-dark" es una clase de boostras-->
   <section>
         <div class="row g-0"> <!-- g-0  no tenga fonder  seria que no se mueva-->
  
               
                    <!-- bg-success  pinta todo el div verde  --  p-3 padin de 3  --  w-25 lo que ocupa de ancho-->
                  <div class="col-6 bg-success text-center p-5">
                  <h3>Datos de la Institución </h3>
                  </div>
                  <div class="col-6 bg-success text-center p-5">
                  <img  id="mostrarimagenLoDato" class="img-fluid img-logo mr-4" >
                  
                   </div>
                

                <div class="col-sm-12 col-lg-4">
                <div class="p-5">
                    <!-- bg-success  pinta todo el div verde  --  p-3 padin de 3  --  w-25 lo que ocupa de ancho-->

                  <h3>Director</h3>
                    <p class="h5 text-justify">Apellido y Nombre: <div id="nombreDirectivos" class="h5 text-justify"></div><br>
                  Datos: <div id="datosDirectivos" class="h5 text-justify"></div></p>



                </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                <div class="p-5">
                    <!-- bg-success  pinta todo el div verde  --  p-3 padin de 3  --  w-25 lo que ocupa de ancho-->

                  <h3>Vice - Director</h3>
                  <p class="h5 text-justify">Apellido y Nombre: <div id="nombreviceDirector" class="h5 text-justify"></div><br>
                  Datos: <div id="datosviceDirector" class="h5 text-justify"></div></p>



                </div>
                </div>


                <div class="col-sm-12 col-lg-4">
                <div class="p-5">
                    <!-- bg-success  pinta todo el div verde  --  p-3 padin de 3  --  w-25 lo que ocupa de ancho-->

                  <h3>Asesor Pedag.</h3>
                  <p class="h5 text-justify">Apellido y Nombre: <div id="nombreasesora" class="h5 text-justify"></div><br>
                  Datos: <div id="datosasesora" class="h5 text-justify"></div></p>



                </div>
                </div>

                <div class="col-sm-12 col-lg-12">
                <div class="p-5">
                    <!-- bg-success  pinta todo el div verde  --  p-3 padin de 3  --  w-25 lo que ocupa de ancho-->

                  <h3>Aclaración</h3>
                  <p class="h5 text-justify">Un texto es una composición de signos codificados en un sistema de escritura que forma una unidad de sentido. También es una composición de caracteres imprimibles generados por un algoritmo de cifrado que, aunque no tienen sentido para cualquier persona, sí puede ser descifrado por su destinatario original</p>


     


                </div>
                </div>



                </div>  
                    
         
   </section>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

  

    <script type="text/javascript">
    
    $(document).ready(function() { 

       datosDirectivos();
       cargaDatoPaginaDatos();
    });




    function datosDirectivos() {
  

  
    $.ajax({
        url: "../bd/datosDirectivos.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
            console.log(data);

            nombreDirectivos = data.director.nombreDirectivos;
            datosDirectivos = data.director.datosDirectivos;

            nombreviceDirector = data.viceDirector.nombreviceDirector;
            datosviceDirector = data.viceDirector.datosviceDirector;

            nombreasesora = data.asesora.nombreasesora;
            datosasesora = data.asesora.datosasesora;

            $("#nombreDirectivos").html(nombreDirectivos);
            $("#nombreDirectivosf").val(nombreDirectivos);  
            $("#datosDirectivos").html(datosDirectivos);
            $("#datosDirectivosf").val(datosDirectivos);

            $("#nombreviceDirector").html(nombreviceDirector);
            $("#nombreviceDirectorf").val(nombreviceDirector);  
            $("#datosviceDirector").html(datosviceDirector);
            $("#datosviceDirectorf").val(datosviceDirector);
            
            $("#nombreasesora").html(nombreasesora);
            $("#nombreasesoraf").val(nombreasesora);  
            $("#datosasesora").html(datosasesora);
            $("#datosasesoraf").val(datosasesora);

                  
        }        
    });
}

function cargaDatoPaginaDatos() {
  
  
        $.ajax({
        url: "../bd/datoAplicativoLeer.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
       
            tituloS = data.titulo;
            tituloMenuS = data.tituloMenu;
            url = data.url;
            
        
       

            var imagenPrevisualizacion = document.querySelector("#mostrarimagenLoDato");

            //  verificamos que sea PDF
           
                imagenPrevisualizacion.src = "../"+url+"";

            $('#tituloDato').html('<title>'+tituloS+'</title>');
               
                  
        }        
    });

}

 </script>


  </body>
</html>