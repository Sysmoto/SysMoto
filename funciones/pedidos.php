<?php
function listar_ventas($filtro,$ConexionBD) {
    echo $filtro;
    $SQL= "SELECT v.VENTA_ID as Factura, u.NOMBRE as Vendedor, dv.DETVENTA_ITEM as Articulo, 
    a.ART_INFOADICIONAL as Descripcion,  a.ART_PRECIOCOMPRA as Precio_unitario,
     a.ART_PRECIOCOMPRA*0.5+a.ART_PRECIOCOMPRA as Precio_final,v.VENTA_FECHAVENTA as Fecha_Venta, 
     ev.ESTADOVENTA_NOMBRE as Estado_venta, c.CLIENTE_NOMBRE as Cliente	
    from detalleventa as dv
    left join  venta AS v ON dv.VENTA_ID = v.VENTA_ID 
    left join  usuarios AS u ON dv.ID = u.ID
    left join articulo AS a ON dv.ART_ID = a.ART_ID 
    left join cliente AS c ON v.CLIENTE_ID = c.CLIENTE_ID
    left join estadoventa as ev ON v.ESTADOVENTA_ID = ev.ESTADOVENTA_ID ". $filtro;

    $rs = mysqli_query($ConexionBD, $SQL);
        
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
        $venta[$i]['Factura'] = $data['Factura'];
        $venta[$i]['Vendedor'] = $data['Vendedor'];
        $venta[$i]['Articulo'] = $data['Articulo'];
        $venta[$i]['Descripcion'] = $data['Descripcion'];
        $venta[$i]['Precio_unitario'] = $data['Precio_unitario'];
        $venta[$i]['Precio_final'] = $data['Precio_final'];
        $venta[$i]['Fecha_Venta'] = $data['Fecha_Venta'];
        $venta[$i]['Estado_venta'] = $data['Estado_venta'];
        $venta[$i]['Cliente'] = $data['Cliente'];
        $i++;
        }
    return $venta;
}

?>
