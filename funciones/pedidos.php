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

       function listar_pedido($id_pedido,$ConexionBD) {
        $SQL="SELECT ped.PEDIDO_ID,pro.PROVE_NOMBRE, est.ESTPEDPROV_NOMBRE, usu.USUARIO,
          ped.PEDIDO_FECHACREACION,ped.PEDIDO_FECHAENVIO, ped.PEDIDO_FECHACIERRE,
          ped.ESTADOPEDIDO_ID,  con.CONTACTO_EMAIL
          from pedido_proveedor ped
          LEFT JOIN proveedores pro ON pro.PROVE_ID = ped.PROVEEDOR_ID
          LEFT JOIN estadopedidoproveedor est ON est.ESTPEDPROV_ID = ped.ESTADOPEDIDO_ID
          LEFT JOIN usuarios usu on usu.ID = ped.COMPRADOR_ID 
          LEFT JOIN contacto con ON pro.CONTACTO_ID = con.CONTACTO_ID
          WHERE ped.PEDIDO_ID = $id_pedido";

          //echo $SQL;
           $rs = mysqli_query($ConexionBD, $SQL);
           $i=0;
           while ($data = mysqli_fetch_array($rs)) {
               $pedido['PEDIDO_ID'] = $data['PEDIDO_ID'];
               $pedido['PROVE_NOMBRE'] = $data['PROVE_NOMBRE'];
               $pedido['ESTPEDPROV_NOMBRE'] = $data['ESTPEDPROV_NOMBRE'];
               $pedido['USUARIO'] = $data['USUARIO'];
               $pedido['PEDIDO_FECHACREACION'] = $data['PEDIDO_FECHACREACION'];
               $pedido['PEDIDO_FECHAENVIO'] = $data['PEDIDO_FECHAENVIO'];
               $pedido['PEDIDO_FECHACIERRE'] = $data['PEDIDO_FECHACIERRE'];
               $pedido['ESTADOPEDIDO_ID'] = $data['ESTADOPEDIDO_ID'];
               $pedido['CONTACTO_EMAIL'] = $data['CONTACTO_EMAIL'];
               $i++;
                   }
           return $pedido;
      
           } 

  function listar_item_pedido($id_venta,$ConexionBD){ 
            $SQL="  SELECT d.PEDPROV_ID,  d.DETPEDPROV_CANT, d.DETPEDPROV_PRECIO_ORIG,
            a.ART_INFOADICIONAL, d.DETPEDPROV_PRECIO_COMPRA, mo.MODELO_NOMBRE,
            ma.MARCA_NOMBRE
            FROM detallepedproveedor d 
            LEFT JOIN articulo a ON d.DETPEDPROV_ITEM = a.ART_ID 
            LEFT JOIN stock s ON a.ART_ID = s.ART_ID
            LEFT JOIN modelo mo ON a.MODELO_ID = mo.MODELO_ID
            LEFT JOIN marca ma ON mo.MARCA_ID = ma.MARCA_ID
            WHERE d.PEDPROV_ID = $id_venta;";
                //echo $SQL;
            $rs = mysqli_query($ConexionBD, $SQL);
            $i=0;
            while ($data = mysqli_fetch_array($rs)) {
                
                $item[$i]['ART_INFOADICIONAL']  = $data['ART_INFOADICIONAL'];
                $item[$i]['DETPEDPROV_PRECIO_ORIG']   = $data['DETPEDPROV_PRECIO_ORIG'];
                $item[$i]['DETPEDPROV_CANT']         = $data['DETPEDPROV_CANT'];
                $item[$i]['DETPEDPROV_PRECIO_COMPRA']         = $data['DETPEDPROV_PRECIO_COMPRA'];
                $item[$i]['MODELO_NOMBRE']         = $data['MODELO_NOMBRE'];
                $item[$i]['MARCA_NOMBRE']         = $data['MARCA_NOMBRE'];
                $i++;
            }
            return $item;
        }
        
        function cambiar_estado_cancelar($id_pedido,$estado,$ConexionBD){ 
          $SQL="UPDATE pedido_proveedor SET ESTADOPEDIDO_ID = $estado, PEDIDO_FECHACIERRE = CURDATE() WHERE PEDIDO_ID = $id_pedido ";
          if($ConexionBD->query($SQL) === TRUE) {
              $salida = "Se cambio estado";
            } else {
              $salida = "Error al insertar el registro: " . $ConexionBD->error;
        }
        return $salida;

        }

        function cambiar_estado_enviado($id_pedido,$estado,$ConexionBD){ 
          $SQL="UPDATE pedido_proveedor SET ESTADOPEDIDO_ID = $estado, PEDIDO_FECHAENVIO = CURDATE() WHERE PEDIDO_ID = $id_pedido ";
          if($ConexionBD->query($SQL) === TRUE) {
              $salida = "Se cambio estado";
            } else {
              $salida = "Error al insertar el registro: " . $ConexionBD->error;
        }
        return $salida;

        }

?>
