<?php

require './../bootstrap.php';

$config = parse_ini_file(DIR_APP . '/config/main.ini', true);

$storage = new Refactoring\Classes\Storage($config['db']);

(new Refactoring\Classes\App($config, $storage))->run();
