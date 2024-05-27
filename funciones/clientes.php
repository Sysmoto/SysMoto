<?php
function listar_clientes_largo($filtro,$ConexionBD) {
    $sql = "SELECT cl.CLIENTE_ID, cl.DOM_ID, cl.CONTACTO_ID, cl.CLIENTE_NOMBRE, cl.CLIENTE_APELLIDO, cl.CLIENTE_FECHAALTA, cl.CLIENTE_FECHABAJA, 
    co.CONTACTO_TEL1, co.CONTACTO_TEL2, co.CONTACTO_EMAIL, co.CONTACTO_EMAIL, co.CONTACTO_WEB, co.CONTACTO_INFO, 
    dom.DOM_CALLE, dom.DOM_ALTURA, dom.DOM_CP, ci.CIUDAD_NOMBRE, pr.PROVINCIA_NOMBRE
    FROM cliente cl
    LEFT JOIN contacto co ON cl.CONTACTO_ID = co.CONTACTO_ID
    LEFT JOIN domicilio dom ON cl.DOM_ID = dom.DOM_ID
    LEFT JOIN ciudad ci ON dom.CIUDAD_ID = ci.CIUDAD_ID
    LEFT JOIN provincia pr ON ci.PROVINCIA_ID = pr.PROVINCIA_ID $filtro ";
    
    

     $rs = mysqli_query($ConexionBD, $sql);
     
    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");
    $archivo_log = "../log/sysmoto_$fecha_actual.log";
    if ($rs) {
        error_log("$hora_actual - Exito - $sql \n", 3, $archivo_log);
      } 
      else {
       $error_message = $ConexionBD->error;
       error_log("$hora_actual - Error -  $sql - $error_message \n", 3, $archivo_log);
      }
     
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

function listar_clientes_corto($id_cliente,$ConexionBD) {
    $sql = "SELECT cl.CLIENTE_ID, cl.DOM_ID, cl.CONTACTO_ID, cl.CLIENTE_NOMBRE, cl.CLIENTE_APELLIDO, cl.CLIENTE_FECHAALTA, cl.CLIENTE_FECHABAJA, 
    co.CONTACTO_TEL1, co.CONTACTO_TEL2, co.CONTACTO_EMAIL, co.CONTACTO_EMAIL, co.CONTACTO_WEB, co.CONTACTO_INFO, 
    dom.DOM_CALLE, dom.DOM_ALTURA, dom.DOM_CP, ci.CIUDAD_NOMBRE, pr.PROVINCIA_NOMBRE, pr.PROVINCIA_ID ,ci.CIUDAD_ID
    FROM cliente cl
    LEFT JOIN contacto co ON cl.CONTACTO_ID = co.CONTACTO_ID
    LEFT JOIN domicilio dom ON cl.DOM_ID = dom.DOM_ID
    LEFT JOIN ciudad ci ON dom.CIUDAD_ID = ci.CIUDAD_ID
    LEFT JOIN provincia pr ON ci.PROVINCIA_ID = pr.PROVINCIA_ID 
    WHERE cl.CLIENTE_ID = $id_cliente";
    
    

     $rs = mysqli_query($ConexionBD, $sql);
     $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");
    $archivo_log = "../log/sysmoto_$fecha_actual.log";
    
    if ($rs) {
        error_log("$hora_actual - Exito - $sql \n", 3, $archivo_log);
      } 
      else {
       $error_message = $ConexionBD->error;
       error_log("$hora_actual - Error -  $sql - $error_message \n", 3, $archivo_log);
      }
        
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
        $cliente['CLIENTE_ID'] = $data['CLIENTE_ID'];
        $cliente['DOM_ID'] = $data['DOM_ID'];
        $cliente['CONTACTO_ID'] = $data['CONTACTO_ID'];
        $cliente['CLIENTE_NOMBRE'] = $data['CLIENTE_NOMBRE'];
        $cliente['CLIENTE_APELLIDO'] = $data['CLIENTE_APELLIDO'];
        $cliente['CLIENTE_FECHAALTA'] = $data['CLIENTE_FECHAALTA'];
        $cliente['CLIENTE_FECHABAJA'] = $data['CLIENTE_FECHABAJA'];
        $cliente['CONTACTO_TEL1'] = $data['CONTACTO_TEL1'];
        $cliente['CONTACTO_TEL2'] = $data['CONTACTO_TEL2'];
        $cliente['CONTACTO_EMAIL'] = $data['CONTACTO_EMAIL'];
        $cliente['CONTACTO_EMAIL'] = $data['CONTACTO_EMAIL'];
        $cliente['CONTACTO_WEB'] = $data['CONTACTO_WEB'];
        $cliente['CONTACTO_INFO'] = $data['CONTACTO_INFO'];
        $cliente['DOM_CALLE'] = $data['DOM_CALLE'];
        $cliente['DOM_ALTURA'] = $data['DOM_ALTURA'];
        $cliente['DOM_CP'] = $data['DOM_CP'];
        $cliente['CIUDAD_NOMBRE'] = $data['CIUDAD_NOMBRE'];
        $cliente['CIUDAD_ID'] = $data['CIUDAD_ID'];
        $cliente['PROVINCIA_NOMBRE'] = $data['PROVINCIA_NOMBRE'];
        $cliente['PROVINCIA_ID'] = $data['PROVINCIA_ID'];
            $i++;
    }
    return $cliente;
}






