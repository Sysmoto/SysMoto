<?php 
function DatosLogin($vUsuario, $vClave, $MiConexion){
    $Usuario=array();
    
    $SQL="SELECT usuarios.Id, usuarios.Nombre, usuarios.Apellido, usuarios.IdRol, 
     usuarios.Foto, usuarios.Sexo, usuarios.Activo, roles.Rol, usuarios.email
     FROM usuarios
     LEFT JOIN roles  on Usuarios.IdRol = roles.Id
     WHERE Usuario='$vUsuario' AND Clave= MD5('$vClave')  ";
     //echo $SQL;
     
    $rs = mysqli_query($MiConexion, $SQL);
        
    $data = mysqli_fetch_array($rs) ;
    if (!empty($data)) {
        
        $Usuario['IdUsuario'] = $data['Id'];
        $idUsuario = $data['Id'];
        $Usuario['NOMBRE'] = $data['Nombre'];
        $Usuario['APELLIDO'] = $data['Apellido'];
        $Usuario['NIVEL'] = $data['Rol'];
        $Usuario['IDNIVEL'] = $data['IdRol'];
        $Usuario['FOTO'] = $data['Foto'];
        $Usuario['USUARIO'] = $vUsuario;
        switch ($data['Sexo']) {
            case 'F':
                $Usuario['SALUDO'] = 'Bienvenida';
                break;
            case 'M':
                $Usuario['SALUDO'] = 'Bienvenido';
                break;
            case 'O':
                $Usuario['SALUDO'] = 'Hola ';
                break;
        }
        

        if (empty( $data['Foto'])) {
            $data['Foto'] = 'user.png'; 
        }
        $Usuario['Foto'] = $data['Foto'];
        $Usuario['ACTIVO'] = $data['Activo'];
        $Usuario['EMAIL'] = $data['email'];
        $SQL2="UPDATE Usuarios SET Ult_Login = NOW() WHERE Id = '".$data['Id']."'";
        if (mysqli_query($MiConexion, $SQL2)) 
       {
            //echo "Record updated successfully";
        } else {
      //echo "Error updating record: " . mysqli_error($conn);
    }
    }
   

    return $Usuario;
}

?>