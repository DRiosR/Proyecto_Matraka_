<?php

// Llamando al archivo de configuración
require_once dirname(__DIR__) . '/app/config/config.php';  // Asegúrate de que la ruta es correcta

// Llamando a los helpers
require_once dirname(__DIR__) . '/app/helpers/url_helper.php';  // Asegúrate de que la ruta es correcta

// Cargando automáticamente las clases de la carpeta `libs`
spl_autoload_register(function ($className) {
    // Definimos la ruta completa del archivo
    $file = dirname(__DIR__) . '/app/libs/' . $className . '.php';
    
    // Verificamos si el archivo existe antes de cargarlo
    if (file_exists($file)) {
        require_once $file;
    } else {
        // Manejo de errores si la clase no se encuentra
        die("No se pudo cargar la clase: $className en $file");
    }
});
