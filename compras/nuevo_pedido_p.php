<?php
session_start();
//print_r($_SESSION);
if (empty($_SESSION["Usuario"])) {

    header("Location: ../logout.php");

    exit();
}

require_once '../funciones/conexion.php';
$MiConexion=ConexionBD();
require_once '../funciones/pedidos.php';

require_once '../funciones/articulos.php';
$filtro='';
if(isset($_POST['id_proveedor'])) { $filtro = "WHERE PROVE_ID = " . $_POST['id_proveedor'] ;}

$articulos=listar_articulo_js_filt($filtro,$MiConexion);
$CantidadArticulos=count($articulos);
//print_r($articulos);
$articulo = json_encode($articulos);



require_once '../funciones/proveedores.php';

$filtro = "WHERE EXISTS ( SELECT 1 FROM articulo a WHERE a.PROVE_ID = p.PROVE_ID )
GROUP BY p.PROVE_ID" ;
$proveedores= listar_proveedores($filtro,$MiConexion);
if (is_array($proveedores) && count($proveedores) > 0) {
    $CantidadProveedores = count($proveedores);
} else {
    $CantidadProveedores = 0;
}



if(isset($_POST["id_proveedor"])) {
  
  $id_proveedor=$_POST["id_proveedor"];
  //$_POST['id_proveedor'] = $id_proveedor;


  $proveedor = listar_proveedor_corto($id_proveedor,$MiConexion) ;
  
}

