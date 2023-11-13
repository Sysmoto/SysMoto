<?php
function listar_articulos($ConexionBD) {
    $SQL = "SELECT articulo.ART_ID,articulo.ART_INFOADICIONAL, stock.CANT_STOCK,
    proveedores.PROVE_NOMBRE,estadoalerta.ESTADOALERTA_NOMBRE,estadoarticulo.ESTADOART_NOMBRE,
    articulo.ART_PRECIOCOMPRA,articulo.ART_CODQR,articulo.ART_CODARTPROV,articulo.ART_UBICACION,
    estadoalerta.ESTADOALERTA_ID, estadoarticulo.EST_ART,articulo.ART_CODIGO
    FROM articulo
    LEFT JOIN stock on stock.ART_ID = articulo.ART_ID
    LEFT JOIN  proveedores ON proveedores.PROVE_ID = articulo.PROVE_ID
    LEFT JOIN estadoalerta ON estadoalerta.ESTADOALERTA_ID = articulo.ESTADOALERTA_ID
    LEFT JOIN estadoarticulo ON estadoarticulo.EST_ART = articulo.EST_ART
    ORDER BY 1;";
    
     $rs = mysqli_query($ConexionBD, $SQL);
        
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $articulos[$i]['ART_ID'] = $data['ART_ID'];
            $articulos[$i]['ART_INFOADICIONAL'] = $data['ART_INFOADICIONAL'];
            $articulos[$i]['CANT_STOCK'] = $data['CANT_STOCK'];
            $articulos[$i]['PROVE_NOMBRE'] = $data['PROVE_NOMBRE'];
            $articulos[$i]['ESTADOALERTA_NOMBRE'] = $data['ESTADOALERTA_NOMBRE'];
            $articulos[$i]['ESTADOART_NOMBRE'] = $data['ESTADOART_NOMBRE'];
            $articulos[$i]['ART_PRECIOCOMPRA'] = $data['ART_PRECIOCOMPRA'];
            $articulos[$i]['ART_CODQR'] = $data['ART_CODQR'];
            $articulos[$i]['ART_CODARTPROV'] = $data['ART_CODARTPROV'];
            $articulos[$i]['ART_UBICACION'] = $data['ART_UBICACION'];
            $articulos[$i]['ESTADOALERTA_ID'] = $data['ESTADOALERTA_ID'];
            $articulos[$i]['EST_ART'] = $data['EST_ART'];
            $articulos[$i]['ART_CODIGO'] = $data['ART_CODIGO'];
            $i++;
    }
    return $articulos;
}
function listar_art_corto($ConexionBD) {
    $SQL = "SELECT articulo.ART_INFOADICIONAL, articulo.ART_PRECIOCOMPRA,articulo.ART_CODQR,
   articulo.ART_UBICACION, marca.MARCA_NOMBRE, modelo.MODELO_NOMBRE,articulo.ART_FOTO,
   articulo.ART_CODIGO
    FROM articulo
    LEFT JOIN modelo ON  modelo.MODELO_ID = articulo.MODELO_ID
    LEFT JOIN marca ON modelo.MARCA_ID = marca.MARCA_ID
    ORDER BY marca.MARCA_NOMBRE, modelo.MODELO_NOMBRE ;";
    
     $rs = mysqli_query($ConexionBD, $SQL);
        
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $articulos[$i]['ART_INFOADICIONAL'] = $data['ART_INFOADICIONAL'];
            $articulos[$i]['ART_PRECIOCOMPRA'] = $data['ART_PRECIOCOMPRA'];
            $articulos[$i]['ART_CODQR'] = $data['ART_CODQR'];
            $articulos[$i]['ART_UBICACION'] = $data['ART_UBICACION'];
            $articulos[$i]['MARCA_NOMBRE'] = $data['MARCA_NOMBRE'];
            $articulos[$i]['MODELO_NOMBRE'] = $data['MODELO_NOMBRE'];
            $articulos[$i]['ART_FOTO'] = $data['ART_FOTO'];
            $articulos[$i]['ART_CODIGO'] = $data['ART_CODIGO'];
            $i++;
    }
    return $articulos;
}



