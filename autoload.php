<?php

spl_autoload_register('autoloader');
/**
 * @param string $class The fully-qualified class name.
 *
 * @return void
 */
function autoloader($class)
{
    $class_path = str_replace('\\', '/', $class);

    $file = __DIR__.'/src/'.$class_path.'.php';
    if (file_exists($file)) {
        require $file;
    }
}
