<?php

session_start();
if (empty($_SESSION["Usuario"])) {

    header("Location: /sysmoto/logout.php");

    exit();
}

require_once 'conexion.php';

$MiConexion=ConexionBD();



?>

<html>
<head>

</head>

<body>

<?php

/* hacer:

- codigo agregar entrada en detalleVenta
- viene como dato, id, empleado etc

- se genera boton volver.

La otra pagina tiene que actualizar la lista

*/

$id=$_GET['id'];
$id_venta=$_GET['idactual'];
$codigo=$_GET['codigo'];
$desc=$_GET['desc'];
$precio=$_GET['precio'];

$idUltInsert="select max(venta_id) as venta_id from venta";
$resUltInsert = mysqli_query($MiConexion,$idUltInsert);


if(mysqli_num_rows($resUltInsert)>0){
  
    $row=mysqli_fetch_assoc($resUltInsert);
    $idactual=$row['venta_id'];
}

if($id_venta==$idactual){

    $sqlInsertDV="INSERT INTO `detalleventa` (`DETVENTA_ID`, `VENTA_ID`, `ID`, `ART_ID`, `DETVENTA_ITEM`, `DETVENTA_CANT`, `DETVENTA_PRECVTA`)
     VALUES (NULL, $id_venta, '7', $id, $codigo, '1', $precio)
    ";

    $resUltInsert = mysqli_query($MiConexion,$sqlInsertDV);

    echo '<div class="jumbotron">
    <h1 class="display-4">Articulo correctamente cargado.</h1>
    <hr class="my-4">
    <p class="lead">
      <a class="btn btn-primary btn-lg" href="../pedidos/presupuesto.php" role="button">Volver</a>
    </p>
  </div>
  </body>';



}else{

 echo 'Algo paso - '.$id_venta.'-'.$idactual.'-';   


}

?>


</html>