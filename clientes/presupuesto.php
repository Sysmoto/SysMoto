<?php
session_start();
//print_r($_SESSION);
if (empty($_SESSION["Usuario"])) {

    header("Location: ../logout.php");

    exit();
}

require_once '../funciones/conexion.php';
$MiConexion=ConexionBD();
require_once '../funciones/clientes.php';
require_once '../funciones/ventas.php';
require_once '../funciones/articulos.php';

$articulos=listar_articulo_js($MiConexion);
$CantidadArticulos=count($articulos);

$articulo = json_encode($articulos);

$impuestos=listar_impuestos($MiConexion);
$CantidadImpuestos=count($impuestos);

$metodo=listar_met_pago($MiConexion);
$CantidadMetodo=count($metodo);

$filtro = '';
$clientes= listar_clientes_largo($filtro,$MiConexion);
$CantidadClientes=count($clientes);




if(isset($_POST["cliente"])) {
  print_r($_POST);
  $id_cliente=$_POST["cliente"];
  echo "IDDDDDDDDDDDDDDDDDDDDDDDD" . $id_cliente;
  $_POST['id_cliente'] = $id_cliente;
  print_r($_POST);

  $cliente = listar_clientes_corto($id_cliente,$MiConexion) ;
  if($id_cliente == 1) {
    $_POST['NombreCliente']= $cliente["CLIENTE_NOMBRE"];
    }
    else {
      $_POST['NombreCliente']= $cliente["CLIENTE_NOMBRE"] . " " . $cliente["CLIENTE_APELLIDO"]  ;
    }
}

