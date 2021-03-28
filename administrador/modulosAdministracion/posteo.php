<?php
        include_once '../../bd/conexion.php';
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        
?>


<div class="container">
        <div class="row">
            <div class="col-lg-12 p-2">            
            <h1>POSTEO</h1>    
            </div>

            <div class="col-lg-12 p-2">            
            <h4>ACLARACIÓN: En el caso de las <b>Mesas de Examen</b> se Publicara la <b>nota</b> cuando se <b>deshabilite la inscripción</b> a las mismas!!</h4>    
            </div>
             
</div>    
      
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tabla_pos" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>TIPO</th>
                                <th>USUARIO</th>
                                <th>POSTEO</th> 
                                <th>BOTONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $consulta = "SELECT `idFecha`, `tipo`, `pregunta`, `usuario` FROM `fechas_pos`";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['idFecha'] ?></td>
                                <td><?php echo $dat['tipo'] ?></td>
                                <td><?php echo $dat['usuario'] ?></td>
                                <td><?php echo $dat['pregunta'] ?></td>
                  
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD_pos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="form_pos">    
            <div class="modal-body">
                <div class="form-group">
                <label for="postear" class="col-form-label">POSTEAR ?</label>
                    <select class="form-control" id="postear">
                        <option value='SI'>SI</option>
                        <option value='NO'>NO</option>      
                    </select>
                </div>                         
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
  
</div>


 <script type="text/javascript">
$(document).ready(function(){
    $('#imagenProceso').hide();
    var tabla_pos = $('#tabla_pos').DataTable({ 

    "destroy":true,    
    "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn_pos'>Editar</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        },
       
    });





var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btn_pos", function(){
    fila = $(this).closest("tr");

    

    idFecha = parseInt(fila.find('td:eq(0)').text());
    pregunta = fila.find('td:eq(3)').text();
  


    
    $("#postear").val(pregunta);
   

    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Datos de la Institución");            
    $("#modalCRUD_pos").modal("show");  
    
});





$("#form_pos").submit(function(e){
    e.preventDefault();    
    postear = $.trim($("#postear").val());
  
    $.ajax({
        url: "bd/crud_pos.php",
        type: "POST",
        dataType: "json",
        data: {postear:postear, idFecha:idFecha},
        success: function(data){  
            console.log(data);
            idFecha = data[0].idFecha;            
            tipo = data[0].tipo;
            usuario = data[0].usuario;
            pregunta = data[0].pregunta;
           
            tabla_pos.row(fila).data([idFecha,tipo,usuario,pregunta]).draw();           
        }        
    });
    $("#modalCRUD_pos").modal("hide");    
    
});    
    
});

</script>

