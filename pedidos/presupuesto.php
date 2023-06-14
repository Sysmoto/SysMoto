<?php
session_start();
if (empty($_SESSION["Usuario"])) {

    header("Location: /sysmoto/logout.php");

    exit();
}

require_once '../funciones/conexion.php';
require_once('../funciones/venta_detalle.php');
$MiConexion=ConexionBD();

$search_criteria = "";
//$_POST['search_criteria'];

$resultado = [];
$errors = ['data'=> false];

$sql = "SELECT a.ART_ID AS Id, a.ART_CODIGO AS Codigo, a.ART_PRECIOCOMPRA AS Precio, a.ART_INFOADICIONAL AS Descripcion,
s.CANT_STOCK AS Stock, mo.MODELO_NOMBRE AS Modelo, ma.MARCA_NOMBRE AS Marca, ea.ESTADOALERTA_NOMBRE AS Estado
FROM ARTICULO AS a, MODELO AS mo, MARCA AS ma, STOCK AS s, ESTADOALERTA AS ea
WHERE
a.MODELO_ID  = mo.MODELO_ID AND
a.ART_ID = s.ART_ID AND
a.ESTADOALERTA_ID = ea.ESTADOALERTA_ID AND
mo.MARCA_ID = ma.MARCA_ID 
AND a.ART_INFOADICIONAL LIKE '%".$search_criteria."%'";

$getResultado = $MiConexion->query($sql);


////






?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path=".../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content_1="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>SysMoto V.0.1</title>

    <meta name="description" content_1="" />

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

        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >



  </head> 

  <body>
    
  <!-- gaston -->
    <script src="./script.js" defer></script>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <?php include "../menus/menu.php";?>
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
          
            <div class="card">
                <h5 class="card-header">Venta - Presupuesto</h5>
                <div class="table-responsive text-nowrap">


                <!-- ssssssssssssssssssssssssss -->

                <div class="container py-4 text-center">
                  
                  <form method="post">
                  
                   
                    <button  class="btn btn-secondary" name="venta" value="venta">
                      <span class="tf-icons bx bxs-badge-dollar bx-flashing"></span>&nbsp; Crear Venta
                    </button>
                            <br>
                            
                      <br>
                  </form>
                  <div class="col-auto">
                          <label for="num_registros" class="col-form-label">
                            <?php
                            /*if(!isset($_POST['venta'])){
                            */  
                            
                            if(!isset($_POST['refrescar'])){
                              echo 'Factura: 00000000';  
                            }else  {
                            
                              $idInsert="select max(venta_id) as venta_id from venta";
$resInsert = mysqli_query($MiConexion,$idInsert);

if(mysqli_num_rows($resInsert)>0){
  
    $row=mysqli_fetch_assoc($resInsert);
    $idactual=$row['venta_id'];
}

echo 'Factura: '.$idactual;
                            
                          }
                          
                            ?> </label>
                  </div>

                  <div class="row g-4">
<!--
                      <div class="col-auto">
                          <label for="num_registros" class="col-form-label">Mostrar: </label>

                      </div>

                      <div class="col-auto">
                          <select name="num_registros" id="num_registros" class="form-select">
                              <option value="2">2</option>
                              <option value="4">4</option>
                              <option value="8">8</option>
                              <option value="10">10</option>
                          </select>
                      </div>

                      <div class="col-auto">
                          <label for="num_registros" class="col-form-label">registros </label>
                      </div>
-->
                      <div class="col-2"></div>

                      <div class="col-auto">
                          <label for="campo" class="col-form-label">Articulo a buscar [Codigo/Descripcion]: </label>
                      </div>
                      <div class="col-auto">
                          <form method="post">
                            <input type="search" name="search" placeholder="Busqueda de articulos"/>
                            <button name="submit" class="btn btn-secondary" ><span class="tf-icons bx bx-search-alt bx-flashing"></span>&nbsp; Buscar</button>
                            
                          </form>
                      </div>
                      <div class="col-auto">
                          
                      </div>

                      <div class="error-container" style="display: none">
                          <p></p>
                      </div>

                  </div>

                  
                  
                  <div class="row py-4">
                      <div >
                          <table class="table table-striped">
                              <thead>
                                  <th>Id</th>
                                  <th>Codigo</th>
                                  <th>Precio</th>
                                  <th>Descripcion</th>
                                  <th>Stock</th>
                                  <th>Modelo</th>
                                  <th>Marca</th>
                                  <th>Estado</th>
                                  <th>Accion</th>
                              </thead>

                              <!-- El id del cuerpo de la tabla. -->
                              <tbody class="table-border-bottom-0">

                              <?php

