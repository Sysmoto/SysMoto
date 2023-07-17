<?php
session_start();
//print_r($_SESSION);
if (empty($_SESSION["Usuario"])) {

    header("Location: ../logout.php");

    exit();
}

require_once '../funciones/conexion.php';
$MiConexion=ConexionBD();
require_once '../funciones/usuarios.php';
$id_usuario=$_POST["id_user"];
$datos_usuario=Datos_usuario($id_usuario,$MiConexion);
//$domicilio_usuario=Dom_usuario($datos_usuario['Dom'],$MiConexion);
//$contacto_usuario=Cont_usuario($datos_usuario['Cont'],$MiConexion);
//print_r($domicilio_usuario);
$CantidadDatos=count($datos_usuario);
$roles=Listar_Roles($MiConexion);
$CantidadRoles=count($roles);

if(isset($_POST["CambiarDatos"])) {

  $modificar_usuario=Modificar_Usuario($_POST,$MiConexion);
  $usuario=$_POST["Nombre"]." ".$_POST["Apellido"];
  
  print_r($_POST);
  print_r($_FILES);
  if(!empty($_FILES["cambiar_imagen"]["name"])) { 
    $fileName = basename($_FILES["cambiar_imagen"]["name"]); 
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
    
    $allowTypes = array('jpg','png','jpeg','gif'); 
    if(in_array($fileType, $allowTypes)){ 
      $image = $_FILES['cambiar_imagen']['tmp_name']; 
      $imgContent = addslashes(file_get_contents($image)); 
      $modificar_imagen=imagen_usuario($_POST,$imgContent,$MiConexion);   
      $statusMsg=$modificar_imagen;     
      }else{ 
        $statusMsg = "Ha fallado subir imagen."; 
      }
      echo $statusMsg;
  }   

   echo "<script> 
          alert('Se a cambiado datos de $usuario $modificar_usuario') 
          window.open('/usuarios/usuarios.php','_top')
         </script>";
}


