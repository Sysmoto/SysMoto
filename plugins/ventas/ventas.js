// script.js

function agregarFila() {
    var tabla = document.getElementById('tabla');
    var tbody = tabla.getElementsByTagName('tbody')[0];
  
    var newRow = tbody.insertRow(tbody.rows.length);
    var cellCodigo = newRow.insertCell(0);
    var cellArticulo = newRow.insertCell(1);
    var cellCantidad = newRow.insertCell(2);
    var cellPrecioCompra = newRow.insertCell(3);
  
    var selectArticulo = document.createElement('select');
    articulos.forEach(function(articulo) {
      var option = document.createElement('option');
      option.value = articulo['ART_ID'];
      option.text = articulo['ART_INFOADICIONAL'];
      selectArticulo.appendChild(option);
    });
  
    selectArticulo.addEventListener('change', function() {
      var selectedArticulo = articulos.find(function(articulo) {
        return articulo['ART_ID'] == selectArticulo.value;
      });
  
      var cantidadStock = selectedArticulo ? selectedArticulo['CANT_STOCK'] : 0;
      var precioCompra = selectedArticulo ? selectedArticulo['ART_PRECIOCOMPRA'] : 0;
  
      cellCantidad.innerHTML = '<input type="number" value="1" min="1" max="' + cantidadStock + '" onchange="actualizarTotal(this, ' + precioCompra + ')">';
      cellPrecioCompra.innerHTML = precioCompra;
      // Puedes establecer un valor predeterminado o realizar cálculos adicionales aquí
    });
  
    cellArticulo.appendChild(selectArticulo);
  }
  
  function actualizarTotal(inputCantidad, precioCompra) {
    var total = inputCantidad.value * precioCompra;
    var row = inputCantidad.closest('tr');
    var cellTotal = row.insertCell(4); // Agrega una nueva celda para el total
  
    cellTotal.innerHTML = total;
  }
  