if(!isset($_POST['venta'])){


  if(isset($_POST['']) && isset($_POST['venta'])){

  
    $id_vnta = $_POST['idvnta'];

    $itemABuscar=$_POST['search'];

    $sqlSearch = "SELECT a.ART_ID AS Id, a.ART_CODIGO AS Codigo, a.ART_PRECIOCOMPRA AS Precio, a.ART_INFOADICIONAL AS Descripcion,
        s.CANT_STOCK AS Stock, mo.MODELO_NOMBRE AS Modelo, ma.MARCA_NOMBRE AS Marca, ea.ESTADOALERTA_NOMBRE AS Estado
        FROM ARTICULO AS a, MODELO AS mo, MARCA AS ma, STOCK AS s, ESTADOALERTA AS ea
        WHERE
        a.MODELO_ID  = mo.MODELO_ID AND
        a.ART_ID = s.ART_ID AND
        a.ESTADOALERTA_ID = ea.ESTADOALERTA_ID AND
        mo.MARCA_ID = ma.MARCA_ID 
        AND (a.ART_INFOADICIONAL LIKE '%$itemABuscar%' 
        OR a.ART_CODIGO LIKE '%$itemABuscar%')";
      //echo $sqlSearch;

      $resBusqueda = mysqli_query($MiConexion,$sqlSearch);

if($resBusqueda){
  
  if(mysqli_num_rows($resBusqueda)>0){

    while($row=mysqli_fetch_assoc($resBusqueda)){
      
      echo '<tr>';
      //version GET
      //echo '<td><a href="../funciones/insertar_detalleventa.php?data='.$row['Id'].'">'.$row['Id'].'</a></td>';
      echo '<td><a href="insertar_detalleventa.php?
      id='.$row['Id'].'&idactual='.$id_vnta.'&codigo='.$row['Codigo'].'&desc='.$row['Descripcion'].
      '&precio='.$row['Precio'].'">'.$row['Id'].'</a></td>';
      echo '<td>'.$row['Codigo'].'</td>';
      echo '<td>'.$row['Precio'].'</td>';
      echo '<td>'.$row['Descripcion'].'</td>';
      echo '<td>'.$row['Stock'].'</td>';
      echo '<td>'.$row['Modelo'].'</td>';
      echo '<td>'.$row['Marca'].'</td>';
      echo '<td>'.$row['Estado'].'</td>';
      echo '<td></td>';
      echo '</tr>';

    }
    
  }else {
    echo '<h3>No se encontraron registros</h3>';
    

}



} else {

  // nueva venta
  // creo la venta

$sqlInsert="INSERT INTO `venta` (`VENTA_ID`, `CLIENTE_ID`, `ESTADOVENTA_ID`, `VENTA_FECHAVENTA`, `VENTA_FECHAENTREGA`, `VENTA_FECHAANULACION`) 
VALUES (NULL, '1', '2', '2023-06-12', '2023-06-12', NULL)";

$resInsert = mysqli_query($MiConexion,$sqlInsert);

$idInsert="select max(venta_id) as venta_id from venta";
$resInsert = mysqli_query($MiConexion,$idInsert);

if(mysqli_num_rows($resInsert)>0){
  
    $row=mysqli_fetch_assoc($resInsert);
    $idactual=$row['venta_id'];
}

$_POST['idvnta'] =$idactual;



}

}else if(isset($_POST['submit'])) {


  $idUltInsert="select max(venta_id) as venta_id from venta";
  $resUltInsert = mysqli_query($MiConexion,$idUltInsert);
  
  
  if(mysqli_num_rows($resUltInsert)>0){
    
      $row=mysqli_fetch_assoc($resUltInsert);
      $idactual=$row['venta_id'];
  }

  $id_vnta = $idactual;

  $itemABuscar=$_POST['search'];

$sqlSearch = "SELECT a.ART_ID AS Id, a.ART_CODIGO AS Codigo, a.ART_PRECIOCOMPRA AS Precio, a.ART_INFOADICIONAL AS Descripcion,
s.CANT_STOCK AS Stock, mo.MODELO_NOMBRE AS Modelo, ma.MARCA_NOMBRE AS Marca, ea.ESTADOALERTA_NOMBRE AS Estado
FROM ARTICULO AS a, MODELO AS mo, MARCA AS ma, STOCK AS s, ESTADOALERTA AS ea
WHERE
a.MODELO_ID  = mo.MODELO_ID AND
a.ART_ID = s.ART_ID AND
a.ESTADOALERTA_ID = ea.ESTADOALERTA_ID AND
mo.MARCA_ID = ma.MARCA_ID 
AND (a.ART_INFOADICIONAL LIKE '%$itemABuscar%' 
OR a.ART_CODIGO LIKE '%$itemABuscar%')";
//echo $sqlSearch;

$resBusqueda = mysqli_query($MiConexion,$sqlSearch);


if($resBusqueda){
  
  if(mysqli_num_rows($resBusqueda)>0){

    while($row=mysqli_fetch_assoc($resBusqueda)){
      
      echo '<tr>';
      //echo '<td><a href="insertar_detalleventa.php?
      //id='.$row['Id'].'&idactual='.$id_vnta.'&codigo='.$row['Codigo'].'&desc='.$row['Descripcion'].
      //'&precio='.$row['Precio'].'">'.$row['Id'].'</a></td>';
      echo '<td>'.$row['Id'].'</td>';
      echo '<td>'.$row['Codigo'].'</td>';
      echo '<td>'.$row['Precio'].'</td>';
      echo '<td>'.$row['Descripcion'].'</td>';
      echo '<td>'.$row['Stock'].'</td>';
      echo '<td>'.$row['Modelo'].'</td>';
      echo '<td>'.$row['Marca'].'</td>';
      echo '<td>'.$row['Estado'].'</td>';
      echo '<td><a href="insertar_detalleventa.php?
      id='.$row['Id'].'&idactual='.$id_vnta.'&codigo='.$row['Codigo'].'&desc='.$row['Descripcion'].
      '&precio='.$row['Precio'].'">Agregar</a></td>';
      echo '</tr>';

    }
  }

}
}

} else {

  // nueva venta
  // creo la venta

$sqlInsert="INSERT INTO `venta` (`VENTA_ID`, `CLIENTE_ID`, `ESTADOVENTA_ID`, `VENTA_FECHAVENTA`, `VENTA_FECHAENTREGA`, `VENTA_FECHAANULACION`) 
VALUES (NULL, '1', '2', '2023-06-12', '2023-06-12', NULL)";

$resInsert = mysqli_query($MiConexion,$sqlInsert);

$idInsert="select max(venta_id) as venta_id from venta";
$resInsert = mysqli_query($MiConexion,$idInsert);

if(mysqli_num_rows($resInsert)>0){
  
    $row=mysqli_fetch_assoc($resInsert);
    $idactual=$row['venta_id'];
}

$_POST['idvnta'] =$idactual;


}

                              ?>

                              </tbody>
                          
                          
                        
                        </table>

                        
                      </div>
                  </div>

                  <div class="card">
                  <h4>Detalle Venta</h4>
                  <div class="col-auto">
                  
                  <form method="post">
                            
                            <button  class="btn btn-secondary" name="refrescar" value="refrescar">
                              <span class="tf-icons bx bx-refresh bx-flashing"></span>&nbsp; Refrescar
                            </button>
                  </form>

                  </div>
                    <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                              <thead>
                                  <th>Id</th>
                                  <th>Factura</th>
                                  <th>Vendedor</th>
                                  <th>Articulo</th>
                                  <th>Descripcion</th>
                                  <th>Precio Unitario</th>
                                  <th>Precio Final</th>
                                  <th>Accion</th>
                              </thead>

                              <!-- El id del cuerpo de la tabla. -->
                              <tbody >
                                <?php

