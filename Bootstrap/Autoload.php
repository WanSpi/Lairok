<?php

  $autoloadPrefixes = [
    'Lairok\\'                   => COREPATH,
    'Application\\Libraries\\'   => LIBPATH,
    'Application\\Controllers\\' => CONSPATH,
  ];

  spl_autoload_register(function($class) use($autoloadPrefixes){
    foreach ($autoloadPrefixes as $prefix => $baseDir) {
      $len = strlen($prefix);

      if (strncmp($prefix, $class, $len) !== 0) {
        continue;
      }

      $relativeClass = str_replace('\\', '/', substr($class, $len));
      $filePath = $baseDir . $relativeClass;

      if (file_exists($filePath . '.php')) {
        require_once $filePath . '.php';
      } else if (
        preg_match('/([^\/]+)$/', $relativeClass, $match) &&
        file_exists($filePath .= '/' . $match[1] . '.php')
      ) {
        require_once $filePath;
      }
    }
  });