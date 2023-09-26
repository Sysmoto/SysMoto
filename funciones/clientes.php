<?php
function listar_clientes_largo($ConexionBD) {
    $SQL = "SELECT cl.CLIENTE_ID, cl.DOM_ID, cl.CONTACTO_ID, cl.CLIENTE_NOMBRE, cl.CLIENTE_APELLIDO, cl.CLIENTE_FECHAALTA, cl.CLIENTE_FECHABAJA, 
    co.CONTACTO_TEL1, co.CONTACTO_TEL2, co.CONTACTO_EMAIL, co.CONTACTO_EMAIL, co.CONTACTO_WEB, co.CONTACTO_INFO, 
    dom.DOM_CALLE, dom.DOM_ALTURA, dom.DOM_CP, ci.CIUDAD_NOMBRE, pr.PROVINCIA_NOMBRE
    FROM cliente cl
    LEFT JOIN contacto co ON cl.CONTACTO_ID = co.CONTACTO_ID
    LEFT JOIN domicilio dom ON cl.DOM_ID = dom.DOM_ID
    LEFT JOIN ciudad ci ON dom.CIUDAD_ID = ci.CIUDAD_ID
    LEFT JOIN provincia pr ON ci.PROVINCIA_ID = pr.PROVINCIA_NOMBRE
    ORDER BY 4;";
    
     $rs = mysqli_query($ConexionBD, $SQL);
        
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
        $clientes[$i]['CLIENTE_ID'] = $data['CLIENTE_ID'];
        $clientes[$i]['DOM_ID'] = $data['DOM_ID'];
        $clientes[$i]['CONTACTO_ID'] = $data['CONTACTO_ID'];
        $clientes[$i]['CLIENTE_NOMBRE'] = $data['CLIENTE_NOMBRE'];
        $clientes[$i]['CLIENTE_APELLIDO'] = $data['CLIENTE_APELLIDO'];
        $clientes[$i]['CLIENTE_FECHAALTA'] = $data['CLIENTE_FECHAALTA'];
        $clientes[$i]['CLIENTE_FECHABAJA'] = $data['CLIENTE_FECHABAJA'];
        $clientes[$i]['CONTACTO_TEL1'] = $data['CONTACTO_TEL1'];
        $clientes[$i]['CONTACTO_TEL2'] = $data['CONTACTO_TEL2'];
        $clientes[$i]['CONTACTO_EMAIL'] = $data['CONTACTO_EMAIL'];
        $clientes[$i]['CONTACTO_EMAIL'] = $data['CONTACTO_EMAIL'];
        $clientes[$i]['CONTACTO_WEB'] = $data['CONTACTO_WEB'];
        $clientes[$i]['CONTACTO_INFO'] = $data['CONTACTO_INFO'];
        $clientes[$i]['DOM_CALLE'] = $data['DOM_CALLE'];
        $clientes[$i]['DOM_ALTURA'] = $data['DOM_ALTURA'];
        $clientes[$i]['DOM_CP'] = $data['DOM_CP'];
        $clientes[$i]['CIUDAD_NOMBRE'] = $data['CIUDAD_NOMBRE'];
        $clientes[$i]['PROVINCIA_NOMBRE'] = $data['PROVINCIA_NOMBRE'];
   
            $i++;
    }
    return $clientes;
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
            $clientes[$i]['ART_INFOADICIONAL'] = $data['ART_INFOADICIONAL'];
            $clientes[$i]['ART_PRECIOCOMPRA'] = $data['ART_PRECIOCOMPRA'];
            $clientes[$i]['ART_CODQR'] = $data['ART_CODQR'];
            $clientes[$i]['ART_UBICACION'] = $data['ART_UBICACION'];
            $clientes[$i]['MARCA_NOMBRE'] = $data['MARCA_NOMBRE'];
            $clientes[$i]['MODELO_NOMBRE'] = $data['MODELO_NOMBRE'];
            $clientes[$i]['ART_FOTO'] = $data['ART_FOTO'];
            $clientes[$i]['ART_CODIGO'] = $data['ART_CODIGO'];
            $i++;
    }
    return $clientes;
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

function imagen($datos_clientes,$imagen,$ConexionBD) {
    echo "llamada funcion";
    $sql = "  UPDATE articulo SET ART_FOTO = '$imagen' WHERE ART_ID =".$datos_clientes['id_articulo'].";";
    if($ConexionBD->query($sql) === TRUE) {
        $resultado="Imagen subida Correctamente";
        } else {
            $resultado="Incorrectamente porque ".$ConexionBD->error;
        }
    return $resultado;
}

function borrarimagen($datos_clientes,$ConexionBD) {
    
    $sql = "  UPDATE articulo SET ART_FOTO = '' WHERE ART_ID =".$datos_clientes['id_articulo'].";";
    if($ConexionBD->query($sql) === TRUE) {
        $resultado="Imagen borrada Correctamente";
        } else {
            $resultado="Incorrectamente porque ".$ConexionBD->error;
        }
    return $resultado;
}

function listar_provincias($ConexionBD) {
    $SQL = "SELECT * FROM provincia ORDER BY 2;";
    
     $rs = mysqli_query($ConexionBD, $SQL);
    
    while ($data = mysqli_fetch_array($rs)) {
        $provincias[$data['PROVINCIA_ID']] = $data['PROVINCIA_NOMBRE'];    
        
    }
    return $provincias;
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


function alta_articulo($datos_clientes,$imagen,$ConexionBD) {
    print_r($datos_clientes);
    $nombre = $datos_clientes["Nombre"];
    $stock = $datos_clientes["Stock"];
    $proveedor = $datos_clientes["Proveedor"];
    $marca = $datos_clientes["Marca"];
    $modelo = $datos_clientes["Modelo"];
    $ubicacion = $datos_clientes["Ubicacion"];
    $precio=$datos_clientes["Precio_compra"];
    $qr = $datos_clientes["QR"];
    $codart = $datos_clientes["Cod_art"];
    $codprov = $datos_clientes["Cod_prov"];
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

function modificar_articulo($datos_clientes,$ConexionBD) {
    //print_r($datos_clientes);
    $nombre = $datos_clientes["Nombre"];
    $stock = $datos_clientes["Stock"];
    $proveedor = $datos_clientes["Proveedor"];
    $marca = $datos_clientes["Marca"];
    $modelo = $datos_clientes["Modelo"];
    $ubicacion = $datos_clientes["Ubicacion"];
    $precio=$datos_clientes["Precio_compra"];
    $qr = $datos_clientes["QR"];
    $codart = $datos_clientes["Cod_art"];
    $codprov = $datos_clientes["Cod_prov"];
    if($stock > 0 ){ $estart=1;} else{ $estart=2;}
    $sql = "UPDATE articulo SET  ART_INFOADICIONAL='$nombre' , ART_CODIGO=$codart, ART_PRECIOCOMPRA='$precio',
    ART_UBICACION = '$ubicacion', ART_CODQR='$qr',ART_CODARTPROV='$codprov' WHERE ART_ID =".$datos_clientes['id_articulo'].";";
    //print $sql;
    if($ConexionBD->query($sql) === TRUE) {
        $lastId = $ConexionBD->insert_id;
        $sql2= "update  stock SET CANT_STOCK = '$stock' WHERE ART_ID =".$datos_clientes['id_articulo'].";";
        if($ConexionBD->query($sql2) === TRUE) {
           $resultado="Datos subidos correctamente";
        } else {
            $resultado="Incorrectamente porque ".$ConexionBD->error;
        }
    }
    return $resultado;
}


?>