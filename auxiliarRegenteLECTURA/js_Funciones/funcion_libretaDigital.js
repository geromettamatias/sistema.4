function botonNotas(idIns) {


		$.ajax({
		          type:"post",
		          data:'idIns=' + idIns,
		          url:'modulosAdministracion/elementos/seccionLibretaDigital.php',
		          beforeSend: function() {
                  $("#imagenProceso").show();
                                
                              },
              success:function(r){
		          	

              $('#libreTaOcul').hide();
              $("#imagenProceso").hide();

            $('#libretaFina').load('modulosAdministracion/LibretaDigital.php');
                            

		            
		            
		          }
		        });



	
          
}


function botonAsignaturaPendiente(idAlumnos) {


    $.ajax({
              type:"post",
              data:'idAlumnos=' + idAlumnos,
              url:'modulosAdministracion/elementos/seccionPendienteApro.php',
              beforeSend: function() {
                  $("#imagenProceso").show();
                                
                              },
              success:function(r){
                

              $('#libreTaOcul').hide();
              $("#imagenProceso").hide();

            $('#libretaFina').load('modulosAdministracion/asignaturasPendientes.php');
                            

                
                
              }
            });



  
          
}





function ingresarDatosFicha(idAlumno,Libro,Folio,nLegajo,nacionalidadAlumno,procedenciaAlumno,nacionalidadTutor,auxiliar,piePagina) {
	
	$.ajax({
		type:"post",
		data:'idAlumno=' + idAlumno +'&Libro=' + Libro +'&Folio=' + Folio +'&nLegajo=' + nLegajo +'&nacionalidadAlumno=' + nacionalidadAlumno +'&procedenciaAlumno=' + procedenciaAlumno +'&nacionalidadTutor=' + nacionalidadTutor +'&auxiliar=' + auxiliar +'&piePagina=' + piePagina,
		url:'bd/ingresarDatosFichaAlumno.php',
		success:function(r){

			Swal.fire(
					  'Muy bien !!',
					  'Operación exitosa',
					  'success'
					)

		}
	});

}