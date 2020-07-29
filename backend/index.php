<?php

require_once(__DIR__ . '/db/Database.php');
require_once(__DIR__ . '/./request/Request.php');
require_once(__DIR__ . '/./router/Router.php');

$db = new Database();
$db->open_connection();
$db->close_connection();

$router = new Router(new Request);

$router->get('/', function () {
  return '<h1>Hello, Apollo</h1>';
});

$router->get('/fetch', function () {
  return json_encode(['status' => 200, 'message' => 'success']);
});

$router->post('/echo-self', function (Request $request) {
  return json_encode(['status' => 200, 'data' => $request->get_body()]);
});
