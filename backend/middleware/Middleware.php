<?php namespace Codenitiva\PHP\Middlewares;

use Codenitiva\PHP\Requests\Request;
use Codenitiva\PHP\Responses\Response;

class Middleware {

  const NEXT = 0;
  const STOP = 1;

  private $callback;
  private $next = false;

  public function run(Request $request, Response $response) {
    $middleware_output = call_user_func_array($this->callback, array($request, $response, function () {
      $this->next = true;
    }));
    
    if (!$this->next) {
      echo $middleware_output;
      return self::STOP;
    }
    return self::NEXT;
  }

  public function load($callback) {
    $this->callback = $callback;
  }
}
