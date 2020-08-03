<?php namespace Codenitiva\PHP\Exceptions;

class UnknownRouterMethodException extends \Exception {

  public function __construct($method_name) {
    http_response_code(500);
    parent::__construct("Undefined method $method_name", 0, null);
  }

  public function __toString() {
    return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
  }
}
