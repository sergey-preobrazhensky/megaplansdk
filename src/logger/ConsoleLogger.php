<?php

namespace logger;

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

    public static function infoLogger()
    {
        return new ConsoleLogger(AbstractLogger::LEVEL_INFO);
    }
}
