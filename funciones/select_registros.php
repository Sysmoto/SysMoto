<?php
function Listar_Registros($Usuario_Nivel,$Usuario_Id, $MiConexion) {

    $Listado=array();
    switch ($Usuario_Nivel) {
	case 1:
		$filtro = ' ';
		break;
	case 2:
		$filtro = 'WHERE registros.id_usuario = '.$Usuario_Id;
		break;
    case 3:
		$filtro = 'WHERE registros.tipo = 2 ';
		break;
    case 4:
	    $filtro = 'WHERE registros.tipo in (1,3) ';
		break;

	default:
		# code...
		break;
}


    $SQL = 'SELECT registros.Id,registros.titulo, registros.descripcion, tipo_registros.Solicitud, 
            registros.fecha_carga, 
            DATE_FORMAT(registros.fecha_resolucion, "%d-%m-%Y") as fecha_resolucion,
            registros.tipo,
            CONCAT( usuarios.Nombre, " " , usuarios.Apellido) AS nomb_ape
            FROM `registros` 
            left join tipo_registros ON registros.tipo= tipo_registros.Id
            LEFT join usuarios ON registros.id_usuario=usuarios.Id
            '.$filtro;
    
     $rs = mysqli_query($MiConexion, $SQL);
        
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $Listado[$i]['Id'] = $data['Id'];
            $Listado[$i]['titulo'] = $data['titulo'];
            $Listado[$i]['descripcion'] = $data['descripcion'];
            $Listado[$i]['Tipo'] = $data['Solicitud'];
            $Listado[$i]['fecha_carga'] = $data['fecha_carga'];
            $Listado[$i]['fecha_resolucion'] = $data['fecha_resolucion'];
            $Listado[$i]['nomb_ape'] = $data['nomb_ape'];
            $Listado[$i]['tipo_num'] = $data['tipo'];
            $i++;
    }


    return $Listado;

}
?>