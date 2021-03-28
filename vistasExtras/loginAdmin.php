
                        <h3 class="font-weight-bold mb-2">Administrador</h3>
                        <form id="formLogin" class="mb-2">
                          <div class="mb-2">
                            <label for="usuario" class="form-label font-weight-bold">Usuario</label>
                            <input type="text" class="form-control bg-dark-x border-0" id="usuario" aria-describedby="emailHelp" placeholder="Ingresa tu usuario">
                            
                          </div>
                          <div class="mb-2">
                            <label for="password" class="form-label font-weight-bold">Contraseña</label>
                            <input type="password" class="form-control bg-dark-x border-0 mb-2" id="password" placeholder="Ingresa tu contraseña">
                             <a href="javascript: void(0)" id="mesajeAdmindelUsuarioAdmin" class="form-text text-muted text-decoration-none">Envía un mensaje al Administrador</a>
                          </div><!-- bg-dark-x border-0  utiliza un estilo y luego un borde 0 --- luego mb-2 distancia entre impu y el otro-->
                         
                            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                          <!-- w-100 para que varque toda la pantalla el boton-->
                        </form>

                            

                
                          <p class="font-weight-bold text-center text-muted">O inicia sesión con el perfil de</p>
                       
                       
                        <div class="d-flex justity-content-around"><!-- cases de boostra para sentrar contenidos-->
                            <button id="btnProfesor"  class="btn btn-outline-light flex-grow-1 mr-2"><i class="fas fa-user-tie lead mr-2"></i></i> Profesor</button>
                            <button id="btnEstudiante"  class="btn btn-outline-light flex-grow-1 ml-2"><i class="fas fa-user-graduate lead mr-2"></i> </i>Estudiante</button>

                            <!-- mr-2  derecha  ----   ml-2  izquierda              imagenes sacado de fondozo   agrege un estilo de boostra a las imagenes que es lead mr-2   separar texto (margen) y grande-->
                        </div>

                        <br>
                        <div class="d-flex justity-content-around"><!-- cases de boostra para sentrar contenidos-->
                       
                            <button id="btnPreceptor"  class="btn btn-outline-light flex-grow-1 mr-2"><i class="fas fa-user-tie lead mr-2"></i></i>Personal (Auxiliar, Regente...)</button>
                            

                            <!-- mr-2  derecha  ----   ml-2  izquierda              imagenes sacado de fondozo   agrege un estilo de boostra a las imagenes que es lead mr-2   separar texto (margen) y grande-->
                        </div>

      

 <script type="text/javascript">
    
    $(document).ready(function() { 

    
        $('#btnEstudiante').click(function(){

            $('#login').load("vistasExtras/loginEstudiante.php");
         });
        $('#btnProfesor').click(function(){
            $('#login').load("vistasExtras/loginProfesor.php");
         });

      
        $('#btnPreceptor').click(function(){
    
            $('#login').load("vistasExtras/loginPrecentor.php");
         });


        $('#btnPartes').click(function(){
    
            window.open('vistasExtras/partes.php', '_blank');
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




            $('#formLogin').submit(function(e){
                   e.preventDefault();
                   var usuario = $.trim($("#usuario").val());    
                   var password =$.trim($("#password").val());    
                    
                   if(usuario.length == "" || password == ""){
                      Swal.fire({
                          type:'warning',
                          title:'Debe ingresar un usuario y/o password',
                      });
                      return false; 
                    }else{
                        $.ajax({
                           url:"bd/loginAdministrador.php",
                           type:"POST",
                           datatype: "json",
                           data: {usuario:usuario, password:password}, 
                           success:function(data){               
                               if(data == "null"){
                                   Swal.fire({
                                       type:'error',
                                       title:'Usuario y/o password incorrecta',
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
                                           window.location.href = "administrador/index.php";
                                       }
                                   })
                                   
                               }
                           }    
                        });
                    }     
                });



    });


 </script>


