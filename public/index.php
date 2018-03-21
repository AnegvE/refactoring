<?php

define('DIR_WEB', __DIR__);
define('DIR_APP', dirname(__DIR__));

require DIR_APP . '/vendor/autoload.php';

$config = parse_ini_file(DIR_APP . '/config/main.ini', true);

$storage = new Refactoring\Classes\Storage($config['db']);

(new Refactoring\Classes\App($config, $storage))->run();
