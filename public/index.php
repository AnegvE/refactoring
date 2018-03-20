<?php

/** @var Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__ . '/../vendor/autoload.php';

$config = parse_ini_file(__DIR__ . '/../config/main.ini', true);

(new Refactoring\Classes\App($config))->run();
