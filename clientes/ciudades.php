<?php
$html = '';


$conexion = new mysqli('localhost:3306', 'root','','sysmoto');
$id_prov = $_POST['id_prov'];
$sql =  "SELECT CIUDAD_ID, CIUDAD_NOMBRE FROM ciudad WHERE PROVINCIA_ID = $id_prov ORDER BY CIUDAD_NOMBRE";
$rs = $conexion->query($sql);

$fecha_actual = date("Y-m-d");
$hora_actual = date("H:i:s");
$archivo_log = "../log/sysmoto_$fecha_actual.log";

if ($rs) {
    error_log("$hora_actual - Exito - $sql \n", 3, $archivo_log);
  } 
  else {
   $error_message = $conexion->error;
   error_log("$hora_actual - Error -  $sql - $error_message \n", 3, $archivo_log);
  }
    

if ($rs->num_rows > 0) {
    while ($row = $rs->fetch_assoc()) {                
        $html .= '<option value="'.$row['CIUDAD_ID'].'">'.$row['CIUDAD_NOMBRE'].'</option>';
    }
}
//error_log("$hora_actual - Exito - $html \n", 3, $archivo_log);

echo $html;

?>
