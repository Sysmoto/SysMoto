<?php

function listar_proveedores($filtro,$ConexionBD) {
    $proveedores = array();
    $SQL = "SELECT p.PROVE_ID, p.PROVE_NOMBRE, p.PROVE_INFO, p.DOM_ID, p.CONTACTO_ID,
        c.CONTACTO_TEL1, c.CONTACTO_TEL2, c.CONTACTO_EMAIL, c.CONTACTO_WEB,c.CONTACTO_INFO,
        d.DOM_CALLE, d.DOM_ALTURA, d.DOM_CP, ci.CIUDAD_NOMBRE, pr.PROVINCIA_NOMBRE, cI.PROVINCIA_ID 
        FROM proveedores p
        LEFT JOIN contacto c ON (c.CONTACTO_ID = p.CONTACTO_ID)
        LEFT JOIN domicilio d ON (p.DOM_ID = d.DOM_ID)
        LEFT JOIN ciudad ci ON ( ci.CIUDAD_ID = d.CIUDAD_ID)
        LEFT JOIN 	provincia pr ON (pr.PROVINCIA_ID = ci.PROVINCIA_ID) " . $filtro;
    $rs = mysqli_query($ConexionBD, $SQL);
       
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
        $proveedores[$i]['PROVE_ID']= $data['PROVE_ID'];
        $proveedores[$i]['PROVE_NOMBRE']= $data['PROVE_NOMBRE'];
        $proveedores[$i]['PROVE_INFO']= $data['PROVE_INFO'];
        $proveedores[$i]['CONTACTO_TEL1'] = $data['CONTACTO_TEL1'];
        $proveedores[$i]['CONTACTO_TEL2'] = $data['CONTACTO_TEL2'];
        $proveedores[$i]['CONTACTO_EMAIL'] = $data['CONTACTO_EMAIL'];
        $proveedores[$i]['CONTACTO_WEB'] = $data['CONTACTO_WEB'];
        $proveedores[$i]['CONTACTO_INFO'] = $data['CONTACTO_INFO'];
        $proveedores[$i]['DOM_CALLE'] = $data['DOM_CALLE'];
        $proveedores[$i]['DOM_ALTURA'] = $data['DOM_ALTURA'];
        $proveedores[$i]['DOM_CP'] = $data['DOM_CP'];
        $proveedores[$i]['CIUDAD_NOMBRE'] = $data['CIUDAD_NOMBRE'];
        $proveedores[$i]['PROVINCIA_NOMBRE'] = $data['PROVINCIA_NOMBRE'];
        $proveedores[$i]['PROVINCIA_ID'] = $data['PROVINCIA_ID'];
        $proveedores[$i]['DOM_ID'] = $data['DOM_ID'];
        $proveedores[$i]['CONTACTO_ID'] = $data['CONTACTO_ID'];
        $i++;
 }
 return $proveedores;
}

function listar_provincias($ConexionBD) {
    $SQL = "SELECT * FROM provincia ORDER BY 2;";
    
     $rs = mysqli_query($ConexionBD, $SQL);
    
    while ($data = mysqli_fetch_array($rs)) {
        $provincias[$data['PROVINCIA_ID']] = $data['PROVINCIA_NOMBRE'];    
        
    }
    return $provincias;
}

function modificar_proveedor($datos,$ConexionBD) {
    //print_r($datos_clientes);
    $id_provee = $datos['id_provee'];
    $id_domicilio = $datos['id_domicilio'];
    $id_contacto = $datos['id_contacto'];
    $Nombre = $datos['Nombre'];
    $Info = $datos['Info'];
    $Tele1 = $datos['Tele1'];
    $Tele2 = $datos['Tele2'];
    $email = $datos['email'];
    $web = $datos['Web'];
    $Calle = $datos['Calle'];
    $Altura = $datos['Altura'];
    $CP = $datos['CP'];
    $Provincia = $datos['Provincia'];
    $Ciudad = $datos['Ciudad'];
   
    $sql1 = "UPDATE proveedores SET PROVE_NOMBRE = '$Nombre', PROVE_INFO = '$Info' 
            WHERE PROVE_ID = $id_provee";
    $sql2 = "UPDATE contacto SET CONTACTO_TEL1 = '$Tele1', CONTACTO_TEL2 = '$Tele2', CONTACTO_EMAIL = '$email', CONTACTO_WEB = '$web' 
            WHERE CONTACTO_ID = $id_contacto";
    $sql3 = "UPDATE domicilio SET DOM_CALLE = '$Calle', DOM_ALTURA = '$Altura', DOM_CP = '$CP', CIUDAD_ID= $Ciudad
             WHERE DOM_ID = $id_domicilio";
    print $sql3;
    if($ConexionBD->query($sql1) === TRUE) {
        $resultado1="Datos clientes ok";
        } else {
            $resultado1="Incorrectamente porque ".$ConexionBD->error;
        }
    if($ConexionBD->query($sql2) === TRUE) {
        $resultado2="Datos contacto ok";
        } else {
         $resultado2="Incorrectamente porque ".$ConexionBD->error;
         }
    if($ConexionBD->query($sql3) === TRUE) {
                $resultado3="Datos domicilio ok";
                } else {
                    $resultado3="Incorrectamente porque ".$ConexionBD->error;
                }
    return $resultado1 . " - " . $resultado2 . " - " . $resultado3;
}

function alta_proveedor($datos,$ConexionBD) {
    print_r($datos);
    $id_domicilio = $datos["ID_DIRECCION"];
    $id_contacto  = $datos["ID_CONTACTO"];
    $nombre       = $datos["Nombre"];
    
    $info         = $datos["Info"];
    
    $sql = "INSERT INTO proveedores () VALUEs
    (NULL,$id_domicilio,$id_contacto,'$nombre','$info');";
  //  echo $sql;
    if($ConexionBD->query($sql) === TRUE) {
        $resultado="Datos subidos correctamente";
        } 
        else {
         $resultado="Incorrectamente porque ".$ConexionBD->error;
        
    }
    return $resultado;
}

?>