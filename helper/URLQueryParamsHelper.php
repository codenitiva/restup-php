<?php namespace Codenitiva\PHP\Helpers;

class URLQueryParamsHelper {

  public static function assoc() {
    $arr = [];
    foreach ($_GET as $key => $value) {
      $arr[$key] = $value;
    }
    return $arr;
  }
}
