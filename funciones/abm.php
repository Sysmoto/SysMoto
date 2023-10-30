<?php

function alta_direccion($datos,$ConexionBD) {
   
    $ciudad = $datos["Ciudad"];
    $altura = $datos["Altura"];
    $cp     = $datos["CP"];
    $calle  = $datos["Calle"];
    
    $sql = "INSERT INTO domicilio () VALUES (NULL,$ciudad,'$calle','$altura','$cp')";
    
    if($ConexionBD->query($sql) === TRUE) {
        $lastId = $ConexionBD->insert_id;
         }
    return $lastId;
}

function alta_contacto($datos,$ConexionBD) {
   
    
    $tele1          = $datos["Tele1"];
    $tele2          = $datos["Tele2"];
    $email          = $datos["email"];
    $web            = $datos["Web"];
    $info            = $datos["Info"];
    //$observacion    = $datos["observacione"];
    
    $sql = "INSERT INTO contacto () VALUES (NULL,'$tele1','$tele2','$email','$web','$info')";
    //echo $sql;
    if($ConexionBD->query($sql) === TRUE) {
        $lastId = $ConexionBD->insert_id;
         }
    return $lastId;
}


?>