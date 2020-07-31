<?php namespace Codenitiva\PHP\Middlewares;

use Codenitiva\PHP\Middlewares\Middleware;
use Codenitiva\PHP\Requests\Request;
use Codenitiva\PHP\Responses\Response;

class SampleMiddleware extends Middleware {

  public function __construct() {
    $this->load(function (Request $req, Response $res, $next) {
      if (!array_key_exists('test', $req->cookies) || $req->cookies['test'] != 'your_secret_id')
        return $res->json()->unauthorized();
      call_user_func($next);
    });
  }
}
