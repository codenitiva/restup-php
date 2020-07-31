<?php namespace Codenitiva\PHP\Exceptions;

class UnknownRouteException extends \Exception {

  public function __construct($method, $route) {
    http_response_code(500);
    parent::__construct("Unknown Route:\n$method\n$route", 0, null);
  }

  public function __toString() {
    return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
  }
}
