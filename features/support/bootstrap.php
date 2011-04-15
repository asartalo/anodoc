<?php
$src_path = realpath(__DIR__ . '/../..') . '/src/';
require_once $src_path . 'SplClassLoader.php';
$classLoader = new SplClassLoader('Anodoc', $src_path);
$classLoader->register();

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';
