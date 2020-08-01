<?php namespace Codenitiva\PHP\Middlewares;

use Codenitiva\PHP\Middlewares\Middleware;
use Codenitiva\PHP\Responses\Response;
use Codenitiva\PHP\Requests\Request;

class SampleMiddleware extends Middleware {

  public function __construct() {
    $this->load(function (Request $req, Response $res, $next) {
      if (!array_key_exists('restup', $req->query) || $req->query['restup'] != 'great')
        return $res->json()->unauthorized();
      call_user_func($next);
    });
  }
}
