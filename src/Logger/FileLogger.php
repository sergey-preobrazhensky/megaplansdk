<?php

namespace SergeyPreobrazhensky\Megaplansdk\Logger;

class FileLogger extends AbstractLogger
{
    public function __construct(int $level, private string $filePath)
    {
        parent::__construct($level);
    }

    protected function writeLog($message, $context)
    {
        file_put_contents($this->filePath, "\n".date('Y-m-d H:i:s')."\n".$message."\n".print_r($context, 1)."\n", FILE_APPEND);
    }

    public static function infoLogger($filePath): FileLogger
    {
        return new FileLogger( AbstractLogger::LEVEL_INFO, $filePath);
    }
}