/// Selecciono los items del detalle


if(isset($_POST['refrescar'])){

  $idUltInsert="select max(venta_id) as venta_id from venta";
  $resUltInsert = mysqli_query($MiConexion,$idUltInsert);
  
  
  if(mysqli_num_rows($resUltInsert)>0){
    
      $row=mysqli_fetch_assoc($resUltInsert);
      $idactual=$row['venta_id'];
  }

  $id_vnta = $idactual;

  //$id_vnta = 0;
  

$incremento = 0.5;

$sql3="SELECT dv.DETVENTA_ID as Id, dv.VENTA_ID as Factura, u.NOMBRE as Vendedor, dv.DETVENTA_ITEM as Articulo, a.ART_INFOADICIONAL as Descripcion, 
a.ART_PRECIOCOMPRA as Precio_unitario, a.ART_PRECIOCOMPRA*0.5+a.ART_PRECIOCOMPRA as Precio_final
from detalleventa as dv 
LEFT JOIN venta as v ON dv.VENTA_ID = v.VENTA_ID 
LEFT JOIN usuarios as u ON dv.ID = u.ID 
LEFT JOIN articulo as a ON dv.ART_ID = a.ART_ID 
where dv.VENTA_ID = $id_vnta";
//echo $sql3;

$getResultadoSelectDetalleVenta = $MiConexion->query($sql3);

$cantidadIV = $getResultadoSelectDetalleVenta->num_rows;
//echo 'cantidad es: '. $cantidadIV;

if($cantidadIV >0){
while($data2 = $getResultadoSelectDetalleVenta->fetch_assoc()){
 $ResultadoSelectDetalleVenta[] = $data2; 
}


for ($i = 0; $i < $cantidadIV; $i++) {
  echo '<tr>';
  echo '<th>'.$ResultadoSelectDetalleVenta[$i]['Id'].'</th>';
  echo '<th>'.$ResultadoSelectDetalleVenta[$i]['Factura'].'</th>';
  echo '<th>'.$ResultadoSelectDetalleVenta[$i]['Vendedor'].'</th>';
  echo '<th>'.$ResultadoSelectDetalleVenta[$i]['Articulo'].'</th>';
  echo '<th>'.$ResultadoSelectDetalleVenta[$i]['Descripcion'].'</th>';
  echo '<th>'.$ResultadoSelectDetalleVenta[$i]['Precio_unitario'].'</th>';
  echo '<th>'.$ResultadoSelectDetalleVenta[$i]['Precio_final'].'</th>';
  echo '<td><a href="/sysmoto/pedidos/eliminar_item_detalleventa.php?id='.$ResultadoSelectDetalleVenta[$i]['Id'].'">Eliminar</a></td>';
  }

}
?>
<div class="col-auto">
  <form target="_blank" action="factura.php?" method="get">
    <input type="hidden" name="id" value='<?php echo $id_vnta;?>'>
    <BR><BR>
    <button type="submit" class="btn btn-secondary" name="Factura" value="Generar Factura">
      <span class="tf-icons bx bx-note bx-flashing"></span>&nbsp; Generar Factura                            
    </button>
    <BR><BR>
  </form>
</div>

<?php
}


 ?>


                              </tbody>


                              </table>

                    </div>

                  </div>






                  <div class="row">
                      <div class="col-6">

                          <label id="lbl-total"></label>
                      </div>

                      <div class="col-6" id="nav-paginacion"></div>

                      <input type="hidden" id="pagina" value="1">
                      <input type="hidden" id="orderCol" value="0">
                      <input type="hidden" id="orderType" value="asc">
                  </div>
                </div>

<!-- ssssssssssssssssssssssssss -->

                  





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