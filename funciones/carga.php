<?php
function Listar_tipo($MiConexion) {

    

    $SQL = "SELECT Id,Solicitud FROM tipo_registros ORDER BY Id;";
    
     $rs = mysqli_query($MiConexion, $SQL);
        
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
            $TipoSolicitud[$i]['Id'] = $data['Id'];
            $TipoSolicitud[$i]['Solicitud'] = $data['Solicitud'];
            $i++;
    }


    return $TipoSolicitud;

}
?>