function Datos_articulo($id_articulo,$ConexionBD) {
    $SQL = "SELECT articulo.ART_ID, articulo.ART_INFOADICIONAL, stock.CANT_STOCK,
    proveedores.PROVE_NOMBRE,estadoalerta.ESTADOALERTA_NOMBRE,estadoarticulo.ESTADOART_NOMBRE,
    articulo.ART_PRECIOCOMPRA,articulo.ART_CODQR,articulo.ART_CODARTPROV,articulo.ART_UBICACION,
    estadoalerta.ESTADOALERTA_ID, estadoarticulo.EST_ART, articulo.ART_FOTO,articulo.ART_CODIGO,
    marca.MARCA_NOMBRE, modelo.MODELO_NOMBRE, articulo.ART_CODARTPROV, marca.MARCA_ID, modelo.MODELO_ID
    FROM articulo
    LEFT JOIN stock on stock.ART_ID = articulo.ART_ID
    LEFT JOIN  proveedores ON proveedores.PROVE_ID = articulo.PROVE_ID
    LEFT JOIN estadoalerta ON estadoalerta.ESTADOALERTA_ID = articulo.ESTADOALERTA_ID
    LEFT JOIN estadoarticulo ON estadoarticulo.EST_ART = articulo.EST_ART
    LEFT JOIN modelo ON  modelo.MODELO_ID = articulo.MODELO_ID
    LEFT JOIN marca ON modelo.MARCA_ID = marca.MARCA_ID
    WHERE articulo.ART_ID = $id_articulo ;";
    
     $rs = mysqli_query($ConexionBD, $SQL);
        
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $articulo['ART_ID'] = $data['ART_ID'];
            $articulo['ART_INFOADICIONAL'] = $data['ART_INFOADICIONAL'];
            $articulo['CANT_STOCK'] = $data['CANT_STOCK'];
            $articulo['PROVE_NOMBRE'] = $data['PROVE_NOMBRE'];
            $articulo['ESTADOALERTA_NOMBRE'] = $data['ESTADOALERTA_NOMBRE'];
            $articulo['ESTADOART_NOMBRE'] = $data['ESTADOART_NOMBRE'];
            $articulo['ART_PRECIOCOMPRA'] = $data['ART_PRECIOCOMPRA'];
            $articulo['ART_CODQR'] = $data['ART_CODQR'];
            $articulo['ART_CODARTPROV'] = $data['ART_CODARTPROV'];
            $articulo['ART_UBICACION'] = $data['ART_UBICACION'];
            $articulo['ESTADOALERTA_ID'] = $data['ESTADOALERTA_ID'];
            $articulo['EST_ART'] = $data['EST_ART'];
            $articulo['ART_FOTO'] = $data['ART_FOTO'];
            $articulo['ART_CODIGO'] = $data['ART_CODIGO'];
            $articulo['MARCA_NOMBRE'] = $data['MARCA_NOMBRE'];
            $articulo['MODELO_NOMBRE'] = $data['MODELO_NOMBRE'];
            $articulo['ART_CODARTPROV'] = $data['ART_CODARTPROV'];
            $articulo['MODELO_ID'] = $data['MODELO_ID'];
            $articulo['MARCA_ID'] = $data['MARCA_ID'];


            
            
            $i++;
    }


    return $articulo;

}

function imagen($datos_articulos,$imagen,$ConexionBD) {
    echo "llamada funcion";
    $sql = "  UPDATE articulo SET ART_FOTO = '$imagen' WHERE ART_ID =".$datos_articulos['id_articulo'].";";
    if($ConexionBD->query($sql) === TRUE) {
        $resultado="Imagen subida Correctamente";
        } else {
            $resultado="Incorrectamente porque ".$ConexionBD->error;
        }
    return $resultado;
}

function borrarimagen($datos_articulos,$ConexionBD) {
    
    $sql = "  UPDATE articulo SET ART_FOTO = '' WHERE ART_ID =".$datos_articulos['id_articulo'].";";
    if($ConexionBD->query($sql) === TRUE) {
        $resultado="Imagen borrada Correctamente";
        } else {
            $resultado="Incorrectamente porque ".$ConexionBD->error;
        }
    return $resultado;
}

function listar_marcas($ConexionBD) {
    $SQL = "SELECT * FROM marca ORDER BY 2;";
    
     $rs = mysqli_query($ConexionBD, $SQL);
    
    while ($data = mysqli_fetch_array($rs)) {
        $marca[$data['MARCA_ID']] = $data['MARCA_NOMBRE'];    
        
    }
    return $marca;
}


