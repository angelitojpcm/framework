<?php

class Logs
{
    public static function write($message)
    {
        $file = fopen(__DIR__ . '/../logs/app.log', 'a');
        fwrite($file, $message . PHP_EOL);
        fclose($file);
    }

    public static function read()
    {
        $file = fopen(__DIR__ . '/../logs/app.log', 'r');
        $logs = [];
        while (!feof($file)) {
            $logs[] = fgets($file);
        }
        fclose($file);
        return $logs;
    }
    


}
