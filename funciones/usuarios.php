<?php

function Listar_usuarios($ConexionBD,$filtro) {
    $SQL = "SELECT u.Id,u.Nombre,u.Apellido,u.Usuario,u.email,u.IDROL,u.Foto,
    u.Activo,u.Sexo,r.Rol FROM usuarios u 
    LEFT JOIN roles r ON (r.Id = u.IDROL) " . $filtro . " order by 4;";
    $rs = mysqli_query($ConexionBD, $SQL);
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $Usuarios[$i]['Id'] = $data['Id'];
            $Usuarios[$i]['Nombre'] = $data['Nombre'];
            $Usuarios[$i]['Apellido'] = $data['Apellido'];
            $Usuarios[$i]['Usuario'] = $data['Usuario'];
            $Usuarios[$i]['Email'] = $data['email'];
            $Usuarios[$i]['Foto'] = $data['Foto'];
            $Usuarios[$i]['Activo'] = $data['Activo'];
            $Usuarios[$i]['Sexo'] = $data['Sexo'];
            $Usuarios[$i]['Rol'] = $data['Rol'];
            $i++;
    }
    return $Usuarios;
}


function Datos_usuario($id_usuario,$ConexionBD) {
    $SQL = "SELECT u.Id,u.Nombre,u.Apellido,u.Usuario,u.email,u.IdRol,u.Foto,
    u.Activo,u.Sexo,r.Rol, u.DOM_ID, u.CONTACTO_ID FROM usuarios u
    LEFT JOIN roles r ON (r.Id = u.IdRol) 
    WHERE u.Id = '$id_usuario';";
    $rs = mysqli_query($ConexionBD, $SQL);
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $Dato_Usuario['Id'] = $data['Id'];
            $Dato_Usuario['Nombre'] = $data['Nombre'];
            $Dato_Usuario['Apellido'] = $data['Apellido'];
            $Dato_Usuario['Usuario'] = $data['Usuario'];
            $Dato_Usuario['Email'] = $data['email'];
            $Dato_Usuario['Foto'] = $data['Foto'];
            $Dato_Usuario['Activado'] = $data['Activo'];
            $Dato_Usuario['Sexo'] = $data['Sexo'];
            $Dato_Usuario['Rol'] = $data['Rol'];
            $Dato_Usuario['Dom'] = $data['DOM_ID'];
            $Dato_Usuario['Cont'] = $data['CONTACTO_ID'];
            $i++;
    }
    return $Dato_Usuario;
}

function Listar_Roles($ConexionBD) {
    $SQL = "SELECT Id,Rol FROM roles ORDER BY 2;";
    $rs = mysqli_query($ConexionBD, $SQL);
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $roles[$i]['Id'] = $data['Id'];
            $roles[$i]['Rol'] = $data['Rol'];
            $i++;
    }
    return $roles;
}

function Listar_Roles_count($ConexionBD) {
    $SQL = "SELECT r.ID, r.rol, COUNT(*) AS total FROM roles r
    LEFT JOIN usuarios u ON r.ID = u.IDROL 
    GROUP BY r.ID 
    ORDER BY r.rol;";
    $rs = mysqli_query($ConexionBD, $SQL);
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $roles_c[$i]['Id'] = $data['ID'];
            $roles_c[$i]['Rol'] = $data['rol'];
            $roles_c[$i]['Total'] = $data['total'];
            $i++;
    }
    return $roles_c;
}



function Modificar_Usuario($datos_usuario,$ConexionBD) {
    $nombre=$datos_usuario["Nombre"];
    $apellido=$datos_usuario["Apellido"];
    $mail=$datos_usuario["Email"];
    $usuario=$datos_usuario["Usuario"];
    $sexo=$datos_usuario["Sexo"];
    $activo=$datos_usuario["Activo"];
    $id=$datos_usuario["id_user"];
    $rol=$datos_usuario["Rol"];
    $SQL="UPDATE usuarios SET Nombre='$nombre', Apellido='$apellido',Usuario='$usuario', email='$mail',
          IdRol=$rol, Activo=$activo, Sexo='$sexo' WHERE Id=$id;";

    if ($ConexionBD->query($SQL) === TRUE) {
        $resultado="Correctamente";
        } else {
            $resultado="Incorrectamente porque ".$ConexionBD->error;
        }
    return $resultado;
}


