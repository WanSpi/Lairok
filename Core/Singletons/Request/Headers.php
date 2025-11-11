<?php

  namespace Lairok\Singletons\Request;

  use Lairok\Singleton;

  class Headers extends Singleton {
    private array $headers = [];

    protected function __construct() {
      $headers = getallheaders();
 
      foreach ($headers as $name => $value) {
        $this->headers[strtolower($name)] = $value;
      }
    }

    /* Methods */

    public function GetContentType() : string {
      return $this->Get('content-type') ?? 'text/plain';
    }

    /* Accept */

    private array $accepts = [];

    private function parseAccept(string $strAccept) {
      $arrayAccept = explode(',', $strAccept);

      $acceptGroup = [];
      $acceptGroups = [];

      foreach ($arrayAccept as $acceptValue) {
        if (preg_match('/^([^\;]+)[\s\S]*\;q=([\.0-9]+)/', $acceptValue, $match)) {
          $acceptGroups[] = [
            'group'   => [ ...$acceptGroup, strtolower($match[1]) ],
            'quality' => floatval($match[2])
          ];

          $acceptGroup = [];
        } else {
          $acceptGroup[] = strtolower($acceptValue);
        }
      }

      usort($acceptGroups, function($a, $b){
        if ($a['quality'] > $b['quality']) {
          return -1;
        } else {
          return 1;
        }
      });

      return array_merge(
        array_merge(...array_map(function($group){
          return $group['group'];
        }, $acceptGroups)), $acceptGroup
      );
    }

    private function getAccept(string $type = '') {
      if (empty($type)) {
        $type = 'accept';
      } else {
        $type = 'accept-' . $type;
      }

      if (!array_key_exists($type, $this->accepts)) {
        $this->accepts[$type] = $this->parseAccept($this->headers[$type] ?? '');
      }

      return $this->accepts[$type];
    }

    public function GetPriorityAccept(array $values, string $type = '') : ?string{
      $accept = $this->getAccept($type);

      $qualityAccept = null;
      $priorityAccept = null;

      foreach ($values as $value) {
        $index = array_search(strtolower($value), $accept);

        if ($index === false) {
          continue;
        }

        if (is_null($qualityAccept) || $qualityAccept > $index) {
          $qualityAccept = $index;
          $priorityAccept = $value;
        }
      }

      return $priorityAccept;
    }

    /* Global */

    public function Get(string $name) : ?string {
      $name = strtolower($name);

      if (array_key_exists($name, $this->headers)) {
        return $this->headers[$name];
      } else {
        return null;
      }
    }

    public function GetGroup(array $names) : array {
      $headers = [];

      foreach ($names as $name) {
        $headers[$name] = $this->GetHeader($name);
      }

      return $headers;
    }

    public function GetAll() : array {
      return $this->headers;
    }
  }