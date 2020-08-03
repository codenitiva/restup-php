<?php namespace Codenitiva\PHP\Exceptions;

class IllegalPrefixPathException extends \Exception {

  public function __construct() {
    http_response_code(500);
    parent::__construct("Illegal Prefix Path used on a Sub Router", 0, null);
  }

  public function __toString() {
    return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
  }
}
