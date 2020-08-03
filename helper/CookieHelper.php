<?php namespace Codenitiva\PHP\Helpers;

class CookieHelper {

  public static function set($name, $value, $expiry, $secure, $http_only) {
    setcookie($name, $value, time() + $expiry, '/', null, $secure, $http_only);
  }

  public static function assoc() {
    $cookies = [];
    foreach ($_COOKIE as $key => $value) {
      $cookies[$key] = $value;
    }
    return $cookies;
  }
}
