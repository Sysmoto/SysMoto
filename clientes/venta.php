<?php
       // Conexión a la base de datos (reemplaza con tus propios detalles de conexión)
       $servername = "127.0.0.1";
       $username = "root";
       $password = "";
       $dbname = "sysmoto";
   

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Consulta SQL para obtener los datos
    $sql = "SELECT articulo.ART_ID,articulo.ART_INFOADICIONAL, stock.CANT_STOCK,          
    articulo.ART_PRECIOCOMPRA
    FROM articulo
    LEFT JOIN stock on stock.ART_ID = articulo.ART_ID
    ORDER BY 1;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $articulos = array();
     
      while ($row = $result->fetch_assoc()) {
        $articulos[] = $row;
      }
     
      $articulosJSON = json_encode($articulos);
      echo "<script>var articulos = $articulosJSON;</script>";
    } else {
      echo "0results";
    }

    // Cerrar conexión
    $conn->close();
    print_r($_POST);
    
    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $datosFormulario = $_POST;
    
        // Puedes hacer lo que necesites con los datos aquí
        // Por ejemplo, podrías guardarlos en la base de datos o realizar alguna otra acción.
    
        // Devolver una respuesta (puedes personalizar según tus necesidades)
        echo json_encode(["mensaje" => "Datos recibidos correctamente"]);
    }
    ?>
    
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cargar Tabla</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
    
            table, th, td {
                border: 1px solid #ddd;
            }
    
            th, td {
                padding: 10px;
                text-align: left;
            }
        </style>
        <script src="script.js"></script>
    </head>
    <body>
    
    <h2>Tabla de Items</h2>
    
    <form method="post" action="venta.php" id="miFormulario">
        <input type="hidden" name="formularioEnviado" value="1">
       
        <table id="tabla">
            <thead>
            <tr>
                <th>Código</th>
                <th>Artículo</th>
                <th>Cantidad Disponible</th>
                <th>Cantidad Seleccionada</th>
                <th>Precio Compra</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <!-- Las filas de la tabla se agregarán dinámicamente con JavaScript -->
            </tbody>
        </table>
    
        <button type="button" onclick="agregarFila()">Agregar Item</button>
        <button type="submit">Enviar</button>
        </form>
    
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
            inputTotal.readOnly = true;
            cellTotal.appendChild(inputTotal);
    
            var inputPrecioCompra = document.createElement('input');
            var inpName = "item[" + rowCount + "][precio_unit]";
            inputPrecioCompra.type = 'text';
            inputPrecioCompra.name = inpName;
            cellPrecioCompra.appendChild(inputPrecioCompra);
    
            var selectArticulo = document.createElement('select');
            var inpName = "item[" + rowCount + "][articulo]";
            selectArticulo.name = inpName;
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
        inputTotal.value = total;
    }
    </script>
     
    </body>
    </html>
    