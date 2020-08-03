<?php namespace Codenitiva\PHP\Routers;

use Codenitiva\PHP\Routers\Router;
use Codenitiva\PHP\Requests\Request;
use Codenitiva\PHP\Responses\Response;
use Codenitiva\PHP\Exceptions\IllegalPrefixPathException;

class SubRouter {

  public $router;
  public $prefix_path;
  
  public function __construct($prefix_path) {
    if ($prefix_path == '/' || $prefix_path == '') throw new IllegalPrefixPathException;
    $this->prefix_path = $prefix_path;
  }

  public function run(Request $req, Response $res) {
    $this->router = new Router($req, $res, $this->prefix_path);
  }
}
