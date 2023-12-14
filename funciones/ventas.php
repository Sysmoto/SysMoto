<?php


function listar_impuestos($ConexionBD){
    $SQL="SELECT NOMBRE, PORCENTAJE from impuestos ORDER BY 1 asc";
    $rs = mysqli_query($ConexionBD, $SQL);
        
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
        $impuestos[$i]['NOMBRE'] = $data['NOMBRE'];
        $impuestos[$i]['PORCENTAJE'] = $data['PORCENTAJE'];
        $i++;
        }
     return $impuestos;  
    } 

    function listar_met_pago($ConexionBD){
        $SQL="SELECT ID_METODO,NOMBRE_METODO from metodopago ORDER BY 2 asc";
        $rs = mysqli_query($ConexionBD, $SQL);
            
        $i=0;
        while ($data = mysqli_fetch_array($rs)) {
            $metodo[$i]['ID_METODO'] = $data['ID_METODO'];
            $metodo[$i]['NOMBRE_METODO'] = $data['NOMBRE_METODO'];
            $i++;
            }
         return $metodo;  
        } 

function listar_est_venta($ConexionBD){
            $SQL="SELECT e.ESTADOVENTA_ID, e.ESTADOVENTA_NOMBRE from estadoventa e ORDER BY 2";
            $rs = mysqli_query($ConexionBD, $SQL);
                
            $i=0;
            while ($data = mysqli_fetch_array($rs)) {
                $estado[$i]['ESTADOVENTA_ID'] = $data['ESTADOVENTA_ID'];
                $estado[$i]['ESTADOVENTA_NOMBRE'] = $data['ESTADOVENTA_NOMBRE'];
                $i++;
                }
             return $estado;  
            } 
        function listar_articulo_js($ConexionBD) {
            $SQL = "SELECT articulo.ART_ID,articulo.ART_INFOADICIONAL, stock.CANT_STOCK,          
            articulo.ART_PRECIOCOMPRA
            FROM articulo
            LEFT JOIN stock on stock.ART_ID = articulo.ART_ID
            ORDER BY 1;";
            
            $rs = mysqli_query($ConexionBD, $SQL);
                
            $i=0;
            
            if ($rs->num_rows > 0) {
                $articulos = array();
                // Obtener los datos y agregarlos al array
                while ($row = $rs->fetch_assoc()) {
                  $articulos[] = $row;
                }
            }
            return $articulos;
        }
        function alta_presupuesto($datos,$ConexionBD,$vendedor) {
            $id_cliente =   $datos['id_cliente'];
            $margen     =   $datos['margen_gan'];
            $impuesto   =   $datos['impuesto'];
            $metodo     =   $datos['metodo'];
            $descuento  =   $datos['descuento'];

            $id_impuesto = intval($ConexionBD->query("SELECT ID_IMP FROM impuestos WHERE PORCENTAJE = '" . $impuesto . "'")->fetch_assoc()["ID_IMP"]);
            
            //echo $id_impuesto;
            $SQL="INSERT INTO presupuesto () 
            VALUES (NULL,$id_cliente,5,CURDATE(),NULL,NULL,$margen,$id_impuesto,$descuento,$metodo,$vendedor)";
            //echo $SQL;
            if($ConexionBD->query($SQL) === TRUE) {
                $nuevoId = $ConexionBD->insert_id;
                } else {
                echo "Error al insertar el registro: " . $ConexionBD->error;
            }
            return $nuevoId;

        }

        function alta_presupuesto_detalle($datos,$id_venta,$ConexionBD) {
            $contar_item=count($datos);
            echo $id_venta;
            for ($i = 1; $i <= $contar_item; $i++) {
                $articulo = $datos[$i]['articulo'];
                $cantidad = $datos[$i]['cantidad'];
                $precioUnitario = $datos[$i]['precio_unit'];
                
                $precioVenta = $datos[$i]['precio_venta'];
                $total = $datos[$i]['total'];
                $SQL= "INSERT INTO detallepresupuesto () 
                VALUES (NULL,$id_venta,$articulo,$cantidad,$precioUnitario,$precioVenta)";
                if($ConexionBD->query($SQL) === TRUE) {
                    $nuevoId = $ConexionBD->insert_id;
                    } 
                    else {
                    echo "Error al insertar el registro: " . $ConexionBD->error;
                    }
            }
            return " ok";
        }
        function listar_ventas($ConexionBD){
            $SQL="SELECT p.VENTA_ID,p.CLIENTE_ID, p.VENTA_FECHAVENTA,p.VENTA_MARGEN,p.VENTA_DESCUENTO, m.NOMBRE_METODO,
            i.NOMBRE, c.CLIENTE_NOMBRE, c.CLIENTE_APELLIDO, u.USUARIO, e.ESTADOVENTA_NOMBRE FROM presupuesto p
            LEFT JOIN metodopago m ON p.VENTA_METODO = m.ID_METODO
            LEFT JOIN impuestos i ON i.ID_IMP = p.VENTA_IMPUESTO
            LEFT JOIN cliente c ON c.CLIENTE_ID = p.CLIENTE_ID
            LEFT JOIN usuarios u ON u.ID = p.VENTA_VENDEDOR
            LEFT JOIN estadoventa e ON e.ESTADOVENTA_ID = p.ESTADOVENTA_ID
            WHERE p.ESTADOVENTA_ID <> 5
            ORDER BY p.VENTA_ID DESC";
            $rs = mysqli_query($ConexionBD, $SQL);
            $i=0;
            while ($data = mysqli_fetch_array($rs)) {
                $presupuestos[$i]['VENTA_ID'] = $data['VENTA_ID'];
                $presupuestos[$i]['CLIENTE_ID'] = $data['CLIENTE_ID'];
                $presupuestos[$i]['VENTA_FECHAVENTA'] = $data['VENTA_FECHAVENTA'];
                $presupuestos[$i]['VENTA_MARGEN'] = $data['VENTA_MARGEN'];
                $presupuestos[$i]['VENTA_DESCUENTO'] = $data['VENTA_DESCUENTO'];
                $presupuestos[$i]['IMPUESTO'] = $data['NOMBRE'];
                $presupuestos[$i]['VENDEDOR'] = $data['USUARIO'];
                
                $presupuestos[$i]['ESTADOVENTA_NOMBRE'] = $data['ESTADOVENTA_NOMBRE'];
                $presupuestos[$i]['CLIENTE'] = $data['CLIENTE_NOMBRE'] . " " . $data['CLIENTE_APELLIDO'] ;
                $i++;
                    }
            return $presupuestos;
       
            } 


        function listar_presupuestos($ConexionBD){
            $SQL="SELECT p.VENTA_ID,p.CLIENTE_ID, p.VENTA_FECHAVENTA,p.VENTA_MARGEN,p.VENTA_DESCUENTO, m.NOMBRE_METODO,
            i.NOMBRE, c.CLIENTE_NOMBRE, c.CLIENTE_APELLIDO, u.USUARIO, e.ESTADOVENTA_NOMBRE FROM presupuesto p
            LEFT JOIN metodopago m ON p.VENTA_METODO = m.ID_METODO
            LEFT JOIN impuestos i ON i.ID_IMP = p.VENTA_IMPUESTO
            LEFT JOIN cliente c ON c.CLIENTE_ID = p.CLIENTE_ID
            LEFT JOIN usuarios u ON u.ID = p.VENTA_VENDEDOR
            LEFT JOIN estadoventa e ON e.ESTADOVENTA_ID = p.ESTADOVENTA_ID
            ORDER BY p.VENTA_ID DESC";
            $rs = mysqli_query($ConexionBD, $SQL);
            $i=0;
            while ($data = mysqli_fetch_array($rs)) {
                $presupuestos[$i]['VENTA_ID'] = $data['VENTA_ID'];
                $presupuestos[$i]['CLIENTE_ID'] = $data['CLIENTE_ID'];
                $presupuestos[$i]['VENTA_FECHAVENTA'] = $data['VENTA_FECHAVENTA'];
                $presupuestos[$i]['VENTA_MARGEN'] = $data['VENTA_MARGEN'];
                $presupuestos[$i]['VENTA_DESCUENTO'] = $data['VENTA_DESCUENTO'];
                $presupuestos[$i]['IMPUESTO'] = $data['NOMBRE'];
                $presupuestos[$i]['VENDEDOR'] = $data['USUARIO'];
                
                $presupuestos[$i]['ESTADOVENTA_NOMBRE'] = $data['ESTADOVENTA_NOMBRE'];
                $presupuestos[$i]['CLIENTE'] = $data['CLIENTE_NOMBRE'] . " " . $data['CLIENTE_APELLIDO'] ;
                $i++;
                    }
            return $presupuestos;
       
            } 

