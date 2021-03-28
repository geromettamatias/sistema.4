
          <h3 class="font-weight-bold mb-2">Estudiante</h3>
                <form id="formEstudiante" class="mb-2">
                    <div class="mb-2">
                      <label for="dni" class="form-label font-weight-bold">DNI</label>
                      <input type="text" class="form-control bg-dark-x border-0" id="dni" aria-describedby="emailHelp" placeholder="Ingresa el numero de DNI">
                      </div>
                      <div class="mb-2">
                        <label for="cuil" class="form-label font-weight-bold">REPITA EL DNI</label>
                        <input type="password" class="form-control bg-dark-x border-0 mb-2" id="cuil" placeholder="Ingresa el numero de DNI">
                        
                         <a href="javascript: void(0)" id="mesajeAdmindelUsuarioAdmin" class="form-text text-muted text-decoration-none">Envía un mensaje al Administrador</a>
                        
                      </div><!-- bg-dark-x border-0  utiliza un estilo y luego un borde 0 --- luego mb-2 distancia entre impu y el otro-->
                            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                          <!-- w-100 para que varque toda la pantalla el boton-->
                </form>
                <p class="font-weight-bold text-center text-muted">O inicia sesión con el perfil de</p>

                <div class="d-flex justity-content-around"><!-- cases de boostra para sentrar contenidos-->
                    <button id="btnAdmin" type="submit" class="btn btn-outline-light flex-grow-1 mr-2"><i class="fas fa-user-tie lead mr-2"></i></i> Administrador</button>
                    <button id="btnProfesor" type="submit" class="btn btn-outline-light flex-grow-1 ml-2"><i class="fas fa-user-tie lead mr-2"></i> </i>Profesor</button>

                    <!-- mr-2  derecha  ----   ml-2  izquierda              imagenes sacado de fondozo   agrege un estilo de boostra a las imagenes que es lead mr-2   separar texto (margen) y grande-->
                </div>

                       <br>
                        <div class="d-flex justity-content-around"><!-- cases de boostra para sentrar contenidos-->
                         
                            <button id="btnPreceptor"  class="btn btn-outline-light flex-grow-1 mr-2"><i class="fas fa-user-tie lead mr-2"></i></i> Personal (Auxiliar, Regente...)</button>
                            

                            <!-- mr-2  derecha  ----   ml-2  izquierda              imagenes sacado de fondozo   agrege un estilo de boostra a las imagenes que es lead mr-2   separar texto (margen) y grande-->
                        </div>



 <script type="text/javascript">
    
    $(document).ready(function() { 

        $('#btnAdmin').click(function(){
            $('#login').load("vistasExtras/loginAdmin.php"); 
         });
       
        $('#btnProfesor').click(function(){
            $('#login').load("vistasExtras/loginProfesor.php");
         });

   
       
        $('#btnPreceptor').click(function(){
            $('#login').load("vistasExtras/loginPrecentor.php");
         });


        


         $('#mesajeAdmindelUsuarioAdmin').click(function(){
    
                  Swal.fire({
              title: 'Mensaje al Administrador',
              html:'<div class="col-12"><textarea class="form-control" id="mesajeAdmi" rows="5"></textarea></div><br><p>Aclaración: NO SE OLVIDE SUS COLOCAR SU CORREO EN EL MENSAJE</p></div>', 
              focusConfirm: false,
              showCancelButton: true,                         
              }).then((result) => {
                if (result.value) {                                             
                  mesajeAdmi = document.getElementById('mesajeAdmi').value,
                        
                 
                 mesajeAdmiFuncion(mesajeAdmi);
                                  
                }
        });




         });

        $('#formEstudiante').submit(function(e){
                 e.preventDefault();
                 var dni = $.trim($("#dni").val());    
                 var cuil =$.trim($("#cuil").val());    
                  
                 if(dni.length == "" || cuil == ""){
                    Swal.fire({
                        type:'warning',
                        title:'Debe ingresar un DNI',
                    });
                    return false; 
                  }else{
                      $.ajax({
                         url:"bd/loginEstudiante.php",
                         type:"POST",
                         datatype: "json",
                         data: {dni:dni, cuil:cuil}, 
                         success:function(data){               
                             if(data == "null"){
                                 Swal.fire({
                                     type:'error',
                                     title:'DNI incorrecta',
                                 });
                             }else{
                                 Swal.fire({
                                     type:'success',
                                     title:'¡Conexión exitosa!',
                                     confirmButtonColor:'#3085d6',
                                     confirmButtonText:'Ingresar'
                                 }).then((result) => {
                                     if(result.value){
                                         //window.location.href = "vistas/pag_inicio.php";
                                         window.location.href = "alumno/index.php";
                                     }
                                 })
                                 
                             }
                         }    
                      });
                  }     
              });





    });


 </script>