if(isset($_POST["registrar"])) {

  //print_r($_POST);
  
  if(isset($_POST["item"]) > 0 and $_POST["totalCompra"] > 0) {
  
    $cantidadElementos = count($_POST["item"]);
    $id_venta=alta_venta($_POST,$MiConexion);
    echo $id_venta;
    echo $cantidadElementos;
    $alta_detalle_venta=alta_venta_detalle($_POST["item"],$id_venta,$MiConexion);

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
             if(empty($_POST["id_cliente"])) { ?>
              <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Presupuesto</h4>   
                    
                
                    <div class="card">
                    
                      <div class="table-responsive text-nowrap">
                          <table class="table" id="example2" >
                            <thead>
                              <tr>
                         
                                <th>Nombre</th>
                                <th>Apellido</th>                        
                                <th>Domicilio</th>
                                <th>Accion</th>  
                              </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            <?php for ($i=0; $i<$CantidadClientes; $i++) { ?>               
                            
                              <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> 
                                <strong><?php echo $clientes[$i]['CLIENTE_NOMBRE']; ?></strong></td>
                                <td><?php echo $clientes[$i]['CLIENTE_APELLIDO'];?></td>
                                <td><?php echo $clientes[$i]['DOM_CALLE'] . " " . $clientes[$i]['DOM_ALTURA'] . " - " . $clientes[$i]['CIUDAD_NOMBRE'] . " / " . $clientes[$i]['PROVINCIA_NOMBRE']; ?> </td>   
                                <td>
                                  <button type="submit" class="btn btn-secondary" name="cliente" value="<?php echo $clientes[$i]['CLIENTE_ID']; ?>" >
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
               if(isset($_POST['id_cliente']))  { ?>
              
              <input type="hidden" name="id_cliente" value="<?php echo $_POST["id_cliente"]; ?>" >
              <input type="hidden" name="NombreCliente" value="<?php echo $_POST["NombreCliente"]; ?>" >
           
              <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Presupuesto <?php echo $_POST["NombreCliente"] ; ?> </h4> 
                
                <div class="row">
                  <div class="col-sm-1 form-group-sm">
                    <label for="mg" class="form-label">MG(%)</label>
                    <input type="number" min="0" id="margen_gan" name="margen_gan" class="form-control" value="10">
                  </div>
                  
                  <div class="col-sm-2 form-group-sm">
                    <label for="impuesto" class="form-label">Impuestos</label>
                    <select id="impuesto" name="impuesto" class="select2 form-select">
                    <?php
                      for ($i = 0; $i < $CantidadImpuestos; $i++) {
                          echo '<option value="' . $impuestos[$i]['PORCENTAJE'] . '">' . $impuestos[$i]['NOMBRE'] . '</option>';
                          }
                        ?>
                    </select>
                    </div>
                    
                  <div class="col-sm-2 form-group-sm">
                    <label for="metodo" class="form-label">Metodo Pago</label>
                    <select id="impuestoSelect" name="metodo" class="select2 form-select">
                    <?php
                      for ($i = 0; $i < $CantidadMetodo; $i++) {
                          echo '<option value="' . $metodo[$i]['ID_METODO'] . '">' . $metodo[$i]['NOMBRE_METODO'] . '</option>';
                          }
                        ?>
                    </select>
                  </div>
                 
                  <div class="col-sm-1 form-group-sm">
                    <label for="descuento" class="form-label">Descuento(%)</label>
                    <input type="number" name="descuento" min="0" id="descuento" class="form-control" value="0">
                  </div>
                  <div class="col-sm-1 form-group-sm"> </div>
                  <div class="col-sm-2 form-group-sm">
                    <label for="metodo" class="form-label">Total Parcial</label>
                    <input type="text" min="0" name="totalParcial" id="inputSumaParcial" class="form-control" value="0" >
                  </div>
                  <div class="col-sm-2 form-group-sm">
                    <label for="metodo" class="form-label">Total Final</label>
                    <input type="text" min="0" name="totalCompra" id="inputSumaTotal" class="form-control" value="0" >
                  </div>
                </div>
                &nbsp;
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
                        <th>Cantidad Disponible</th>
                        <th>Cantidad Seleccionada</th>
                        <th>Precio Compra</th>
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
            inputCantidad.max = cantidadStock;
    
            inputPrecioCompra.addEventListener('input', function () {
            // Actualizar el total cuando cambie el precio de compra
            actualizarTotal(inputCantidad, inputPrecioCompra.value, inputTotal);
             });
            inputCantidad.addEventListener('change', function () {
                // Actualizar el total cuando cambie la cantidad seleccionada
                actualizarTotal(inputCantidad, precioCompra, inputTotal);
            });
            
            margen_gan.addEventListener('input', function () {
            // Actualizar el total cuando cambie el precio de compra
            actualizarTotal(inputCantidad, inputPrecioCompra.value, inputTotal);
             });

             impuesto.addEventListener('input', function () {
            // Actualizar el total cuando cambie el precio de compra
            actualizarTotal(inputCantidad, inputPrecioCompra.value, inputTotal);
             });

             descuento.addEventListener('input', function () {
            // Actualizar el total cuando cambie el precio de compra
            actualizarTotal(inputCantidad, inputPrecioCompra.value, inputTotal);
             });
             
             
            // Limpiar el contenido existente y agregar el nuevo input
            cellCantidadSeleccionada.innerHTML = '';
            cellCantidadSeleccionada.appendChild(inputCantidad);
    
            // Actualizar el precio de compra
            inputPrecioCompra.value = precioCompra;
    
            // Calcular el total inicial
            actualizarTotal(inputCantidad, precioCompra, inputTotal);
        });
    
        cellArticulo.appendChild(selectArticulo);

    }

    function actualizarTotal(inputCantidad, precioCompra, inputTotal) {
        var total = inputCantidad.value * precioCompra;
        total = total.toFixed(2);
        inputTotal.value = total;
      
        calcularSumaParcial();
    }

 
    document.getElementById('sumaTotalContainer').appendChild(inputSumaTotal);
    document.getElementById('multiplicadorContainer').appendChild(inputSumaTotal);

function calcularSumaParcial() {
    var sumaTotal = 0;
    var tabla = document.getElementById('tabla');
    var rowCount = tabla.rows.length;
    var ganancia = parseFloat(margen_gan.value) || 0;
    var impuestos = parseFloat(impuesto.value) || 0;
    var descuentos = parseFloat(descuento.value) || 0;
    var multiplicador = 1 + (ganancia / 100 ) + (impuestos / 100) - (descuentos / 100);

    for (var i = 1; i < rowCount; i++) { // Empezar desde 1 para omitir la fila de encabezado
        var inputTotal = tabla.rows[i].cells[5].querySelector('input');
        if (inputTotal) {
            sumaTotal += parseFloat(inputTotal.value) || 0;
        }
    }

    // Actualizar el input de suma total
    sumaTotal = sumaTotal.toFixed(2);
    inputSumaParcial.value = sumaTotal;
  
    var margen = document.getElementById('margen_gan');
    margen = margen / 100;
    var TotalFinal = (sumaTotal * multiplicador).toFixed(2);
    inputSumaTotal.value = TotalFinal;
    }

  
    </script>
      </form>
  </body>
</html>
