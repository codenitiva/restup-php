<?php

require_once(__DIR__ . '/../request/IRequest.php');

class Router {
  
  private $request;
  private $http_methods = ['GET', 'POST', 'PUT', 'DELETE'];

  public function __construct(IRequest $request) {
    $this->request = $request;
  }

  public function __call($name, $args) {
    list($route, $method) = $args;

    if (!in_array(strtoupper($name), $this->http_methods)) {
      $this->handle_invalid_method();
    }

    $this->{strtolower($name)}['/apollo/backend' . $this->format_route($route)] = $method;
  }

  private function format_route($route) {
    $clean_route = trim($route);
    if ($clean_route == '') return '/';
    if (substr($route, -1) != '/') "$clean_route/";
    return $clean_route;
  }

  private function handle_invalid_method() {
    header("{$this->request->server_protocol} 405 Method Not Allowed");
  }

  private function handle_not_found() {
    header("{$this->request->server_protocol} 404 Not Found"); 
  }

  private function resolve() {
    $method_dict = $this->{strtolower($this->request->request_method)};
    $formated_route = str_replace('/index.php', '', $this->request->request_uri);
    $method = $method_dict[$formated_route];

    if(is_null($method)) {
      $this->handle_not_found();
      return;
    }

    echo call_user_func_array($method, array($this->request));
  }

  public function __destruct() {
    $this->resolve();
  }
}
