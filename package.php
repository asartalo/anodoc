<?php

// To run:
// $ php package.php > package.xml

$sources = '';
$release = '';

$src_dir = __DIR__ . DIRECTORY_SEPARATOR . 'src';

$iterator = new DirectoryIterator($src_dir);
$source_files = array();

function recursivelyGetFiles($it, $cut = '') {
  global $source_files;
  $cutpart = strlen($cut);
  foreach ($it as $item) {

    if ($item->isDot() || $it->getPath() == $item->getPathName()) {
      continue;
    }
    if ($item->isFile()) {
      $key = ($cutpart > 0) ? substr($item->getPathName(), $cutpart) : $item->getPathName();
      $source_files[$key] = $item->getFileName();
    }
    if ($item->isDir()) {
      recursivelyGetFiles(new DirectoryIterator($item->getPathName()), $cut);
    }
  }
}

recursivelyGetFiles($iterator, __DIR__ . DIRECTORY_SEPARATOR);

foreach ($source_files as $path => $file) {
  $sources .= sprintf('<file role="php" baseinstalldir="/" name="%s" />' . "\n", $path);
}

foreach ($source_files as $path => $file) {
  $release .= sprintf('<install as="%s" baseinstalldir="/" name="%s" />' . "\n", substr($path, 4), $path);
}

$now = time();

$date = date('Y-m-d', $now);
$time = date('h:i:s');

include 'package.xml.tpl';
