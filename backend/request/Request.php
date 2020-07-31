<?php namespace Codenitiva\PHP\Requests;

use Codenitiva\PHP\Helpers\JSONHelper;
use Codenitiva\PHP\Helpers\CookieHelper;

class Request {

  public $body = [];
  public $cookies = [];

  public function __construct() {
    $this->init();
    $this->body = $this->retrieve_body();
    $this->cookies = $this->retrieve_cookie();
  }

  private function init() {
    foreach ($_SERVER as $key => $value) {
      $this->{strtolower($key)} = $value;
    }
  }

  public function retrieve_body() {
    if ($this->request_method == 'GET') return [];
    return JSONHelper::parse(file_get_contents('php://input'));
  }

  public function retrieve_cookie() {
    return CookieHelper::assoc();
  }
}