function listar_presupuesto($id_venta,$ConexionBD){            
    $SQL="SELECT p.VENTA_ID,p.CLIENTE_ID, p.VENTA_FECHAVENTA,p.VENTA_MARGEN,p.VENTA_DESCUENTO, 
    m.NOMBRE_METODO,m.ID_METODO, i.NOMBRE, c.CLIENTE_NOMBRE, c.CLIENTE_APELLIDO, u.USUARIO, 
    e.ESTADOVENTA_NOMBRE, DATEDIFF(CURDATE(), p.VENTA_FECHAVENTA) AS VIGENCIA ,e.ESTADOVENTA_ID
    FROM presupuesto p
        LEFT JOIN metodopago m ON p.VENTA_METODO = m.ID_METODO
    LEFT JOIN impuestos i ON i.ID_IMP = p.VENTA_IMPUESTO
    LEFT JOIN cliente c ON c.CLIENTE_ID = p.CLIENTE_ID
    LEFT JOIN usuarios u ON u.ID = p.VENTA_VENDEDOR
    LEFT JOIN estadoventa e ON e.ESTADOVENTA_ID = p.ESTADOVENTA_ID
    WHERE p.VENTA_ID = $id_venta";
    $rs = mysqli_query($ConexionBD, $SQL);
    
    while ($data = mysqli_fetch_array($rs)) {
        $presupuesto['VENTA_ID'] = $data['VENTA_ID'];
        $presupuesto['CLIENTE_ID'] = $data['CLIENTE_ID'];
        $presupuesto['VENTA_FECHAVENTA'] = $data['VENTA_FECHAVENTA'];
        $presupuesto['VENTA_MARGEN'] = $data['VENTA_MARGEN'];
        $presupuesto['VENTA_DESCUENTO'] = $data['VENTA_DESCUENTO'];
        $presupuesto['IMPUESTO'] = $data['NOMBRE'];
        $presupuesto['VENDEDOR'] = $data['USUARIO'];
        $presupuesto['ID_METODO'] = $data['ID_METODO'];        
        $presupuesto['ESTADOVENTA_NOMBRE'] = $data['ESTADOVENTA_NOMBRE'];
        $presupuesto['CLIENTE'] = $data['CLIENTE_NOMBRE'] . " " . $data['CLIENTE_APELLIDO'] ;
        $presupuesto['ESTADOVENTA_NOMBRE'] = $data['ESTADOVENTA_NOMBRE'];
        $presupuesto['VIGENCIA'] = $data['VIGENCIA'];
        $presupuesto['ESTADOVENTA_ID'] = $data['ESTADOVENTA_ID'];
        
            }
    
    return $presupuesto;
    }

    function listar_venta($id_venta,$ConexionBD){            
        $SQL="SELECT p.VENTA_ID,p.CLIENTE_ID, p.VENTA_FECHAVENTA,p.VENTA_MARGEN,p.VENTA_DESCUENTO, 
        m.NOMBRE_METODO,m.ID_METODO, i.NOMBRE, c.CLIENTE_NOMBRE, c.CLIENTE_APELLIDO, u.USUARIO, 
        e.ESTADOVENTA_NOMBRE, DATEDIFF(CURDATE(), p.VENTA_FECHAVENTA) AS VIGENCIA ,e.ESTADOVENTA_ID,
        f.FACTURA_ID

        FROM presupuesto p
            LEFT JOIN metodopago m ON p.VENTA_METODO = m.ID_METODO
        LEFT JOIN impuestos i ON i.ID_IMP = p.VENTA_IMPUESTO
        LEFT JOIN cliente c ON c.CLIENTE_ID = p.CLIENTE_ID
        LEFT JOIN usuarios u ON u.ID = p.VENTA_VENDEDOR
        LEFT JOIN estadoventa e ON e.ESTADOVENTA_ID = p.ESTADOVENTA_ID
        LEFT JOIN factura f ON f.VENTA_ID = p.VENTA_ID
        WHERE p.VENTA_ID = $id_venta";
        $rs = mysqli_query($ConexionBD, $SQL);
        
        while ($data = mysqli_fetch_array($rs)) {
            $presupuesto['VENTA_ID'] = $data['VENTA_ID'];
            $presupuesto['CLIENTE_ID'] = $data['CLIENTE_ID'];
            $presupuesto['VENTA_FECHAVENTA'] = $data['VENTA_FECHAVENTA'];
            $presupuesto['VENTA_MARGEN'] = $data['VENTA_MARGEN'];
            $presupuesto['VENTA_DESCUENTO'] = $data['VENTA_DESCUENTO'];
            $presupuesto['IMPUESTO'] = $data['NOMBRE'];
            $presupuesto['VENDEDOR'] = $data['USUARIO'];
            $presupuesto['ID_METODO'] = $data['ID_METODO'];        
            $presupuesto['ESTADOVENTA_NOMBRE'] = $data['ESTADOVENTA_NOMBRE'];
            $presupuesto['CLIENTE'] = $data['CLIENTE_NOMBRE'] . " " . $data['CLIENTE_APELLIDO'] ;
            $presupuesto['ESTADOVENTA_NOMBRE'] = $data['ESTADOVENTA_NOMBRE'];
            $presupuesto['VIGENCIA'] = $data['VIGENCIA'];
            
            $presupuesto['FACTURA_ID'] = $data['FACTURA_ID'];
            $presupuesto['ESTADOVENTA_ID'] = $data['ESTADOVENTA_ID'];
            
                }
        
        return $presupuesto;
        }
       
    
