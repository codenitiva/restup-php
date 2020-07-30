<?php

require_once(__DIR__ . '/./IRequest.php');

class Request implements IRequest {

  public function __construct() {
    $this->init();
  }

  private function init() {
    foreach ($_SERVER as $key => $value) {
      $this->{strtolower($key)} = $value;
    }
  }

  public function get_body() {
    if ($this->request_method == 'GET') return;
    return json_decode(file_get_contents('php://input'));
  }
}
