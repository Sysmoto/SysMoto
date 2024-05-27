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