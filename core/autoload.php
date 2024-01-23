<?php
// Registra una función de autocarga anónima
spl_autoload_register(function ($class_name) {
    // Define los directorios donde se buscarán las clases
    $directories = [
        __DIR__ . '/../app/controllers/',
        __DIR__ . '/../app/models/',
        __DIR__ . '/../core/'
    ];
    // Reemplaza los separadores de namespace con separadores de directorio
    $file_name = str_replace('\\', '/', $class_name) . '.php';
    // Busca el archivo de la clase en los directorios especificados
    foreach ($directories as $directory) {
        $file = $directory . $file_name;
        // Si el archivo existe, lo incluye y termina la función
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
    // Si no se encuentra el archivo, lanza una excepción
    throw new Exception("No se pudo cargar la clase: $class_name");
});

