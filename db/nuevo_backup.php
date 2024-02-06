<!DOCTYPE html>
<html>
<head>
    <title>Realizando Backup</title>
    <style>
        /* Estilos para centrar el contenido */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        /* Estilos para la imagen de carga */
        #loading-image {
            width: 100px; /* Ajusta el tamaño según lo necesites */
        }
    </style>
</head>

<body>
    <h1>Realizando Backup...</h1>
    <img id="loading-image" src="ruta_a_tu_imagen_de_carga.jpg" alt="Cargando...">
    <?php
    // Establecer conexión con la base de datos
    require_once '../funciones/conexion.php';
  
    $MiConexion=ConexionBD();    
    // Verificar la conexión
    if ($MiConexion->connect_error) {
        die("Error de conexión: " . $MiConexion->connect_error);
    }

    // Consulta para obtener todos los datos de todas las tablas
    $tables = array();
    $sql = "SHOW TABLES";
    $result = $MiConexion->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_row()) {
            $tables[] = $row[0];
        }
    }

    // Crear el archivo de volcado (dump)
    $dump = "-- Dump de la base de datos\n\n";

    foreach ($tables as $table) {
        $sql = "SELECT * FROM $table";
        $result = $MiConexion->query($sql);

        if ($result->num_rows > 0) {
            $dump .= "-- Datos de la tabla: $table\n";
            while ($row = $result->fetch_assoc()) {
                $dump .= "INSERT INTO $table (";
                $keys = array_keys($row);
                $dump .= implode(", ", $keys) . ") VALUES (";
                $values = array_map(function($value) use ($MiConexion) {
                    return "'" . $MiConexion->real_escape_string($value) . "'";
                }, array_values($row));
                $dump .= implode(", ", $values) . ");\n";
            }
            $dump .= "\n";
        }
    }

    // Nombre del archivo con la fecha de hoy
    $fecha_actual = date("Y-m-d");
    $file = "dump_$fecha_actual.sql";

    // Guardar el volcado en un archivo
    file_put_contents($file, $dump);

    // Cerrar la conexión
    $MiConexion->close();

    // Redireccionar a databases.php
    header("Location: databases.php");
    exit;
    ?>
</body>
</html>
