<?php namespace Codenitiva\PHP\Controllers;

use Codenitiva\PHP\Requests\Request;
use Codenitiva\PHP\Responses\Response;

class Controller {

  public function use($method) {
    return function (Request $req, Response $res) use ($method) {
      return call_user_func_array(array($this, $method), array($req, $res));
    };
  }
}
