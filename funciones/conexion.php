<?php

//aqui tengo parametros por defecto, cuando la llame con parentesis vacios, usarà estos:
function ConexionBD($Host = 'localhost:3306' ,  $User = 'root',  $Password = '', $BaseDeDatos='sysmoto' ) {
    
    //procedo al intento de conexion con esos parametros
    $linkConexion = mysqli_connect($Host, $User, $Password, $BaseDeDatos);
    if ($linkConexion!=false) 
        return $linkConexion;
    else 
        die ('No se pudo establecer la conexión.');

}
?>
