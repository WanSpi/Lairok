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

      $relativeClass = substr($class, $len);
      $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

      if (file_exists($file)) {
        require_once $file;
      }
    }
  });