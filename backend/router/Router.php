<?php namespace Codenitiva\PHP\Routers;

use Codenitiva\PHP\Requests\Request;
use Codenitiva\PHP\Responses\Response;
use Codenitiva\PHP\Middlewares\Middleware;
use Codenitiva\PHP\Exceptions\UnknownRouterMethodException;
use Codenitiva\PHP\Exceptions\UnknownRouteException;
use Codenitiva\PHP\Configs\AppConfig;

class Router {
  
  private $request;
  private $response;
  private $middlewares = [];
  private $prefix_path;
  private $http_methods = ['GET', 'POST', 'PUT', 'DELETE'];

  public function __construct(Request $request, Response $response, $prefix_path = '') {
    $this->request = $request;
    $this->response = $response;
    $this->prefix_path = $prefix_path;
  }

  public function __call($name, $args) {
    $middleware = null;
    count($args) == 3 ? list($route, $middleware, $method) = $args : list($route, $method) = $args;

    if (!in_array(strtoupper($name), $this->http_methods)) {
      throw new UnknownRouterMethodException($name);
    }

    $this->{strtolower($name)}[$this->format_route($route)] = $method;
    if ($middleware != null) {
      $this->middlewares[$this->append_method_to_route($this->format_route($route))] = $middleware;
    }
  }

  public function __destruct() {
    $this->resolve();
  }

  private function resolve() {
    $method_dict = $this->{strtolower($this->request->request_method)};
    $formated_route = $this->clean_route($this->request->request_uri);

    if (!array_key_exists($formated_route, $method_dict)) {
      throw new UnknownRouteException($this->request->request_method, $formated_route);
    }

    if ($this->run_middleware($formated_route) == Middleware::NEXT) {
      $method = $method_dict[$formated_route];
      $this->run_controller($method);
    }
  }

  private function run_middleware($route) {
    $middleware_route = $this->append_method_to_route($route);
    if (array_key_exists($middleware_route, $this->middlewares)) {
      $middleware = $this->middlewares[$middleware_route];
      return $middleware->run($this->request, $this->response);
    }
    return Middleware::NEXT;
  }

  private function run_controller($method) {
    echo call_user_func_array($method, array($this->request, $this->response));
  }

  private function clean_route($route) {
    $clean_route = str_replace('/index.php', '', trim($route));
    $clean_route = str_replace(AppConfig::PATH_FROM_ROOT, '', $clean_route);
    if ($clean_route == '' || substr($clean_route, -1) != '/') $clean_route .= '/';
    return $clean_route;
  }

  private function format_route($route) {
    $clean_route = $this->clean_route($route);
    return $this->prefix_path . $clean_route;
  }

  private function append_method_to_route($route) {
    return strtolower($this->request->request_method) . $route;
  }
}
