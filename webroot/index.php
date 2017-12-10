<?php
use Library\App;
use Library\Config;

include 'local.php';
require 'functions.php';
//Need composer.phar install before include vendor folder
require VENDOR_PATH . 'autoload.php';

//Autoload
spl_autoload_register(function($classname){
    $path = SRC_PATH . str_replace('\\', DS, $classname). '.php';
    if (!file_exists(SRC_PATH . str_replace('\\', DS, $classname). '.php')) {
        throw new \Exception("Class $classname doesn't exist- {$path}");
    }

    require(SRC_PATH . str_replace('\\', DS, $classname . '.php'));
});

//Load ALL Configuratio
$config = new Config();

if ($config->get('developer_mode')) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

//Start Application
App::run($config);