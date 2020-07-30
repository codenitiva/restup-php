<?php

require_once(__DIR__ . '/../request/Request.php');
require_once(__DIR__ . '/../response/Response.php');

class Middleware {

  private $response;
  private $request;
  private $closure;
  private $next = false;

  public function __construct(Request $request, Response $response, $closure) {
    $this->request = $request;
    $this->response = $response;
    $this->closure = $closure;
  }

  public function run() {
    $middleware_output = call_user_func_array($this->closure, array($this->request, $this->response, function () {
      $this->next = true;
    }));
    if (!$this->next) return $middleware_output;
    return 'pass';
  }
}