if(isset($_POST["BorrarUsuario"])) {
  if(isset($_POST["confirmacion"])) {
    $id_usuario=$_POST["id_user"];
    
    $borrar_usuario=Borrar_Usuario($id_usuario,$MiConexion);
    $usuario=$_POST["Nombre"]." ".$_POST["Apellido"];

    echo "<script> alert('Se borro $usuario $borrar_usuario ') 
          window.open('/usuarios/usuarios.php','_top')
          </script>";
      
  }
  else{
    echo "<script> alert('Tiene que confirmar previamente') </script>";

  }
}
?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>SysMoto v0.0</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <?php include("../menus/menu.php");?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  
                  
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
               

                <!-- User -->
                <?php include("../menus/head.php"); ?>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            
                
            
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Configuracion de Cuentas / Usuario</h4> 
              <div class="col-md-12">
                  
            </div> 
              <form method='post' action="usuario.php" enctype="multipart/form-data">
              <div class="card">
                
                
                <div class="card mb-4">
                    <h5 class="card-header">Detalles cuenta</h5>
                    <!-- Account -->
                  
                   
                    
                    <div class="card-body">
                     
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="Nombre" class="form-label">Nombre</label>
                            <input class="form-control" type="text" id="Nombre" name="Nombre" value="<?php echo $datos_usuario["Nombre"];?>" autofocus  />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="Apellido" class="form-label">Apellido</label>
                            <input class="form-control" type="text" name="Apellido" id="Apellido" value="<?php echo $datos_usuario["Apellido"];?>" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="Email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" id="Email" name="Email" value="<?php echo $datos_usuario["Email"];?>" placeholder="john.doe@example.com" />
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="Usuario">Usuario</label>
                            <div class="input-group input-group-merge">
                              <input type="text" id="Usuario" name="Usuario" class="form-control" value="<?php echo $datos_usuario["Usuario"];?>" />
                            </div>
                          </div>
                          
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="Sexo">Sexo</label>
                            <select id="Sexo"  name="Sexo" class="select2 form-select">
                              <option value="F" <?php if($datos_usuario["Sexo"]=="M") { echo "SELECTED";};?> >Femenino</option> 
                              <option value="M" <?php if($datos_usuario["Sexo"]=="F") { echo "SELECTED";};?> >Masculino</option>
                              <option value="O" <?php if($datos_usuario["Sexo"]=="O") { echo "SELECTED";};?> >Otro</option>
                            </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="Activo">Activo</label>
                            <select id="Activo"  name="Activo" class="select2 form-select">
                              <option value="1" <?php if($datos_usuario["Activado"]=="1") { echo "SELECTED";};?> >Activado</option> 
                              <option value="0" class="option2" <?php if($datos_usuario["Activado"]=="0") { echo "SELECTED ";};?> >Desactivado</option>
                              
                            </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="Rol" class="form-label">Rol</label>
                            <select id="Rol" name="Rol"
                             class="select2 form-select">
                              <?php  for ($i=0; $i<$CantidadRoles; $i++) { ?>
                                <option value="<?php echo $roles[$i]["Id"];?>" <?php if($datos_usuario["Rol"]==$roles[$i]["Rol"]) { echo "SELECTED";};?> > <?php echo $roles[$i]["Rol"] ;?> </option>
                              <?php } ?>
                            </select>
                          </div>
                          
                        </div>
                        <hr class="my-0" />
                        <h5 class="card-header">Foto</h5>
                        <div class="card-body">
                          <div class="d-flex align-items-start align-items-sm-center gap-4">
                              <?php 
                             
                                  if(isset($datos_usuario['Foto'])) {
                                      echo '<img src = "data:image/png;base64,' . base64_encode($datos_usuario["Foto"]) . '" width = "80px" height = "80px"/>' ; 
                                      }
                                    else {
                                      echo '<img src = "/assets/img_user/user_default.png" width = "80px" height = "80px"/>' ; 
                                    }  
                                      ?>
                              <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                  <span class="d-none d-sm-block">Cambiar foto</span>
                                  <i class="bx bx-upload d-block d-sm-none"></i>
                                  <input type="file" id="upload" class="account-file-input" name="cambiar_imagen" hidden accept="image/png, image/jpeg" />
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                  <i class="bx bx-reset d-block d-sm-none"></i>
                                  <span class="d-none d-sm-block">Borrar</span>
                                </button>
                                <p class="text-muted mb-0">Debe ser JPG, GIF o PNG. Maximo tamaño de 800K</p>
                              </div>
                           </div>
                          </div>
                          <hr class="my-0" />
                          <!--
                          <h5 class="card-header">Domicilio</h5>
                          <div class="card-body">
                            <div class="row">
                              <div class="mb-3 col-md-6">
                                <label for="Nombre" class="form-label">Calle</label>
                                <input class="form-control" type="text" id="Calle" name="Calle" value="<?php echo $domicilio_usuario["Calle"];?>" autofocus  />
                            </div>
                          <div class="mb-3 col-md-3">
                            <label for="Apellido" class="form-label">Altura</label>
                            <input class="form-control" type="text" name="Altura" id="Altura" value="<?php echo $domicilio_usuario["Altura"];?>" />
                          </div>
                          <div class="mb-3 col-md-3">
                            <label for="Email" class="form-label">CP</label>
                            <input class="form-control" type="text" id="CP" name="CP" value="<?php echo $domicilio_usuario["CP"];?>" placeholder="john.doe@example.com" />
                          </div>
                            </div>
                          </div>
                          <hr class="my-0" />
                          <h5 class="card-header">Contacto</h5>
                          <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">

                            </div>
                          </div> -->
                        <input type="hidden" name="id_user" value="<?php echo $id_usuario;?>" > 
                        <div class="mt-2">
                          <button type="submit" name="CambiarDatos" class="btn btn-primary me-2">Salvar cambios</button>
                          
                        </div>
                     
                    </div>
                    <!-- /Account -->
                  </div>
                  <div class="card">
                    <h5 class="card-header">Borrar Cuenta</h5>
                    <div class="card-body">
                      <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                          <h6 class="alert-heading fw-bold mb-1">Esta seguro de borrar el usuario?</h6>
                          <p class="mb-0">Confirme antes de solicitarlo.</p>
                        </div>
                      </div>
                
                        <div class="form-check mb-3">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            name="confirmacion"
                            id="accountActivation"
                          />
                          <label class="form-check-label" for="accountActivation">Confirmar borrar usuario</label
                          >
                        </div>
                        <button type="submit" name="BorrarUsuario"  class="btn btn-danger deactivate-account">Borrar Usuario</button>
                  
                    </div>
                  </div>
                </div>
              </div>
                
              </div>
             
            </div>
            </form>
            
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
             
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
     
  </body>
</html>
