<?php namespace Codenitiva\PHP\Routers;

use Codenitiva\PHP\Routers\SubRouter;
use Codenitiva\PHP\Routers\Router;
use Codenitiva\PHP\Requests\Request;
use Codenitiva\PHP\Responses\Response;
use Codenitiva\PHP\Middlewares\SampleMiddleware;
use Codenitiva\PHP\Controllers\SampleController;

class SampleRouter extends SubRouter {

  public function __construct() {
    parent::__construct('/sample');
  }

  public function run(Request $req, Response $res) {
    parent::run($req, $res);
    $controller = new SampleController($req, $res);

    $this->router->get('/', $controller->use('index'));
    
    $this->router->get('/fetch', new SampleMiddleware, $controller->use('fetch'));

    $this->router->get('/test', $controller->use('test'));
  }
}
