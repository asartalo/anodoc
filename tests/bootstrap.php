<?php
$src_path = realpath(__DIR__ . '/..') . '/src/';
require_once $src_path . 'SplClassLoader.php';
$classLoader = new SplClassLoader('Anodoc', $src_path);
$classLoader->register();

