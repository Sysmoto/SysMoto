<?php
$html = '';


$conexion = new mysqli('localhost:33306', 'root','','sysmoto');
$id_prov = $_POST['id_prov'];
 
$result = $conexion->query("SELECT CIUDAD_ID, CIUDAD_NOMBRE FROM ciudad WHERE PROVINCIA_ID = $id_prov ORDER BY CIUDAD_NOMBRE");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<option value="'.$row['CIUDAD_ID'].'">'.$row['CIUDAD_NOMBRE'].'</option>';
    }
}
echo $html;

?>
