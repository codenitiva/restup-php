<?php namespace Codenitiva\PHP;

use Codenitiva\PHP\Routers\SubRouter;
use Codenitiva\PHP\Requests\Request;
use Codenitiva\PHP\Responses\Response;
use Codenitiva\PHP\Configs\AppConfig;
use Codenitiva\PHP\Middlewares\Middleware;

class Application {

  private $routers = [];
  private $request;
  private $response;

  public function __construct() {
    $this->request = new Request;
    $this->response = new Response;
  }

  public function add_sub_router(SubRouter $sub_router, Middleware $middleware = null) {
    array_push($this->routers, [$sub_router, $middleware]);
  }

  public function serve() {
    $request_route = $this->clean_route($this->request->request_uri);
    foreach ($this->routers as $router) {
      if (substr($request_route, 0, strlen($router[0]->prefix_path)) == $router[0]->prefix_path) {
        if ($router[1] != null && $router[1]->run($this->request, $this->response) == Middleware::STOP) break;
        $router[0]->run($this->request, $this->response);
        break;
      }
    }
  }
  
  private function clean_route($route) {
    $clean_route = str_replace('/index.php', '', trim($route));
    $clean_route = str_replace(AppConfig::PATH_FROM_ROOT, '', $clean_route);
    $clean_route = explode('?', $clean_route)[0];
    if ($clean_route == '' || substr($clean_route, -1) != '/') $clean_route .= '/';
    return $clean_route;
  }
}