function alta_cliente($datos,$ConexionBD) {
    print_r($datos);
    $id_domicilio = $datos["ID_DIRECCION"];
    $id_contacto  = $datos["ID_CONTACTO"];
    $nombre       = $datos["Nombre"];
    $apellido     = $datos["Apellido"];
     
    $sql = "INSERT INTO cliente () VALUEs
    (NULL,$id_domicilio,$id_contacto,'$nombre','$apellido',NOW(),NULL);";
    $rs = mysqli_query($ConexionBD, $sql);
    
    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");
    $archivo_log = "../log/sysmoto_$fecha_actual.log";
    
    if($rs) {
        error_log("$hora_actual - Exito - $sql \n", 3, $archivo_log);
        $resultado="Datos subidos correctamente";
        } 
        else {
            $error_message = $ConexionBD->error;
            error_log("$hora_actual - Error -  $sql - $error_message \n", 3, $archivo_log);
            $resultado="Incorrectamente porque ".$ConexionBD->error;
        
    }
    return $resultado;
}

function modificar_cliente($datos,$ConexionBD) {
    //print_r($datos_clientes);
    $id_cliente = $datos['id_cliente'];
    $id_domicilio = $datos['id_domicilio'];
    $id_contacto = $datos['id_contacto'];
    $Nombre = $datos['Nombre'];
    $Apellido = $datos['Apellido'];
    $Tele1 = $datos['Tele1'];
    $Tele2 = $datos['Tele2'];
    $email = $datos['email'];
    $Calle = $datos['Calle'];
    $Altura = $datos['Altura'];
    $CP = $datos['CP'];
    $Provincia = $datos['Provincia'];
    $Ciudad = $datos['Ciudad'];
   
    $sql1 = "UPDATE cliente SET CLIENTE_NOMBRE = '$Nombre', CLIENTE_APELLIDO = '$Apellido' 
            WHERE CLIENTE_ID = $id_cliente";
    $sql2 = "UPDATE contacto SET CONTACTO_TEL1 = '$Tele1', CONTACTO_TEL2 = '$Tele2', CONTACTO_EMAIL = '$email' 
            WHERE CONTACTO_ID = $id_contacto";
    $sql3 = "UPDATE domicilio SET DOM_CALLE = '$Calle', DOM_ALTURA = '$Altura', DOM_CP = '$CP', CIUDAD_ID= $Ciudad
             WHERE DOM_ID = $id_domicilio";
    
    $rs1 = mysqli_query($ConexionBD, $sql1);
    $rs2 = mysqli_query($ConexionBD, $sql2);
    $rs3 = mysqli_query($ConexionBD, $sql3);
    
    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");
    $archivo_log = "../log/sysmoto_$fecha_actual.log";
    //print $sql;
    if($rs1) {
        $resultado1="Datos clientes ok";
        error_log("$hora_actual - Exito - $sql1 \n", 3, $archivo_log);
        } else {
            $error_message = $ConexionBD->error;
            error_log("$hora_actual - Error -  $sql1 - $error_message \n", 3, $archivo_log);
            $resultado1="Incorrectamente porque ".$ConexionBD->error;
        }
    if($rs2) {
        $resultado2="Datos contacto ok";
        error_log("$hora_actual - Exito - $sql2 \n", 3, $archivo_log);
        } else {
            $error_message = $ConexionBD->error;
            error_log("$hora_actual - Error -  $sql2 - $error_message \n", 3, $archivo_log);   
            $resultado2="Incorrectamente porque ".$ConexionBD->error;
         }
    if($rs3) {
        $resultado3="Datos domicilio ok";
        error_log("$hora_actual - Exito - $sql3 \n", 3, $archivo_log);
                } 
        else {
           $resultado3="Incorrectamente porque ".$ConexionBD->error;
           $error_message = $ConexionBD->error;
           error_log("$hora_actual - Error -  $sql - $error_message \n", 3, $archivo_log);
                }
    return $resultado1 . " - " . $resultado2 . " - " . $resultado3;
}

function listar_provincias($ConexionBD) {
    $sql = "SELECT * FROM provincia ORDER BY 2;";
    
     $rs = mysqli_query($ConexionBD, $sql);
     $fecha_actual = date("Y-m-d");
     $hora_actual = date("H:i:s");
     $archivo_log = "../log/sysmoto_$fecha_actual.log";
     
     if($rs) {
         error_log("$hora_actual - Exito - $sql \n", 3, $archivo_log);
         $resultado="Datos subidos correctamente";
         } 
         else {
             $error_message = $ConexionBD->error;
             error_log("$hora_actual - Error -  $sql - $error_message \n", 3, $archivo_log);
             $resultado="Incorrectamente porque ".$ConexionBD->error;  
         }

    while ($data = mysqli_fetch_array($rs)) {
        $provincias[$data['PROVINCIA_ID']] = $data['PROVINCIA_NOMBRE'];    
        
    }
    return $provincias;
}



?>