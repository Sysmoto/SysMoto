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
    require_once '../funciones/BackupMySQL.php';
  
    
    $backup = new BackupMySQL([
        'host'=> "localhost",
        'database'=> "sysmoto",
        'user'=> "root",
        'password'=> "",
    ]);
    //$backup->download();
    $backup->setFolder("./");
    //$backup->test();
    $backup->run();
  
    // Redireccionar a databases.php
    header("Location: databases.php");
    exit;
    ?>
</body>
</html>
