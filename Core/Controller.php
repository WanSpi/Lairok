<?php

  namespace Lairok;

  use Lairok\Singletons\Config;

  #[\AllowDynamicProperties]
  abstract class Controller {
    final public function __get(string $name) : mixed {
      if ($name === 'Config') {
        return $this->Config = Config::GetInstance();
      }
    }
  }