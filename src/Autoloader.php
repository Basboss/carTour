<?php

namespace Game;

class Autoloader {
    public static function register()
    {
        spl_autoload_register(array('Game\Autoloader', 'load'));
    }

    public static function load($class)
    {
        $path = str_replace('\\', '/', $class);
        $path = str_replace('Game', 'src', $path);

        require_once $path . '.php';
    }
}