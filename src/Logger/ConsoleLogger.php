<?php

namespace SergeyPreobrazhensky\Megaplansdk\Logger;

class ConsoleLogger extends AbstractLogger
{
    protected function writeLog($message, $context)
    {
        echo "\n".$message;
        if ($context) {
            echo "\t";
            print_r($context);
        }
    }

    public static function infoLogger(): ConsoleLogger
    {
        return new ConsoleLogger(AbstractLogger::LEVEL_INFO);
    }
}
