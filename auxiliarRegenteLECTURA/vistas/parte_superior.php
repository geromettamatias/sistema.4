<?php
session_start();

if($_SESSION["idUsu"] === null){
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
  
    <link rel="stylesheet"  type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



   


  


</head>

<body  id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    
          <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <div id="log"><img  class="card-img-top" id="mostrarimagenLo" style="width: 40px;"></div>
          <input hidden="" type="text" id="tituloMenuURL">          

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
        DATOS
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoCarga" aria-expanded="true" aria-controls="collapseTwoCarga">
          <i class="fas fa-cog fa-spin mr-2 text-gray-400"></i>
          <span>CARGA DE DATOS</span>
        </a>
        <div id="collapseTwoCarga" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">DATOS:</h6>
          
            <a class="collapse-item" id="cargaAlumno"><i class="fas fa-stroopwafel fa-spin"></i> Alumno</a>
            <a class="collapse-item" id="cargaDocente"><i class="fas fa-stroopwafel fa-spin"></i> Docente</a>
           
          </div>
        </div>
      </li>





<!-- Divider -->
      <hr class="sidebar-divider">


      <!-- Heading -->
      <div class="sidebar-heading">
        ADMINISTRACION ALUMNO
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoCarga2" aria-expanded="true" aria-controls="collapseTwoCarga2">
          <i class="fas fa-cog fa-spin mr-2 text-gray-400"></i>
          <span>GESTIÓN ACADEMICA</span>
        </a>
        <div id="collapseTwoCarga2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">NOTAS, ASISTENCIA, ETC.</h6>
           
        
                     <?php
           
                if($_SESSION["cargo"] == 'AUXILIAR'){
      
                ?>

            
            <a class="collapse-item" id="libretaDigital"><i class="fas fa-stroopwafel fa-spin"></i> Gestión-Alumno</a>
  
            <a class="collapse-item" id="asistenciaDocente"><i class="fas fa-stroopwafel fa-spin"></i> Asistencia-Prof</a>
            


             <?php


                }

           
           
                if($_SESSION["cargo"] == 'REGENTE'){
      
                ?>
            <a class="collapse-item" id="actas"><i class="fas fa-stroopwafel fa-spin"></i> Actas</a>


             <?php


                }

                ?>
            <a class="collapse-item" id="planillaCentralizadora"><i class="fas fa-stroopwafel fa-spin"></i> Centralizadora</a>
          </div>
        </div>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        INFORMACIÓN
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoCarga4" aria-expanded="true" aria-controls="collapseTwoCarga4">
          <i class="fas fa-cog fa-spin mr-2 text-gray-400"></i>
          <span>ANUNCIOS</span>
        </a>
        <div id="collapseTwoCarga4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Informe</h6>
            <a class="collapse-item" id="anuncioAlumno"><i class="fas fa-stroopwafel fa-spin"></i> Alumnos</a>
            <a class="collapse-item" id="anuncioProfe"><i class="fas fa-stroopwafel fa-spin"></i> Profesores</a>
            

          </div>
        </div>
      </li>



       <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        GESTIÓN ESCOLAR
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoCarga5" aria-expanded="true" aria-controls="collapseTwoCarga5">
          <i class="fas fa-cog fa-spin mr-2 text-gray-400"></i>
          <span>TRAMITE-DOCENTE</span>
        </a>
        <div id="collapseTwoCarga5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Caracter</h6>
            <a class="collapse-item" id="circularProfe"><i class="fas fa-stroopwafel fa-spin"></i> Circulares</a>
           
            

          </div>
        </div>
      </li>


    
    

    
    

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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">USUARIO</span>
<!--                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->










                <img class="img-profile rounded-circle" src="img/user.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          
                  <div class="dropdown-divider"></div>
                
               
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
