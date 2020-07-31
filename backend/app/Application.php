<?php namespace Codenitiva\PHP;

use Codenitiva\PHP\Routers\SubRouter;
use Codenitiva\PHP\Requests\Request;
use Codenitiva\PHP\Responses\Response;
use Codenitiva\PHP\Configs\AppConfig;

class Application {

  private $routers = [];
  private $request;
  private $response;

  public function __construct() {
    $this->request = new Request;
    $this->response = new Response;
  }

  public function add_sub_router(SubRouter $sub_router) {
    array_push($this->routers, $sub_router);
  }

  public function serve() {
    $request_route = $this->clean_route($this->request->request_uri);
    foreach ($this->routers as $router) {
      if (substr($request_route, 0, strlen($router->prefix_path)) == $router->prefix_path) { 
        $router->run($this->request, $this->response);
        break;
      }
    }
  }
  
  private function clean_route($route) {
    $clean_route = str_replace('/index.php', '', trim($route));
    $clean_route = str_replace(AppConfig::PATH_FROM_ROOT, '', $clean_route);
    if ($clean_route == '' || substr($clean_route, -1) != '/') $clean_route .= '/';
    return $clean_route;
  }
}
