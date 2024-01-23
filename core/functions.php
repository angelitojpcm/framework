<?php

class Functions
{
    // Constructor
    public function __construct($zone, $envPath = __DIR__ .'/.env')
    {
        set_error_handler([$this, 'handleError']);
        $env = $this->env($envPath);
        $this->setTimeZone($zone); 
    }

    // Manejador de errores personalizado
    public function handleError($errno, $errstr, $errfile, $errline)
    {
        Logs::write("Error: [$errno] $errstr - $errfile:$errline");
    }

    //Leer variables de entorno sin composer
    public static function env($filePath = __DIR__ . '/.env')
    {
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $env = [];
        foreach ($lines as $line) {
            // Ignora los comentarios
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            list($key, $value) = explode('=', $line, 2);
            $env[$key] = $value;
            $_ENV[$key] = $value; // Guarda la variable de entorno
        }
        return $env;
    }

    public static function setTimeZone($zone = 'America/Lima')
    {
        if (in_array($zone, timezone_identifiers_list())) {
            date_default_timezone_set($zone);
        } else {
            throw new Exception("La zona horaria proporcionada '{$zone}' no es válida.");
        }
    }
}
