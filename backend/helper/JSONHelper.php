<?php namespace Codenitiva\PHP\Helpers;

class JSONHelper {

  public static function parse($string) {
    return json_decode($string, true);
  }

  public static function stringify($json) {
    return json_encode($json);
  }
}
