<?php

  $applicationFolder = 'Application';
  $coreFolder        = 'Core';

  define('VERSION', '1.1.0_b');

  define('SELFPATH', pathinfo(__FILE__, PATHINFO_DIRNAME));

  define('APPPATH',  SELFPATH . DIRECTORY_SEPARATOR . $applicationFolder);
  define('COREPATH', SELFPATH . DIRECTORY_SEPARATOR . $coreFolder);