function Alta_Usuario($datos_usuario,$ConexionBD) {
    $nombre=$datos_usuario["Nombre"];
    $apellido=$datos_usuario["Apellido"];
    $mail=$datos_usuario["Email"];
    $usuario=$datos_usuario["Usuario"];
    $sexo=$datos_usuario["Sexo"];
    $activo=$datos_usuario["Activo"];
    $rol=$datos_usuario["Rol"];
    //$foto=$datos_usuario["Foto"];

    if(!empty($_FILES["Foto"]["name"])) { 
        $fileName = basename($_FILES["Foto"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
          $image = $_FILES['Foto']['tmp_name']; 
          $imgContent = addslashes(file_get_contents($image)); 
            }
        }
        else {
            $imgContent=NULL;
        }
    $clave=md5($datos_usuario["Clave"]);
     
    $SQL="INSERT INTO usuarios () VALUES 
    (NULL,NULL,NULL,$rol,'$nombre','$apellido','$usuario','$clave','$mail', '$imgContent',$activo, DATE(NOW()),'$sexo',NULL);";
   //echo $SQL;
   //  $resultado=$SQL;  
    if ($ConexionBD->query($SQL) === TRUE) {
       $resultado="Correctamente";
      } else {
          $resultado="Incorrectamente porque ".$ConexionBD->error;
       }
    //return $resultado;
}

function Borrar_Usuario($id_usuario,$ConexionBD) {
    
    $SQL="  DELETE FROM usuarios WHERE Id = $id_usuario ;";
     $resultado=$SQL;  
    if ($ConexionBD->query($SQL) === TRUE) {
        $resultado="Correctamente";
        } else {
           $resultado="Incorrectamente porque ".$ConexionBD->error;
        }
    return $resultado;
}

function ver_rol($id_rol,$ConexionBD) {
    
    $SQL="SELECT ROL FROM roles WHERE  Id = $id_rol ;";
    echo $SQL;
    $rs = mysqli_query($ConexionBD, $SQL);
    while($row = mysql_fetch_array($rs)){
        $rol=$row["ROL"];
    }
     return $rol;
}

function imagen_usuario($datos_usuario,$imagen,$ConexionBD) {
    $id=$datos_usuario["id_user"];
    $sql = "  UPDATE usuarios SET FOTO = '$imagen' WHERE Id=$id;";
    if($ConexionBD->query($sql) === TRUE) {
        $resultado="Imagen subida Correctamente";
        } else {
            $resultado="Incorrectamente porque ".$ConexionBD->error;
        }
    return $resultado;
}




function Dom_usuario($id_dom,$ConexionBD) {
    $SQL = "SELECT d.DOM_CALLE, d.DOM_ALTURA, d.DOM_CP, c.CIUDAD_NOMBRE, p.PROVINCIA_NOMBRE
    FROM domicilio d
    LEFT JOIN ciudad c ON (d.CIUDAD_ID = c.CIUDAD_ID)
    LEFT JOIn provincia p ON (c.PROVINCIA_ID = p.PROVINCIA_ID) 
    WHERE d.DOM_ID  = '$id_dom';";
    $rs = mysqli_query($ConexionBD, $SQL);
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $dom_usuario['Calle'] = $data['DOM_CALLE'];
            $dom_usuario['Altura'] = $data['DOM_ALTURA'];
            $dom_usuario['CP'] = $data['DOM_CP'];
            $dom_usuario['Ciudad'] = $data['CIUDAD_NOMBRE'];
            $dom_usuario['Provincia'] = $data['PROVINCIA_NOMBRE'];
          
            $i++;
    }
    return $dom_usuario;
}
?>