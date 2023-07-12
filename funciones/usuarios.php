<?php
function Listar_usuarios($ConexionBD) {
    $SQL = "SELECT u.Id,u.Nombre,u.Apellido,u.Usuario,u.email,u.IdRol,u.Foto,
    u.Activo,u.Sexo,r.Rol FROM usuarios u
    LEFT JOIN roles r ON (r.Id = u.IdRol) order by 4;";
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
    u.Activo,u.Sexo,r.Rol FROM usuarios u
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
    $clave=md5($datos_usuario["Clave"]);
    $SQL="INSERT INTO usuarios () VALUES 
    (NULL,NULL,$rol,NULL,$rol,'$nombre','$apellido','$usuario','$clave','$mail', '- ',$activo, DATE(NOW()),'$sexo',NULL);";
     $resultado=$SQL;  
    if ($ConexionBD->query($SQL) === TRUE) {
        $resultado="Correctamente";
        } else {
           $resultado="Incorrectamente porque ".$ConexionBD->error;
        }
    return $resultado;
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
?>