<?php
$html = '';


$conexion = new mysqli('localhost:33306', 'root','','sysmoto');
$id_marca = $_POST['id_marca'];
 
$result = $conexion->query("SELECT MODELO_ID, MODELO_NOMBRE FROM modelo WHERE MARCA_ID = $id_marca ORDER BY MODELO_NOMBRE");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<option value="'.$row['MODELO_ID'].'">'.$row['MODELO_NOMBRE'].'</option>';
    }
}
echo $html;

?>
