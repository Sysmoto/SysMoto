<?php

function listar_articulo_js_filt($filtro,$ConexionBD) {
    $SQL = "SELECT articulo.ART_ID,articulo.ART_INFOADICIONAL, stock.CANT_STOCK,          
    articulo.ART_PRECIOCOMPRA
    FROM articulo
    LEFT JOIN stock on stock.ART_ID = articulo.ART_ID 
    $filtro 
    ORDER BY 1;";
    //echo $SQL;
    $rs = mysqli_query($ConexionBD, $SQL);
        
    $i=0;
    
    if ($rs->num_rows > 0) {
        $articulos = array();
        $nuevoArray = array('ART_ID' => 0, 'ART_INFOADICIONAL' => '-', 'CANT_STOCK' => 0, 'ART_PRECIOCOMPRA' => 0  );
        $articulos[] = $nuevoArray;
        // Obtener los datos y agregarlos al array
        while ($row = $rs->fetch_assoc()) {
          $articulos[] = $row;
          
        }
    }
    return $articulos;
}

function alta_pedido($datos,$ConexionBD,$comprador) {
  $id_proveedor =   $datos['id_proveedor'];
  
  $SQL="INSERT INTO pedido_proveedor () 
  VALUES (NULL,$id_proveedor,1,CURDATE(),NULL,NULL,$comprador)";
  //echo $SQL;
  if($ConexionBD->query($SQL) === TRUE) {
      $nuevoId = $ConexionBD->insert_id;
      } else {
      echo "Error al insertar el registro: " . $ConexionBD->error;
  }
  return $nuevoId;

}

function alta_pedido_detalle($datos,$id_pedido,$ConexionBD) {
  $contar_item=count($datos);
  
  for ($i = 1; $i <= $contar_item; $i++) {
      $articulo = $datos[$i]['articulo'];
      $cantidad = $datos[$i]['cantidad'];
      $precioUnitario = $datos[$i]['precio_unit'];
      
     
      $SQL= "INSERT INTO detallepedproveedor () 
      VALUES (NULL,$id_pedido,$articulo,$cantidad,$precioUnitario,NULL)";
      if($ConexionBD->query($SQL) === TRUE) {
          $nuevoId = $ConexionBD->insert_id;
          } 
          else {
          echo "Error al insertar el registro: " . $ConexionBD->error;
          }
  }
  return " ok";
}

function listar_pedidos($ConexionBD) {
    $SQL="SELECT ped.PEDIDO_ID,pro.PROVE_NOMBRE, est.ESTPEDPROV_NOMBRE, usu.USUARIO,
      ped.PEDIDO_FECHACREACION,ped.PEDIDO_FECHAENVIO, ped.PEDIDO_FECHACIERRE
      from pedido_proveedor ped
      LEFT JOIN proveedores pro ON pro.PROVE_ID = ped.PROVEEDOR_ID
      LEFT JOIN estadopedidoproveedor est ON est.ESTPEDPROV_ID = ped.ESTADOPEDIDO_ID
      LEFT JOIN usuarios usu on usu.ID = ped.COMPRADOR_ID 
      ORDER BY ped.PEDIDO_FECHACREACION DESC";
       $rs = mysqli_query($ConexionBD, $SQL);
       $i=0;
       while ($data = mysqli_fetch_array($rs)) {
           $pedidos[$i]['PEDIDO_ID'] = $data['PEDIDO_ID'];
           $pedidos[$i]['PROVE_NOMBRE'] = $data['PROVE_NOMBRE'];
           $pedidos[$i]['ESTPEDPROV_NOMBRE'] = $data['ESTPEDPROV_NOMBRE'];
           $pedidos[$i]['USUARIO'] = $data['USUARIO'];
           $pedidos[$i]['PEDIDO_FECHACREACION'] = $data['PEDIDO_FECHACREACION'];
           $pedidos[$i]['PEDIDO_FECHAENVIO'] = $data['PEDIDO_FECHAENVIO'];
           $pedidos[$i]['PEDIDO_FECHACIERRE'] = $data['PEDIDO_FECHACIERRE'];
           $i++;
               }
       return $pedidos;
  
       } 


?>
