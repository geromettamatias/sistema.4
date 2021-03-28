<?php
session_start();

if($_SESSION["s_usuarioProfesor"] === null){
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <div id="titulo"></div>


  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="vendor/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


      

    
    
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
        
          <img  class="card-img-top" id="mostrarimagenLo" style="width: 40px;">
        </div>
        <div class="sidebar-brand-text mx-3"><sup><div id="tituloMenu"></div></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
           <i class="fas fa-sync fa-spin"></i>
          <span>Refrescar la página</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        ADMINISTRACIÓN
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoCarga1" aria-expanded="true" aria-controls="collapseTwoCarga1">
          <i class="fas fa-cog fa-spin mr-2 text-gray-400"></i>
          <span>NOTAS DE ALUMNOS</span>
        </a>
        <div id="collapseTwoCarga1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">PLANILLAS</h6>

            <a class="collapse-item" id="libretaDigitalDocente"><i class="fas fa-stroopwafel fa-spin"></i> Notas</a>
            <a class="collapse-item" id="actaExamen"><i class="fas fa-stroopwafel fa-spin"></i> Actas</a>
    
          </div>
        </div>
      </li>


       <!-- Divider -->
      <hr class="sidebar-divider">

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoCarga12" aria-expanded="true" aria-controls="collapseTwoCarga12">
          <i class="fas fa-cog fa-spin mr-2 text-gray-400"></i>
          <span>GESTIÓN PERSONAL</span>
        </a>
        <div id="collapseTwoCarga12" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"><i class="fas fa-stroopwafel fa-spin"></i> Administración</h6>

            <a class="collapse-item" id="inasistencia"><i class="fas fa-stroopwafel fa-spin"></i> Inasistencia</a>
           
         
          </div>
        </div>
      </li>

       <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        COMUNICACIÓN
      </div>

         <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoCarga2" aria-expanded="true" aria-controls="collapseTwoCarga2">
          <i class="fas fa-cog fa-spin mr-2 text-gray-400"></i>
          <span>MENSAJES</span>
        </a>
        <div id="collapseTwoCarga2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">USUARIOS</h6>
            <a class="collapse-item" id="mensajeAdministrador"><i class="fas fa-stroopwafel fa-spin"></i> Administrador</a>
            <a class="collapse-item" id="mensajeAlumno"><i class="fas fa-stroopwafel fa-spin"></i> Alumno</a>
         
          </div>
        </div>
      </li>


     <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        ADMINISTRACION
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoCarga4" aria-expanded="true" aria-controls="collapseTwoCarga4">
          <i class="fas fa-cog fa-spin mr-2 text-gray-400"></i>
          <span>DOCUMENTACIÓN</span>
        </a>
        <div id="collapseTwoCarga4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"><i class="fas fa-stroopwafel fa-spin"></i> Institucional</h6>
            <a class="collapse-item" id="circularesP"><i class="fas fa-stroopwafel fa-spin"></i> Circulares</a>
           
          </div>
        </div>
      </li>



      
        <!-- Divider -->
        <hr class="sidebar-divider">

 

      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

         

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

     

            <div id="imagenProceso"><img  src="../1.gif"  style="width: 80px;"> CARGANDO <i class="fas fafas fa-sync fa-spin mr-2 text-gray-400"></i> </div>
            
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php

                include_once '../bd/conexion.php';
              $objeto = new Conexion();
              $conexion = $objeto->Conectar();
               
                  $s_usuarioProfesor=$_SESSION["s_usuarioProfesor"];

                 $consulta = "SELECT `nombre` FROM `datos_docentes` WHERE `dni`='$s_usuarioProfesor'";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($data as $dat) { 

                      $nombre=$dat['nombre'];
                  }
                   echo $nombre;


                 ?></span>
<!--                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->




                <img class="img-profile rounded-circle" src="img/user.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                
                <a class="dropdown-item" id="ajustesFinal"><i class="fas fa-cog fa-spin mr-2 text-gray-400"></i>Ajustes</a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" id="logoutModalfINAL" data-target="#logoutModal">
                  <i class="fas fafas fa-sync fa-spin mr-2 text-gray-400"></i>
                  Cerrar Sesión
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
