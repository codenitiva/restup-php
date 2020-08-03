<?php namespace Codenitiva\PHP\Routers;

use Codenitiva\PHP\Controllers\SampleController;
use Codenitiva\PHP\Responses\Response;
use Codenitiva\PHP\Requests\Request;
use Codenitiva\PHP\Routers\SubRouter;

class SampleRouter extends SubRouter {

  public function __construct() {
    parent::__construct('/sample');
  }

  public function run(Request $req, Response $res) {
    parent::run($req, $res);
    $controller = new SampleController;

    $this->router->get('/', $controller->use('index'));
  }
}
