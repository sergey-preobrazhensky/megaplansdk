<?php

namespace logger;

interface LoggerInterface
{
    /**
     * @param string  $message
     * @param mixed $context
     *
     * @return void
     */
    public function error(string $message, $context = null);

    /**
     * @param string  $message
     * @param mixed $context
     *
     * @return void
     */
    public function info(string $message, $context = null);
}
