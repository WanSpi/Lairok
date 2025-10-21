<?php

  namespace Lairok\Singletons\Request;

  use Lairok\Singleton;

  class URI extends Singleton {
    private string $href;

    private string $port;
    private string $scheme;

    private string $path;
    private array $pathFragments;

    private string $query;
    private array $queryFragments;

    private string $domain;
    private array $domainFragments;

    protected function __construct() {
      $this->href = $_SERVER['REQUEST_URI'] ?? '/';

      $this->port = $_SERVER['SERVER_PORT'] ?? '80';
      $this->scheme = $_SERVER['REQUEST_SCHEME'] ?? 'http';

      $hrefExplode = explode('?', $this->href);
      $this->path = $hrefExplode[0];
      $this->query = $hrefExplode[1] ?? '';

      $this->pathFragments = [];
      $pathFragments = explode('/', $this->path);

      foreach ($pathFragments as $fragment) {
        $fragment = trim($fragment);

        if ($fragment !== '') {
          $this->pathFragments[] = $fragment;
        }
      }

      $this->queryFragments = [];
      if (!empty($this->query)) {
        $queryFragments = explode('&', $this->query);

        foreach ($queryFragments as $fragment) {
          $fragment = trim($fragment);

          if ($fragment === '') {
            continue;
          }

          $fragmentExplode = explode('=', $fragment);
          $this->queryFragments[$fragmentExplode[0]] = $fragmentExplode[1] ?? null;
        }
      }

      $this->domain = $_SERVER['SERVER_NAME'] ?? $_SERVER['HTTP_HOST'] ?? '';
      $this->domainFragments = explode('.', $this->domain);
    }

    public function GetHref() : string {
      return $this->href;
    }

    public function GetPort() : string {
      return $this->port;
    }
    public function GetScheme() : string {
      return $this->scheme;
    }

    public function GetPath(bool $retArray = false) : string|array {
      if ($retArray) {
        return $this->pathFragments;
      } else {
        return $this->path;
      }
    }

    public function GetQuery(bool $retArray = false) : string|array {
      if ($retArray) {
        return $this->queryFragments;
      } else {
        return $this->query;
      }
    }

    public function GetDomain(bool $retArray = false) : string|array {
      if ($retArray) {
        return $this->domainFragments;
      } else {
        return $this->domain;
      }
    }
  }