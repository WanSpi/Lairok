<?php

  namespace Lairok\Singletons;

  use Lairok\Singleton;
  use Lairok\Singletons\Request\URI;
  use Lairok\Singletons\Request\Headers;

  class Request extends Singleton {
    public URI $URI;
    public Headers $Headers;

    protected function __construct() {
      $this->URI     = URI::GetInstance();
      $this->Headers = Headers::GetInstance();
    }

    /* Methods */

    public function GetMethod() {
      return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }
  }