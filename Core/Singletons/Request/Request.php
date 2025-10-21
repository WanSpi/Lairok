<?php

  namespace Lairok\Singletons;

  use Lairok\Singleton;
  use Lairok\Singletons\Request\URI;

  class Request extends Singleton {
    public URI $URI;

    protected function __construct() {
      $this->URI = URI::GetInstance();
    }
  }