<?php namespace Codenitiva\PHP\Requests;

use Codenitiva\PHP\Helpers\JSONHelper;
use Codenitiva\PHP\Helpers\CookieHelper;
use Codenitiva\PHP\Helpers\URLQueryParamsHelper;

class Request {

  public $body = [];
  public $cookies = [];
  public $query = [];

  public function __construct() {
    $this->init();
    $this->body = $this->retrieve_body();
    $this->cookies = $this->retrieve_cookie();
    $this->query = $this->retrieve_query();
  }

  private function init() {
    foreach ($_SERVER as $key => $value) {
      $this->{strtolower($key)} = $value;
    }
  }

  private function retrieve_query() {
    return URLQueryParamsHelper::assoc();
  }

  private function retrieve_body() {
    if ($this->request_method == 'GET') return [];
    return JSONHelper::parse(file_get_contents('php://input'));
  }

  private function retrieve_cookie() {
    return CookieHelper::assoc();
  }
}