function listar_item_presupuesto($id_venta,$ConexionBD){ 
    $SQL="SELECT d.DETVENTA_ID,d.ART_ID,d.DETVENTA_CANT,d.DETVENTA_PRECUNIT,a.ART_INFOADICIONAL,
    a.ART_PRECIOCOMPRA, s.CANT_STOCK, d.DETVENTA_CANT * d.DETVENTA_PRECUNIT AS TOTAL
          FROM detallepresupuesto d
        LEFT JOIN articulo a ON d.ART_ID = a.ART_ID
        LEFT JOIN stock s ON a.ART_ID = s.ART_ID
        WHERE d.VENTA_ID = $id_venta;";
    $rs = mysqli_query($ConexionBD, $SQL);
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
        $item[$i]['DETVENTA_ID']        = $data['DETVENTA_ID'];
        $item[$i]['ART_ID']             = $data['ART_ID'];
        $item[$i]['ART_ID']             = $data['ART_ID'];
        $item[$i]['DETVENTA_CANT']      = $data['DETVENTA_CANT'];
        $item[$i]['DETVENTA_PRECUNIT']  = $data['DETVENTA_PRECUNIT'];
        $item[$i]['ART_INFOADICIONAL']  = $data['ART_INFOADICIONAL'];
        $item[$i]['ART_PRECIOCOMPRA']   = $data['ART_PRECIOCOMPRA'];
        $item[$i]['CANT_STOCK']         = $data['CANT_STOCK'];
        $item[$i]['TOTAL']         = $data['TOTAL'];
        $i++;
    }
    return $item;
}

