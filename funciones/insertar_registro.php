<?php 
function ins_reg($titulo, $descripcion,$tipo, $id_usuario,$MiConexion){

 
$fecha_actual = date("Y-m-d");



switch ($_POST['tipo']) {
    case 1:
        $fecha_estipulada = date("Y-m-d",strtotime($fecha_actual."+ 7 days"));
        break;
    case 2:
        $fecha_estipulada = date("Y-m-d",strtotime($fecha_actual."+ 1 days"));
        break;
    case 3:
       $fecha_estipulada = date("Y-m-d",strtotime($fecha_actual."+ 3 days"));
        break;
}
 


    $SQL_Insert="INSERT INTO registros (titulo, descripcion, tipo, id_usuario, fecha_carga, fecha_resolucion)
    VALUES ('".$titulo."' , '".$descripcion."' , '".$tipo."', '".$id_usuario."', '".$fecha_actual."', '".$fecha_estipulada."') ";


    if (!mysqli_query($MiConexion, $SQL_Insert)) {
        //si surge un error, finalizo la ejecucion del script con un mensaje
        die('<h4>Error al intentar insertar el registro.</h4>');
    }

    return true;
}
?>