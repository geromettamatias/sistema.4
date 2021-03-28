$(document).ready(function(){
  $('#imagenProceso').hide();
    cargaDatoPagina();
  anuncioDocente();
 




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













     $("#libretaDigitalDocente").click(function(){
        $('#imagenProceso').show();
         $.ajax({
          type:"post",
          data:'ob=' + '1',
          url:'bd/pregunta.php',
          success:function(r){
          
            if (r=='SI') {

                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').load('gestion/buscarCicloLectivo.php');
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









     $("#actaExamen").click(function(){
        $('#imagenProceso').show();
         $.ajax({
          type:"post",
          data:'ob=' + '5',
          url:'bd/pregunta.php',
          success:function(r){
      
            if (r=='NO') {

                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').load('gestion/actasBuscar.php');
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



  


         $("#mensajeAdministrador").click(function(){
          $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('mensajeAlumnos/mensajeAdminAlProfesor.php');
   
        
    });

        $("#mensajeAlumno").click(function(){
          $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('mensajeAlumnos/mensajeAlumnosAlProfesor.php');
   
        
    });


        $("#inasistencia").click(function(){
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').html('');
   

             $.ajax({
          type:"post",
          data:'ob=' + '2',
          url:'bd/pregunta.php',
          success:function(r){
          
            if (r=='SI') {



                   $.ajax({
                          url: "gestion/cicloDocente.php",
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
                              
                       

                                  inasistenciaIr(cicloLectivoFina);
                                                  
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


        $("#circularesP").click(function(){
          $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('anuncios/circulares.php');
   
        
    });






        
    $("#logoutModalfINAL").click(function(){

      $('#imagenProceso').show();
    $(".modal-header").css("background-color", "#DC1738");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("¿Confirma salir y cerrar Sesión?");            
      $('#imagenProceso').hide();
  }); 

});




function cerrarSeccionProfesor()
        {
            $.ajax({
                url:'../bd/logoutEstudianteProf.php',
                type:'POST',
                data:"mensaje=mensaje&boton=cerrar"
            }).done(function(resp){
                //alert(resp);
                window.location.href = "../index.php";
            });
        };




function anuncioDocente() {

   
  
        $.ajax({
        url: "bd/anuncioLeerDocente.php",
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


function inasistenciaIr(cicloLectivoFina){

       $.ajax({
        url: "gestion/docenteCicloFinal.php",
        type: "POST",
        dataType: "json",
        data: {cicloLectivoFina:cicloLectivoFina},
        success: function(data){  
            
             $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').html('');
                $('#tablaInstitucional').load('gestion/inasistencia.php');

              
        }        
    });
}
