<?php

namespace utils;

class Logger
{
    /**
     * this static method is use when a action is realised
     * @param mixed $value the message i want to save in the log
     */
    public static function logAction(mixed $value): void
    {
        try {
            $path = $_SERVER["DOCUMENT_ROOT"] . '/logs/' . date('d-m-Y') . '.log';
            $file = fopen($path, 'a');
            fwrite($file, $value . 'at ' . date('H/i/s/d/m/Y') . PHP_EOL);
            fclose($file);
        } catch (\Throwable $th) {
            Logger::logError('Fail to log action : ' . $value);
            throw $th;
        }
    }

    /**
     * this static method is use when one error is catch
     * @param mixed $value the message i want to save in the log
     */
    public static function logError(mixed $value): void
    {
        try {
            $path = $_SERVER["DOCUMENT_ROOT"] . '/logs/' . date('d-m-Y') . '.Error.log';

            $file = fopen($path, 'a');
            fwrite($file, $value . 'at ' . date('s/i/H/d/mY') . PHP_EOL);
            fclose($file);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}