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
                  <div class="col-12 bg-success text-center p-3">
                  <h3>Novedades <img  id="mostrarimagenLoDato" class="img-fluid img-logo mr-4" ></h3>
                  </div>
                 
 

                <div class="col-sm-12 col-lg-12">
                <div class="p-5">
                    <!-- bg-success  pinta todo el div verde  --  p-3 padin de 3  --  w-25 lo que ocupa de ancho-->

                  <h3>NOTICIAS</h3>
      
                  <div id="novedadesLeerP" class="h5 text-justify"></div>

     


                </div>
                </div>



                </div>  
                    
         
   </section>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

  

    <script type="text/javascript">
    
    $(document).ready(function() { 

       novedadesPaginaPr();
       cargaDatoPaginaDatos();
    });




function novedadesPaginaPr() {
  

  
     $.ajax({
        url: "../bd/novedades.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
            console.log(data);

            informe = data.novedades.informe;
       
            $("#novedadesLeerP").html(informe);
          
                  
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