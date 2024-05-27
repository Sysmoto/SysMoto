<?php
// Obtener el nombre del archivo a descargar de la URL
if (isset($_GET['archivo'])) {
    $nombreArchivo = $_GET['archivo'];

    // Ruta al archivo (ajusta según tu necesidad)
    $rutaArchivo =  $nombreArchivo;

    // Verificar si el archivo existe
    if (file_exists($rutaArchivo)) {
        // Configurar las cabeceras para la descarga del archivo
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($rutaArchivo) . '"');
        header('Content-Length: ' . filesize($rutaArchivo));

        // Leer y enviar el contenido del archivo
        readfile($rutaArchivo);
        exit;
    } else {
        // El archivo no existe
        echo "El archivo no se ha encontrado.";
    }
} else {
    // No se proporcionó el nombre del archivo
    echo "Nombre de archivo no especificado.";
}
?>
