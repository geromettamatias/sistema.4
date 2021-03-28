$(document).ready(function(){
$('#imagenProceso').hide();
    cargaDatoPagina();
    anuncioAlumno();


     $("#ajustesFinal").click(function(){
          $('#imagenProceso').show();
         $.ajax({
          type:"post",
          data:'ob=' + '15',
          url:'bd/pregunta.php',
          success:function(r){
          
            if (r=='SI') {

                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').load('gestion/ajustes.php');
                $('#tablaInstitucional').html('');
                $('#buscarTablaInstitucional').show();

                  Swal.fire(
                  'IMPORTANTE !!',
                  'No se olvide de guardar los datos despues de modificarlos',
                  'warning'
                )
           

            }else{

                Swal.fire({
                        title: 'NO SE PUBLICO TODAVIA',
                        text: 'ESPERE HASTA QUE EL ADMINISTRADOR PUBLIQUE',
                        imageUrl: 'imag/fuera-de-servicio.jpg',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                      })

                $('#imagenProceso').hide();
            }

          
          }
        });




        
            
   
        
    });



    $("#analiticoAlumno").click(function(){
          $('#imagenProceso').show();
         $.ajax({
          type:"post",
          data:'ob=' + '2',
          url:'bd/pregunta.php',
          success:function(r){
          
            if (r=='SI') {

                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').html('');
                $('#tablaInstitucional').load('gestion/analitico.php');
           

            }else{

                Swal.fire({
                        title: 'NO SE PUBLICO TODAVIA',
                        text: 'ESPERE HASTA QUE EL ADMINISTRADOR PUBLIQUE',
                        imageUrl: 'imag/fuera-de-servicio.jpg',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                      })

                $('#imagenProceso').hide();
            }

          
          }
        });

       
        
    });



    $("#inscrpMesasExamen").click(function(){
        $('#imagenProceso').show();
         $.ajax({
          type:"post",
          data:'ob=' + '5',
          url:'bd/pregunta.php',
          success:function(r){
          
            if (r=='SI') {

                $('#contenidoAyuda').html(''); 
                
                $('#buscarTablaInstitucional').load('gestion/actaBuscar.php');
                $('#tablaInstitucional').html('');
           

            }else{

                Swal.fire({
                        title: 'NO SE PUBLICO TODAVIA',
                        text: 'ESPERE HASTA QUE EL ADMINISTRADOR PUBLIQUE',
                        imageUrl: 'imag/fuera-de-servicio.jpg',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                      })

                $('#imagenProceso').hide();
            }

          
          }
        });

       
        
    });





    

     $("#libretaDigitalAlumno").click(function(){

      $('#imagenProceso').show();
       $.ajax({
          type:"post",
          data:'ob=' + '1',
          url:'bd/pregunta.php',
          success:function(r){
          
            
            if (r=='SI') {

                $('#contenidoAyuda').html(''); 
                $('#tablaInstitucional').html('');
                $('#buscarTablaInstitucional').load('gestion/buscarLibretaDigital.php');
        

            }else{

              Swal.fire({
                        title: 'NO SE PUBLICO TODAVIA',
                        text: 'ESPERE HASTA QUE EL ADMINISTRADOR PUBLIQUE',
                        imageUrl: 'imag/fuera-de-servicio.jpg',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                      })

              $('#imagenProceso').hide();
            }

          
          }
        });


       
        
    });



      $("#visualizarNotaMesa").click(function(){
          $('#imagenProceso').show();
               $.ajax({
          type:"post",
          data:'ob=' + '5',
          url:'bd/pregunta.php',
          success:function(r){
          
            if (r=='NO') {

                $('#buscarTablaInstitucional').html('');
                $('#contenidoAyuda').html(''); 
                $('#tablaInstitucional').load('gestion/imprimiNotasActas.php');
               
           

            }else{

                Swal.fire({
                        title: 'NO SE PUBLICO TODAVIA',
                        text: 'ESPERE HASTA QUE EL ADMINISTRADOR PUBLIQUE',
                        imageUrl: 'imag/fuera-de-servicio.jpg',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                      })
                $('#imagenProceso').hide();
            }

          
          }
        });



        
        
      });
    
      
       $("#mensajeAdministrador").click(function(){
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('gestion/mensajeAdministrador.php');
   
        
    });


        $("#inasistencia").click(function(){
          $('#imagenProceso').show();
         $.ajax({
          type:"post",
          data:'ob=' + '3',
          url:'bd/pregunta.php',
          success:function(r){
          
               if (r=='SI') {



                 $.ajax({
                          url: "gestion/cicloAlumno.php",
                          type: "POST",
                          data: '',
                          success: function(r){  

    

                    ret=`<select class="form-control" id="cicloLectivoFina">
                              
                                
                                `+r+`
                                </select></div>`;
                     

                      Swal.fire({
                              title: 'AÑO LECTIVO',
                              html:ret, 
                              focusConfirm: false,
                              showCancelButton: true,                         
                              }).then((result) => {
                                if (result.value) {                                             
                                  cicloLectivoFina = document.getElementById('cicloLectivoFina').value;
                              
                       

                                  inasistenciaIrAluw(cicloLectivoFina);
                                                  
                                }
                        });




                   }        
                      });





            }else{

              Swal.fire({
                        title: 'NO SE PUBLICO TODAVIA',
                        text: 'ESPERE HASTA QUE EL ADMINISTRADOR PUBLIQUE',
                        imageUrl: 'imag/fuera-de-servicio.jpg',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                      })

              $('#imagenProceso').hide();
            }

          
          }
        });

        
        
    });



        $("#mensajeDocente").click(function(){
          $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('gestion/mensajeDocente.php');
   
        
    });



     


          $("#logoutModalfINAL").click(function(){

            $('#imagenProceso').show();
    $(".modal-header").css("background-color", "#DC1738");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("¿Confirma salir y cerrar Sesión?");            
        $('#imagenProceso').hide();
  }); 


});









function cerrarSeccion()
        {
            $.ajax({
                url:'../bd/loginEstudiante.php',
                type:'POST',
                data:"mensaje=mensaje&boton=cerrar"
            }).done(function(resp){
                //alert(resp);
                window.location.href = "../index.php";
            });
        };


function anuncioAlumno() {

   
  
        $.ajax({
        url: "bd/anuncioLeerAlumno.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
            console.log(data);

            info = data.anuncio.informe;
           

            
            $("#anunciosLeer").html(info);
           


                  
        }        
    });
}


function cargaDatoPagina() {
  
  $.ajax({
        url: "bd/datoAplicativoLeer.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
       
            titulo = data.titulo;
            tituloMenu = data.tituloMenu;
            url = data.url;
            
        
            

            $('#logoImagenF').val('<img src="'+url+'" type="reset"  style="width: 40%;" class="mx-auto d-block">');

        

            var imagenPrevisualizacion = document.querySelector("#mostrarimagenLo");

            //  verificamos que sea PDF
           
                 imagenPrevisualizacion.src = "../"+url+"";


         
   
            $('#titulo').html('<title>'+titulo+'</title>');    
            $("#tituloMenu").html(tituloMenu);
          
         
        
                  
        }        
    });
}


 function inasistenciaIrAluw(cicloLectivoFina){


     $.ajax({
        url: "gestion/alumnoCicloFinal.php",
        type: "POST",
       
        data: {cicloLectivoFina:cicloLectivoFina},
        success: function(data){  
            

                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').html('');
                $('#tablaInstitucional').load('gestion/inasistencia.php');
           
        }        
    });
}
