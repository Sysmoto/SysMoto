<?php

function listar_proveedores($filtro,$ConexionBD) {
    $SQL = "SELECT p.PROVE_ID, p.PROVE_NOMBRE, p.PROVE_INFO, p.DOM_ID, p.CONTACTO_ID,
        c.CONTACTO_TEL1, c.CONTACTO_TEL2, c.CONTACTO_EMAIL, c.CONTACTO_WEB,c.CONTACTO_INFO,
        d.DOM_CALLE, d.DOM_ALTURA, d.DOM_CP, ci.CIUDAD_NOMBRE, pr.PROVINCIA_NOMBRE 
        FROM proveedores p
        LEFT JOIN contacto c ON (c.CONTACTO_ID = p.CONTACTO_ID)
        LEFT JOIN domicilio d ON (p.DOM_ID = d.DOM_ID)
        LEFT JOIN ciudad ci ON ( ci.CIUDAD_ID = d.CIUDAD_ID)
        LEFT JOIN 	provincia pr ON (pr.PROVINCIA_ID = ci.PROVINCIA_ID) " . $filtro;
    $rs = mysqli_query($ConexionBD, $SQL);
       
    $i=0;
    while ($data = mysqli_fetch_array($rs)) {
        $proveedores[$i]['PROVE_ID']= $data['PROVE_ID'];
        $proveedores[$i]['PROVE_NOMBRE']= $data['PROVE_NOMBRE'];
        $proveedores[$i]['PROVE_INFO']= $data['PROVE_INFO'];
        $proveedores[$i]['CONTACTO_TEL1'] = $data['CONTACTO_TEL1'];
        $proveedores[$i]['CONTACTO_TEL2'] = $data['CONTACTO_TEL2'];
        $proveedores[$i]['CONTACTO_EMAIL'] = $data['CONTACTO_EMAIL'];
        $proveedores[$i]['CONTACTO_WEB'] = $data['CONTACTO_WEB'];
        $proveedores[$i]['CONTACTO_INFO'] = $data['CONTACTO_INFO'];
        $proveedores[$i]['DOM_CALLE'] = $data['DOM_CALLE'];
        $proveedores[$i]['DOM_ALTURA'] = $data['DOM_ALTURA'];
        $proveedores[$i]['DOM_CP'] = $data['DOM_CP'];
        $proveedores[$i]['CIUDAD_NOMBRE'] = $data['CIUDAD_NOMBRE'];
        $proveedores[$i]['PROVINCIA_NOMBRE'] = $data['PROVINCIA_NOMBRE'];
        $proveedores[$i]['DOM_ID'] = $data['DOM_ID'];
        $proveedores[$i]['CONTACTO_ID'] = $data['CONTACTO_ID'];
        $i++;
 }
 return $proveedores;
}

function listar_provincias($ConexionBD) {
    $SQL = "SELECT * FROM provincia ORDER BY 2;";
    
     $rs = mysqli_query($ConexionBD, $SQL);
    
    while ($data = mysqli_fetch_array($rs)) {
        $provincias[$data['PROVINCIA_ID']] = $data['PROVINCIA_NOMBRE'];    
        
    }
    return $provincias;
}

?>