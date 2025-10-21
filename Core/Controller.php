<?php

  namespace Lairok;

  use Lairok\Singletons\Config;
  use Lairok\Singletons\Request;
  use Lairok\Singletons\Response;

  #[\AllowDynamicProperties]
  abstract class Controller {
    final public function __get(string $name) : mixed {
      switch ($name) {
        case 'Config':   return $this->Config   = Config::GetInstance();
        case 'Request':  return $this->Request  = Request::GetInstance();
        case 'Response': return $this->Response = Response::GetInstance();
      }
    }
  }