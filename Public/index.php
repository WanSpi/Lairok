<?php

  $applicationFolder = 'Application';
  $bootstrapFolder   = 'Bootstrap';
  $coreFolder        = 'Core';

  $cacheFolder       = 'Cache';
  $configFolder      = 'Config';
  $librariesFolder   = 'Libraries';
  $controllersFolder = 'Controllers';
  $viewsFolder       = 'Views';
  $logsFolder        = 'Logs';

  define('VERSION', '1.1.0_b');

  define('SELFPATH', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);

  define('APPPATH',  SELFPATH . $applicationFolder . DIRECTORY_SEPARATOR);
  define('COREPATH', SELFPATH . $coreFolder        . DIRECTORY_SEPARATOR);

  define('CACHEPATH', APPPATH . $cacheFolder       . DIRECTORY_SEPARATOR);
  define('CONFPATH',  APPPATH . $configFolder      . DIRECTORY_SEPARATOR);
  define('LIBPATH',   APPPATH . $librariesFolder   . DIRECTORY_SEPARATOR);
  define('VIEWPATH',  APPPATH . $viewsFolder       . DIRECTORY_SEPARATOR);
  define('CONSPATH',  APPPATH . $controllersFolder . DIRECTORY_SEPARATOR);
  define('LOGSPATH',  APPPATH . $logsFolder        . DIRECTORY_SEPARATOR);

  require_once SELFPATH . $bootstrapFolder . DIRECTORY_SEPARATOR . 'Autoload.php';
  require_once SELFPATH . $bootstrapFolder . DIRECTORY_SEPARATOR . 'Setup.php';