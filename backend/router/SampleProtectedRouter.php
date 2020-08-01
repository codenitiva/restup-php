<?php namespace Codenitiva\PHP\Routers;

use Codenitiva\PHP\Routers\SubRouter;
use Codenitiva\PHP\Responses\Response;
use Codenitiva\PHP\Requests\Request;
use Codenitiva\PHP\Controllers\SampleController;
use Codenitiva\PHP\Middlewares\SampleMiddleware;

class SampleProtectedRouter extends SubRouter {

  public function __construct() {
    parent::__construct('/protected');
  }

  public function run(Request $req, Response $res) {
    parent::run($req, $res);
    $controller = new SampleController($req, $res);

    $this->router->get('/', $controller->use('test_protected'));
  }
}
