<?php

require_once(__DIR__ . '/db/Database.php');
require_once(__DIR__ . '/./request/Request.php');
require_once(__DIR__ . '/./response/Response.php');
require_once(__DIR__ . '/./router/Router.php');

$db = new Database();
$db->open_connection();
$db->close_connection();

$router = new Router(new Request, new Response);

$router->post('/', function (Request $req, Response $res, $next) {
  if ($req->get_body()->id != 1)return $res->json()->unauthorized();
  call_user_func($next);
}, function (Request $req, Response $res) {
  return $res->json(['id' => 1, 'name' => 'Tommy Salim', 'age' => 20])->ok();
});

$router->post('/post', function (Request $req, Response $res) {
  return $res->json($req->get_body())->ok();
});

$router->put('/put', function (Request $req, Response $res) {
  return $res->json($req->get_body())->ok();
});

$router->delete('/delete', function (Request $req, Response $res) {
  return $res->json($req->get_body())->ok();
});
