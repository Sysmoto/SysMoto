<?php

/* Funciones ustilizadas en el modulo de:
    - Venta - Detalle
    - Listar pedidos
    - ABM Clientes
*/


require_once '../funciones/conexion.php';


function Listar_detalleVenta($vConexion, $id) {

    $Listado=array();

    //1) genero la consulta que deseo
    
    $sql4="SELECT dv.DETVENTA_ID as Id, dv.VENTA_ID as Factura, u.NOMBRE as Vendedor, dv.DETVENTA_ITEM as Articulo, a.ART_INFOADICIONAL as Descripcion, 
    a.ART_PRECIOCOMPRA as Precio_unitario, a.ART_PRECIOCOMPRA*0.5+a.ART_PRECIOCOMPRA as Precio_final
    from detalleventa as dv, venta as v, usuarios as u, articulo as a
    where dv.VENTA_ID = v.VENTA_ID and
    dv.ID = u.ID and
    dv.ART_ID = a.ART_ID and
    v.VENTA_ID = $id";

    //2) a la conexion actual le brindo mi consulta, y el resultado lo entrego a variable $rs
     $rs = mysqli_query($vConexion, $sql4);
     //print_r($rs);
     //3) el resultado deberá organizarse en una matriz, entonces lo recorro
     $i=0;

    while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['Id'] = $data['Id'];
            $Listado[$i]['Factura'] = $data['Factura'];
            $Listado[$i]['Vendedor'] = $data['Vendedor'];
            $Listado[$i]['Articulo'] = $data['Articulo'];
            $Listado[$i]['Descripcion'] = $data['Descripcion'];
            $Listado[$i]['Precio_unitario'] = $data['Precio_unitario'];
            $Listado[$i]['Precio_final'] = $data['Precio_final'];
            $i++;
    }


    //devuelvo el listado generado en el array $Listado. (Podra salir vacio o con datos)..
    return $Listado;

}

function ConsultaPreInsert($vConexion, $id, $consulta) {

    $Listado=array();


    return $Listado;

}

function ins_detalleVenta($vConexion,$Id){

    $ListadoDetalleVenta = ConsultaPreInsert($vConexion,$Id,$consulta);

    print_r($ListadoDetalleVenta);
    
    echo ' --- vale: '.$ListadoDetalleVenta[0]['Id'].' ---';
    echo ' --- vale: '.$ListadoDetalleVenta[0]['Descripcion'].' ---';

    

    //$sqlInert="INSERT INTO `detalleventa` (`DETVENTA_ID`, `VENTA_ID`, `ID`, `ART_ID`, `DETVENTA_ITEM`, `DETVENTA_CANT`, `DETVENTA_PRECVTA`)
    //VALUES (NULL, $Id, '6', '1', '1009324', '2', '1080');";

    //$rs2 = mysqli_query($vConexion, $sqlInert);

}

?>