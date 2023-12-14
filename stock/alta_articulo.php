<?php
session_start();
//print_r($_SESSION);
if (empty($_SESSION["Usuario"])) {

    header("Location: ../logout.php");

    exit();
}

require_once '../funciones/conexion.php';
$MiConexion=ConexionBD();
require_once '../funciones/articulos.php';
//$CantidadDatos=count($datos_articulo);
$marcas=listar_marcas($MiConexion);

$proveedores=listar_proveedor($MiConexion);
$CantidadProvee=count($proveedores);

if(isset($_POST["DarAlta"])) {
  $imgContent="";
  //print_r($_POST);
  if(!empty($_FILES["cambiar_imagen"]["name"])) { 
      $fileName = basename($_FILES["cambiar_imagen"]["name"]); 
      $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
    
      $allowTypes = array('jpg','png','jpeg','gif'); 
      if(in_array($fileType, $allowTypes)){ 
          $image = $_FILES['cambiar_imagen']['tmp_name']; 
          $imgContent = addslashes(file_get_contents($image)); 
          $daralta=alta_articulo($_POST,$imgContent,$MiConexion);   
          $statusMsg=$daralta;     
          }
        else{ 
          $statusMsg = "Imagen fallo al subirse."; 
          }  
      }
      else{ 
        $daralta=alta_articulo($_POST,$imgContent,$MiConexion); 
        $statusMsg=$daralta;  

    } 
    echo "<script> 
         alert('$statusMsg') 
         window.open('/stock/articulos.php','_top')
          </script>";
         
  }

  if(isset($_POST["borrar_imagen"])) {
    $borrar_imagen=borrarimagen($_POST,$MiConexion);  
    echo "<script> 
         alert('$borrar_imagen') 
         window.open('/stock/articulos.php','_top')
          </script>"; 
  }
   
 //  echo "<script> 
   //       alert('Se a cambiado datos de $usuario $modificar_usuario') 
    //      window.open('//usuarios/usuarios.php','_top')
      //   </script>";
//}


?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/assets/"
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
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/js/config.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script language="javascript">
    $(document).ready(function(){
      $("#Marca").on('change', function () {
        $("#Marca option:selected").each(function () {
            var id_marca = $(this).val();
            $.post("modelo.php", { id_marca: id_marca }, function(data) {
                $("#Modelo").html(data);
            });			
        });
   });
});
</script>
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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Articulo</h4> 
              <div class="col-md-12">
                  
            </div> 
              <form method='post' action="" enctype="multipart/form-data">
              <div class="card">
                
                      
                    <hr class="my-0" />
                    <div class="card-body">
                    <h5 class="card-header">Detalles Articulo</h5>
                    <!-- Account -->
                     
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="Nombre" class="form-label">Informacion</label>
                            <input class="form-control" type="text" id="Nombre" name="Nombre"  autofocus required />
                          </div>
                          <div class="mb-3 col-md-3">
                            <label for="Apellido" class="form-label">Stock Inicial</label>
                            <input class="form-control" type="text" name="Stock" id="Stock" size= 5 value = 0  />
                          </div>
                          <div class="mb-3 col-md-3">
                            <label class="form-label" for="Marca">Proveedor</label>
                            <select id="Proveedor"  name="Proveedor" class="select2 form-select" required>
                              <option value=""></option>
                              <?php 
                                for($i=1; $i<=$CantidadProvee;$i++){
                                echo "<option value =". $proveedores[$i]["PROVE_ID"] . " > ". $proveedores[$i]["PROVE_NOMBRE"] . "</option>";
                              }    ?>
                            </select>
                          </div>


                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="Marca">Marca</label>
                            <select id="Marca"  name="Marca" class="select2 form-select" required>
                              <option value=""></option>
                              <?php 
                                foreach ($marcas as $id_marca =>$val) {
                                echo "<option value =". $id_marca . " > ". $val . "</option>";
                              }    ?>
                            </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="Modelo">Modelo</label>
                            <select id="Modelo"  name="Modelo" class="select2 form-select" >
                              
                            </select>
                          </div>

                          <div class="mb-3 col-md-3">
                            <label class="form-label" for="Usuario">Ubicacion</label>
                            
                              <input type="text" id="Ubicacion" name="Ubicacion" class="form-control"  required />
                            
                          </div>

                          <div class="mb-3 col-md-3">
                            
                              <label for="Email" class="form-label">Precio</label>
                              <input class="form-control" type="text" id="Precio_compra" name="Precio_compra"   required />
                            
                          </div>
                          
                          
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="Usuario">CodQR</label>
                            
                              <input type="text" id="QR" name="QR" class="form-control" required />
                            
                          </div>

                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="Usuario">Codigo</label>
                              <input type="text" id="Cod_art" name="Cod_art" class="form-control" required />
                          </div>
                         
                         

                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="Usuario">Codigo Provee</label>
                              <input type="text" id="Cod_prov" name="Cod_prov" class="form-control" required />
                          </div>
                         
                          
                          
                        </div>
                       

                   
                   
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                       
                        <img src = "" width = "80px" height = "80px"/>' 
      
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Subir foto</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" class="account-file-input" name="cambiar_imagen"  hidden accept="image/png, image/jpeg" />
                          </label>
                         
                         
                          <p class="text-muted mb-0">Debe ser JPG, GIF o PNG. Maximo tamaño de 800K</p>
                        </div>
                      </div>
                    </div>

                        
                        <div class="mt-2">
                          <button type="submit" name="DarAlta" class="btn btn-primary me-2">Dar Alta</button>
                          
                       
                      
                    </div>

                     
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
                
              </div>
             
            </div>
            
            
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
    <script src="/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
      </form>
  </body>
</html>