function listar_proveedor($ConexionBD) {
    $SQL = "SELECT PROVE_ID, PROVE_NOMBRE FROM proveedores ORDER BY 2;";
    
     $rs = mysqli_query($ConexionBD, $SQL);
    $i=1;
    while ($data = mysqli_fetch_array($rs)) {
        $proveedores[$i]['PROVE_ID'] = $data['PROVE_ID'];    
        $proveedores[$i]['PROVE_NOMBRE'] = $data['PROVE_NOMBRE'];
        $i++;
    }
    return $proveedores;
}


function alta_articulo($datos_articulos,$imagen,$ConexionBD) {
    print_r($datos_articulos);
    $nombre = $datos_articulos["Nombre"];
    $stock = $datos_articulos["Stock"];
    $proveedor = $datos_articulos["Proveedor"];
    $marca = $datos_articulos["Marca"];
    $modelo = $datos_articulos["Modelo"];
    $ubicacion = $datos_articulos["Ubicacion"];
    $precio=$datos_articulos["Precio_compra"];
    $qr = $datos_articulos["QR"];
    $codart = $datos_articulos["Cod_art"];
    $codprov = $datos_articulos["Cod_prov"];
    if($stock > 0 ){ $estart=1;} else{ $estart=2;}
    $sql = "  INSERT INTO articulo () VALUES (NULL,$proveedor,$modelo,1,$estart,$codart,'$precio','$nombre','$ubicacion','$qr','$imagen',$codprov );";
    
    if($ConexionBD->query($sql) === TRUE) {
        $lastId = $ConexionBD->insert_id;
        $sql2= "INSERT INTO stock () VALUES ($lastId,$stock)";
        if($ConexionBD->query($sql2) === TRUE) {
            $resultado="Datos subidos correctamente";
        } else {
            $resultado="Incorrectamente porque ".$ConexionBD->error;
        }
    }
    return $resultado;
}

function alta_producto($datos_articulos,$ConexionBD) {
    print_r($datos_articulos);
    $nombre = $datos_articulos["Nombre"];
    $marca = $datos_articulos["marca"];
    $precio=$datos_articulos["Precio_compra"];
    $codart = $datos_articulos["Cod_art"];
    
    $sql = "  INSERT INTO producto () VALUES (NULL,'$nombre','$marca',$precio,'$codart' );";
   echo $sql; 
    if($ConexionBD->query($sql) === TRUE) {
      $resultado="Datos elininado correctamente";
        } else {
            $resultado="Incorrectamente porque ".$ConexionBD->error;
        }
   
    return $resultado;
}

function modificar_articulo($datos_articulos,$ConexionBD) {
    //print_r($datos_articulos);
    $nombre = $datos_articulos["Nombre"];
    $stock = $datos_articulos["Stock"];
    $proveedor = $datos_articulos["Proveedor"];
    $marca = $datos_articulos["Marca"];
    $modelo = $datos_articulos["Modelo"];
    $ubicacion = $datos_articulos["Ubicacion"];
    $precio=$datos_articulos["Precio_compra"];
    $qr = $datos_articulos["QR"];
    $codart = $datos_articulos["Cod_art"];
    $codprov = $datos_articulos["Cod_prov"];
    if($stock > 0 ){ $estart=1;} else{ $estart=2;}
    $sql = "UPDATE articulo SET  ART_INFOADICIONAL='$nombre' , ART_CODIGO=$codart, ART_PRECIOCOMPRA='$precio',
    ART_UBICACION = '$ubicacion', ART_CODQR='$qr',ART_CODARTPROV='$codprov' WHERE ART_ID =".$datos_articulos['id_articulo'].";";
    //print $sql;
    if($ConexionBD->query($sql) === TRUE) {
        $lastId = $ConexionBD->insert_id;
        $sql2= "update  stock SET CANT_STOCK = '$stock' WHERE ART_ID =".$datos_articulos['id_articulo'].";";
        if($ConexionBD->query($sql2) === TRUE) {
           $resultado="Datos subidos correctamente";
        } else {
            $resultado="Incorrectamente porque ".$ConexionBD->error;
        }
    }
    return $resultado;
}


?>