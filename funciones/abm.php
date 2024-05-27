 <?php

function alta_direccion($datos,$ConexionBD) {
   
    $ciudad = $datos["Ciudad"];
    $altura = $datos["Altura"];
    $cp     = $datos["CP"];
    $calle  = $datos["Calle"];
    
    $sql = "INSERT INTO domicilio () VALUES (NULL,$ciudad,'$calle','$altura','$cp')";
    $rs = $ConexionBD->query($sql);
    
    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");
    $archivo_log = "../log/sysmoto_$fecha_actual.log";
    if ($rs) {
        $lastId = $ConexionBD->insert_id;
        error_log("$hora_actual - Exito - $sql \n", 3, $archivo_log);
      } 
      else {
       $error_message = $ConexionBD->error;
       error_log("$hora_actual - Error -  $sql - $error_message \n", 3, $archivo_log);
      }

    
        
    return $lastId;
}

function alta_contacto($datos,$ConexionBD) {
   
    if(!isset($datos["Web"])) { $datos["Web"] = "";} 
    if(!isset($datos["Info"])) { $datos["Info"] = "";} 
    $tele1          = $datos["Tele1"];
    $tele2          = $datos["Tele2"];
    $email          = $datos["email"];
    $web            = $datos["Web"];
    $info            = $datos["Info"];
    //$observacion    = $datos["observacione"];
    
    $sql = "INSERT INTO contacto () VALUES (NULL,'$tele1','$tele2','$email','$web','$info')";
    $rs = $ConexionBD->query($sql);


    $fecha_actual = date("Y-m-d");
    $hora_actual = date("H:i:s");
    $archivo_log = "../log/sysmoto_$fecha_actual.log";
    if ($rs) {
        $lastId = $ConexionBD->insert_id;
        error_log("$hora_actual - Exito - $sql \n", 3, $archivo_log);
      } 
      else {
       $error_message = $ConexionBD->error;
       error_log("$hora_actual - Error -  $sql - $error_message \n", 3, $archivo_log);
      }

    
    return $lastId;
}


function listar_ciudades($id_prov,$ConexionBD) {
    
    
  $sql =  "SELECT CIUDAD_ID, CIUDAD_NOMBRE FROM ciudad WHERE PROVINCIA_ID = $id_prov ORDER BY CIUDAD_NOMBRE";
  $rs = $ConexionBD->query($sql);

  $fecha_actual = date("Y-m-d");
  $hora_actual = date("H:i:s");
  $archivo_log = "../log/sysmoto_$fecha_actual.log";

  if ($rs) {
      error_log("$hora_actual - Exito - $sql \n", 3, $archivo_log);
      while ($row = $rs->fetch_assoc()) {                
          
          $ciudades[$row['CIUDAD_ID']]  = $row['CIUDAD_NOMBRE'];
      }
      } 
  else {
      $error_message = $conexion->error;
      error_log("$hora_actual - Error -  $sql - $error_message \n", 3, $archivo_log);
}
$ciudades2 = print_r($ciudades, true);
error_log("$hora_actual - Exito - $ciudades2 \n", 3, $archivo_log);
  return $ciudades;
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