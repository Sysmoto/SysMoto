<?php
function listar_articulos($ConexionBD) {
    $SQL = "SELECT articulo.ART_ID,articulo.ART_INFOADICIONAL, stock.CANT_STOCK,
    proveedores.PROVE_NOMBRE,estadoalerta.ESTADOALERTA_NOMBRE,estadoarticulo.ESTADOART_NOMBRE,
    articulo.ART_PRECIOCOMPRA,articulo.ART_CODQR,articulo.ART_CODARTPROV,articulo.ART_UBICACION,
    estadoalerta.ESTADOALERTA_ID, estadoarticulo.EST_ART
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
            $i++;
    }
    return $articulos;
}

function Datos_articulo($id_articulo,$ConexionBD) {
    $SQL = "SELECT articulo.ART_ID,articulo.ART_INFOADICIONAL, stock.CANT_STOCK,
    proveedores.PROVE_NOMBRE,estadoalerta.ESTADOALERTA_NOMBRE,estadoarticulo.ESTADOART_NOMBRE,
    articulo.ART_PRECIOCOMPRA,articulo.ART_CODQR,articulo.ART_CODARTPROV,articulo.ART_UBICACION,
    estadoalerta.ESTADOALERTA_ID, estadoarticulo.EST_ART, articulo.ART_FOTO
    FROM articulo
    LEFT JOIN stock on stock.ART_ID = articulo.ART_ID
    LEFT JOIN  proveedores ON proveedores.PROVE_ID = articulo.PROVE_ID
    LEFT JOIN estadoalerta ON estadoalerta.ESTADOALERTA_ID = articulo.ESTADOALERTA_ID
    LEFT JOIN estadoarticulo ON estadoarticulo.EST_ART = articulo.EST_ART
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

            
            
            $i++;
    }


    return $articulo;

}

function imagen($datos_articulos,$imagen,$ConexionBD) {
    
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
?>