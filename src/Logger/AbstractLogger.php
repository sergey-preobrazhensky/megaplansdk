<?php

namespace SergeyPreobrazhensky\Megaplansdk\Logger;

abstract class AbstractLogger implements LoggerInterface
{
    const LEVEL_ERROR = 1;
    const LEVEL_INFO = 0;
    private int $level;

    /**
     * @param int $level
     */
    public function __construct(int $level)
    {
        $this->level = $level;
    }

    public function error($message, $context = null)
    {
        $this->log(self::LEVEL_ERROR, $message, $context);
    }

    public function info($message, $context = null)
    {
        $this->log(self::LEVEL_INFO, $message, $context);
    }

    protected function log($level, $message, $context)
    {
        if ($level >= $this->level) {
            $this->writeLog($message, $context);
        }
    }

    abstract protected function writeLog($message, $context);
}
