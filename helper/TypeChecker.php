<?php namespace Codenitiva\PHP\Helpers;

class TypeChecker {

  public static function get_type($values) {
    return implode("", array_map(function($value) {
      return gettype($value)[0];
    }, $values));
  }
}
