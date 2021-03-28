function analiticosFinal(idAlumnos) {

  cadena="idAlumnos=" + idAlumnos;

  

$.ajax({
    type:"POST",
    url:"modulosAdministracion/elementos/probarAnalitico.php",
    data:cadena,
    beforeSend: function() {
          $("#imagenProceso").show();
          document.getElementById("btn1").disabled = true;
          document.getElementById("btn2").disabled = true;
                              },
    success:function(res){

      if (res==0) {

            Swal.fire({
                        title: 'Problema',
                        text: "El Alumno no tiene cargado el analitico, desea cargar el mismo?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Cargar'
                      }).then((result) => {
                        if (result.isConfirmed) {
                         
                          cargaAnalitico(cadena);
                        }
                      })

          $("#imagenProceso").hide();
          document.getElementById("btn1").disabled = false;
          document.getElementById("btn2").disabled = false;           

      }else{

         $("#imagenProceso").hide();
          document.getElementById("btn1").disabled = false;
          document.getElementById("btn2").disabled = false; 

          $('#contenidoAyuda').html(''); 
          $('#buscarTablaInstitucional').html('');
          $('#tablaInstitucional').load('modulosAdministracion/alumnosAnalitico2.php');
          


      }
    
    
        

    }
  });



  


	

}

function eliminarAnalitico(idAlumnos) {


Swal.fire({
      title: 'Mensaje al Administrador',
      html:'<div class="col-12"><input type="text" class="form-control" id="pass"></div><br><p>Aclaración: Eliminar TODO UN CICLO TOTAL</p></div>', 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  pass = document.getElementById('pass').value,
                        
                 
                 eliminarAnaliticoFina(idAlumnos,pass);

                                  
                }
        });



}



function eliminarAnaliticoFina(idAlumnos,pass) {

  cadena="idAlumnos=" + idAlumnos+"&pass=" + pass;



$.ajax({
    type:"POST",
    url:"modulosAdministracion/elementos/eliminarAnalitico.php",
    data:cadena,
    success:function(res){

        if (res==1) {

          Swal.fire(
                      'MuyBien',
                      'You clicked the button!',
                      'success'
                    )

        }else{

          Swal.fire({
                  icon: 'error',
                  title: 'Problema',
                  text: 'Contraseña Incorrecta',
                  footer: '<a href>Why do I have this issue?</a>'
                })
        }
    

    }
  });



  


  

}


function cargaAnalitico(cadena) {
  
  $.ajax({
    type:"POST",
    url:"modulosAdministracion/elementos/seccionAnalitico.php",
    data:cadena,
    beforeSend: function() {
          $("#imagenProceso").show();
          document.getElementById("btn1").disabled = true;
          document.getElementById("btn2").disabled = true;
                              },
    success:function(r){

       $("#imagenProceso").hide();
          document.getElementById("btn1").disabled = false;
          document.getElementById("btn2").disabled = false; 


      Swal.fire(
            'MuyBien',
            'You clicked the button!',
            'success'
                    )
    
     

    }
  });
}







