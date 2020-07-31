<?php namespace Codenitiva\PHP\Controllers;

use Codenitiva\PHP\Controllers\Controller;
use Codenitiva\PHP\Requests\Request;
use Codenitiva\PHP\Responses\Response;

class SampleController extends Controller {

  public function index(Request $req, Response $res) {
    return $res->cookie('test', 'your_secret_id', 60, false, true)->json('Your cookie :)')->ok();
  }

  public function fetch(Request $req, Response $res) {
    return $res->json(['id' => 1, 'name' => 'Tommy Salim', 'age' => 20])->ok();
  }
}
