<?php

require_once(__DIR__ . '/../request/Request.php');
require_once(__DIR__ . '/../response/Response.php');
require_once(__DIR__ . '/../middleware/Middleware.php');

class Router {
  
  private $request;
  private $response;
  private $middlewares;
  private $http_methods = ['GET', 'POST', 'PUT', 'DELETE'];

  public function __construct(Request $request, Response $response) {
    $this->request = $request;
    $this->response = $response;
  }

  public function __call($name, $args) {
    $middleware = null;
    count($args) == 3 ? list($route, $middleware, $method) = $args : list($route, $method) = $args;

    if (!in_array(strtoupper($name), $this->http_methods)) {
      throw new Exception("Undefined method $name");
    }

    // TODO ! remove /apollo/backend on production mode
    $this->{strtolower($name)}['/apollo/backend' . $this->format_route($route)] = $method;
    if ($middleware != null) {
      $this->middlewares[strtolower($name) . '/apollo/backend' . $this->format_route($route)] = 
        new Middleware($this->request, $this->response, $middleware);
    }
  }

  public function __destruct() {
    $this->resolve();
  }

  private function resolve() {
    $method_dict = $this->{strtolower($this->request->request_method)};
    $formated_route = $this->format_route($this->request->request_uri);

    if (!array_key_exists($formated_route, $method_dict)) {
      echo 'Unknown route: <b>' . $this->request->request_method . '</b> ' . $formated_route;
      return;
    }

    if ($this->run_middleware($formated_route)) {
      $method = $method_dict[$formated_route];
      echo call_user_func_array($method, array($this->request, $this->response));
    }
  }

  private function run_middleware($route) {
    $middleware_route = strtolower($this->request->request_method) . $route;
    if (array_key_exists($middleware_route, $this->middlewares)) {
      $middleware = $this->middlewares[$middleware_route];
      $middleware_output = $middleware->run();
      if ($middleware_output != 'pass') {
        echo $middleware_output;
        return false;
      }
    }
    return true;
  }

  private function format_route($route) {
    $clean_route = str_replace('/index.php', '', trim($route));
    if ($clean_route == '') return '/';
    if (substr($clean_route, -1) != '/') return "$clean_route/";
    return $clean_route;
  }
}