function listar_totales_presupuesto($id_venta,$ConexionBD){ 
    $SQL="SELECT  SUM(d.DETVENTA_CANT * d.DETVENTA_PRECUNIT) AS TOTAL , 
        ROUND(SUM(d.DETVENTA_CANT * d.DETVENTA_PRECUNIT) * ( 1 + p.VENTA_MARGEN/100 + i.PORCENTAJE/100 - p.VENTA_DESCUENTO/100),2) AS FINAL
        From detallepresupuesto d
        CROSS JOIN presupuesto p ON d.VENTA_ID = p.VENTA_ID
        CROSS JOIN impuestos i ON i.ID_IMP = p.VENTA_IMPUESTO
        WHERE d.VENTA_ID= $id_venta;";
        $rs = mysqli_query($ConexionBD, $SQL);
        while ($data = mysqli_fetch_array($rs)) {
            $total['TOTAL']=$data['TOTAL'];
            $total['FINAL']=$data['FINAL'];
            }
        return $total;
}
function terminar_venta($id_venta,$ConexionBD){ 
    $SQL="UPDATE presupuesto SET ESTADOVENTA_ID = 4,  VENTA_FECHAENTREGA = CURDATE() WHERE 
    VENTA_ID = $id_venta";
    
    if ($ConexionBD->query($SQL) === TRUE) {
        $resultado="Correctamente";
        } else {
            $resultado="Incorrectamente porque ".$ConexionBD->error;
        }
    $SQL2= "UPDATE stock s
    JOIN(
    SELECT d.ART_ID, d.DETVENTA_CANT FROM detallepresupuesto d WHERE VENTA_ID = $id_venta)
    AS subquery ON s.ART_ID = d.ART_ID
    SET s.CANT_STOCK = s.CANT_STOCK - subquery.DETVENTA_CANT";

    if ($ConexionBD->query($SQL2) === TRUE) {
    $resultado="Correctamente";
    } else {
        $resultado="Incorrectamente porque ".$ConexionBD->error;
    }
    $SQL3="INSERT INTO factura VALUES (NULL,$id_venta,1)";
    
    if ($ConexionBD->query($SQL3) === TRUE) {
        $resultado="Correctamente";
        } else {
            $resultado="Incorrectamente porque ".$ConexionBD->error;
        }

}
?>
