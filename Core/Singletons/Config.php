<?php

  namespace Lairok\Singletons;

  use Lairok\Singleton;

  class Config extends Singleton {
    private $configs = [];

    private function getPath($name) {
      return CONFPATH . DIRECTORY_SEPARATOR . $name . '.php';
    }

    public function Get(string $name, string $key = null) {
      if (!isset($this->configs[$name])) {
        if (is_file($this->getPath($name))) {
          $this->configs[$name] = require $this->getPath($name);
        } else {
          $this->configs[$name] = [];
        }
      }

      if (!is_null($key)) {
        return $this->configs[$name][$key] ?? null;
      } else {
        return $this->configs[$name];
      }
    }

    private function writeLevel($handle, $indent, $configs) {
      $arrKey = 0;
      $isFirst = true;

      foreach ($configs as $key => $c) {
        if ($isFirst) {
          $isFirst = false;
        } else {
          fwrite($handle, ",\n");
        }

        if ($key === $arrKey++) {
          fwrite($handle, $indent);
        } else {
          fwrite($handle, $indent . '\'' . $key . '\' => ');
        }

        if (is_array($c)) {
          fwrite($handle, '[' . "\n");

          $this->writeLevel($handle, '  ' . $indent, $c);

          fwrite($handle, $indent . ']');
        } else if (is_string($c)) {
          fwrite($handle, '\'' . $c . '\'');
        } else if (is_numeric($c)) {
          fwrite($handle, $c);
        } else if (is_bool($c)) {
          fwrite($handle, $c ? 'true' : 'false');
        } else if (is_null($c)) {
          fwrite($handle, 'null');
        }
      }

      fwrite($handle, "\n");
    }

    public function Change(string $name, $configs) {
      $this->configs[$name] = $configs;

      $handle = fopen($this->getPath($name), 'w');

      fwrite($handle, '<?php' . "\n\n");

      if (is_array($configs)) {
        fwrite($handle, '  return [' . "\n");

        $this->writeLevel($handle, '    ', $configs);

        fwrite($handle, '  ];');
      } else if (is_string($configs)) {
        fwrite($handle, '  return \'' . $configs . '\';');
      } else if (is_numeric($configs)) {
        fwrite($handle, '  return ' . $configs . ';');
      } else if (is_bool($configs)) {
        fwrite($handle, '  return ' . ($configs ? 'true' : 'false') . ';');
      } else if (is_null($c)) {
        fwrite($handle, '  return null;');
      }

      fclose($handle);
    }
  }