if(isset($_POST["registrar"])) {

  //print_r($_POST);
  
  if(isset($_POST["item"]) > 0 and $_POST["totalParcial"] > 0) {
    //print_r($_POST);
    $cantidadElementos = count($_POST["item"]);
    $vendedor=$_SESSION["ID"];
    $id_pedido=alta_pedido($_POST,$MiConexion,$vendedor);

    $alta_detalle_pedido=alta_pedido_detalle($_POST["item"],$id_pedido,$MiConexion);
    echo "<script> 
    alert('Pedido creado') 
    window.open('/compras/pedidos.php','_top')      
        </script>";

    }
    else {
      echo " vacio";
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

    <title>SysMoto V <?php echo $_SESSION['Version']; ?></title>

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

            
                
            <form method='post' action="" enctype="multipart/form-data">

              
              
             
            <?php 
             if(empty($_POST["id_proveedor"])) { ?>
              <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Nuevo Pedido a Proveedor</h4>   
                    
                
                    <div class="card">
                    
                      <div class="table-responsive text-nowrap">
                        <table class="table" id="example2" >
                          <caption class="ms-4">&nbsp; </caption>
                            <thead>
                              <tr>
                                <th>Proveedor</th>
                                <th>Info</th>                        
                                <th>Loc/Prov</th>
                                <th>Accion</th>  
                              </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            <?php for ($i=0; $i<$CantidadProveedores; $i++) { ?>               
                            
                              <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> 
                                <strong><?php echo $proveedores[$i]['PROVE_NOMBRE']; ?></strong></td>
                                <td><?php echo $proveedores[$i]['PROVE_INFO'];?></td>
                                <td><?php echo $proveedores[$i]['CIUDAD_NOMBRE'] . " " . $proveedores[$i]['PROVINCIA_NOMBRE'] ; ?> </td>   
                                <td>
                                  <button type="submit" class="btn btn-secondary" name="id_proveedor" value="<?php echo $proveedores[$i]['PROVE_ID']; ?>" >
                                    <span class="bx bx-user fade-right"></span>&nbsp; Seleccionar
                                  </button> 
                                </td>
                              </tr>
                              <?php } ?>
                              
                              </tbody>
                          </table>
                          
                        </div>
                </div>
            
                <?php } ?> 
             
            
            
            <!-- / Content -->
               <?php 
               if(isset($_POST['id_proveedor']))  { 
                
                ?>
              
              <input type="hidden" name="id_proveedor" value="<?php echo $_POST["id_proveedor"]; ?>" >
           
           
              <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pedido para <?php echo $proveedor["PROVE_NOMBRE"] ; ?> </h4> 
                <div class="row">
                  
                  
                  <div class="col-sm-2 form-group-sm">
                    <label for="metodo" class="form-label">Total Parcial Estimado</label>
                    <input type="text" min="0" name="totalParcial" id="inputSumaParcial" class="form-control" value="0" >
                  </div>
          
                </div>
               
                <div class="row"> </div>
                <div class="row">
                  
                 <hr> 
                <div class="col-sm-2 form-group-sm">
                    <button type="button"  class="btn btn-primary me-2" onclick="agregarFila()">Agregar Item</button>
                </div>
                <div class="col-sm-1 form-group-sm">
                  &nbsp;
                </div>  
                <div class="col-sm-1 form-group-sm">
                  <button type="submit"  class="btn btn-primary me-2" name="registrar" >Enviar</button>
                </div>
                <div class="row"> &nbsp;</div> <hr>
                <table id="tabla" class="table"  >
                    <thead>
                      <tr>
                        <th>&nbsp;</th>
                        <th>Artículo</th>
                        <th>Cantidad disponible</th>
                        <th>Cantidad a pedir</th>
                        <th>Precio actual</th>
                       
                        <th>Total</th> 
                      </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                  </table>
                </div>


                <?php } ?> 
            </div>      
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
    <!-- DataTables  & Plugins -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/plugins/jszip/jszip.min.js"></script>
<script src="/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="/plugins/ventas/ventas.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


<script language="javascript">
         var articulos = <?php echo json_encode($articulos); ?>;

function agregarFila() {
    var tabla = document.getElementById('tabla');
    var tbody = tabla.getElementsByTagName('tbody')[0];
    var rowCount = tabla.rows.length;

    var newRow = tbody.insertRow(tbody.rows.length);
    var cellCodigo = newRow.insertCell(0);
    var cellArticulo = newRow.insertCell(1);

    var cellCantidadDisponible = newRow.insertCell(2);
    var cellCantidadSeleccionada = newRow.insertCell(3);
    var cellPrecioCompra = newRow.insertCell(4);
    //var cellPrecioVenta = newRow.insertCell(5);
    var cellTotal = newRow.insertCell(5);

    var inputTotal = document.createElement('input');
    var inpName = "item[" + rowCount + "][total]";
    inputTotal.type = 'text';
    inputTotal.name = inpName;
    inputTotal.classList.add("form-control");
    inputTotal.readOnly = true;
    cellTotal.appendChild(inputTotal);

    var inputPrecioCompra = document.createElement('input');
    var inpName = "item[" + rowCount + "][precio_unit]";
    inputPrecioCompra.type = 'text';
    inputPrecioCompra.name = inpName;
    inputPrecioCompra.classList.add("form-control");
    cellPrecioCompra.appendChild(inputPrecioCompra);

    //var inputPrecioVenta = document.createElement('input');
    //var inpName = "item[" + rowCount + "][precio_venta]";
    //inputPrecioVenta.type = 'text';
    //inputPrecioVenta.name = inpName;
    //inputPrecioVenta.classList.add("form-control");
    //cellPrecioVenta.appendChild(inputPrecioVenta);

    var selectArticulo = document.createElement('select');
    var inpName = "item[" + rowCount + "][articulo]";
    selectArticulo.name = inpName;
    selectArticulo.classList.add("form-select");
    articulos.forEach(function (articulo) {
        var option = document.createElement('option');
        option.value = articulo['ART_ID'];
        option.text = articulo['ART_INFOADICIONAL'];
        selectArticulo.appendChild(option);
    });

    selectArticulo.addEventListener('change', function () {
        var selectedArticulo = articulos.find(function (articulo) {
            return articulo['ART_ID'] == selectArticulo.value;
        });

        var cantidadStock = selectedArticulo ? selectedArticulo['CANT_STOCK'] : 0;
        var precioCompra = selectedArticulo ? selectedArticulo['ART_PRECIOCOMPRA'] : 0;

        // Mostrar la cantidad disponible
        cellCantidadDisponible.innerHTML = cantidadStock;

        // Crear input para la cantidad seleccionada
        var inputCantidad = document.createElement('input');
        var inpName = "item[" + rowCount + "][cantidad]";
        inputCantidad.name = inpName;
        inputCantidad.classList.add("form-control");
        inputCantidad.type = 'number';
        inputCantidad.value = 0;
        inputCantidad.min = 1;
        //inputCantidad.max = cantidadStock;

        inputCantidad.addEventListener('change', function () {
            // Actualizar el total multiplicado cuando cambie la cantidad seleccionada
            actualizarTotalMultiplicado(inputCantidad, inputPrecioCompra, inputTotal);
        });

        // Limpiar el contenido existente y agregar el nuevo input
        cellCantidadSeleccionada.innerHTML = '';
        cellCantidadSeleccionada.appendChild(inputCantidad);

        // Actualizar el precio de compra
        inputPrecioCompra.value = precioCompra;

        // Calcular el total inicial
        actualizarTotalMultiplicado(inputCantidad, inputPrecioCompra, inputTotal);
    });

    cellArticulo.appendChild(selectArticulo);
}

function actualizarTotalMultiplicado(inputCantidad, inputPrecioCompra, inputTotal) {
    var cantidad = parseFloat(inputCantidad.value) || 0;
    var precioCompra = parseFloat(inputPrecioCompra.value) || 0;

    var totalMultiplicado = cantidad * precioCompra;
    totalMultiplicado = totalMultiplicado.toFixed(2);

    inputTotal.value = totalMultiplicado;

    calcularSumaParcial();
}

function calcularSumaParcial() {
    var sumaTotal = 0;
    var tabla = document.getElementById('tabla');
    var rowCount = tabla.rows.length;

    for (var i = 1; i < rowCount; i++) { // Empezar desde 1 para omitir la fila de encabezado
        var inputTotal = tabla.rows[i].cells[5].querySelector('input');
        if (inputTotal) {
            sumaTotal += parseFloat(inputTotal.value) || 0;
        }
    }

    // Actualizar el input de suma total
    sumaTotal = sumaTotal.toFixed(2);
    inputSumaParcial.value = sumaTotal;

    var TotalFinal = sumaTotal;
    inputSumaTotal.value = TotalFinal;
}

  
    </script>
      </form>
  </body>
</html>
