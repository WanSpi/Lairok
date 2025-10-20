<?php

  namespace Lairok;

  use Lairok\Controller;

  abstract class Singleton extends Controller {
    protected function __construct() {}
    private function __clone() {}

    protected static array $_instances = [];

    final public static function GetInstance() : static {
      $className = static::class;

      if (!array_key_exists($className, self::$_instances)) {
        self::$_instances[$className] = new static;
      }

      return self::$_instances[$className];
    }
  }