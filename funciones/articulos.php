<?php
function listar_articulos($ConexionBD) {
    
    $SQL = "SELECT articulo.ART_ID,articulo.ART_INFOADICIONAL, stock.CANT_STOCK,
    proveedores.PROVE_NOMBRE,estadoalerta.ESTADOALERTA_NOMBRE,estadoarticulo.ESTADOART_NOMBRE,
    articulo.ART_PRECIOCOMPRA,articulo.ART_CODQR,articulo.ART_CODARTPROV,articulo.ART_UBICACION
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
            $i++;
    }


    return $articulos;

}
?>