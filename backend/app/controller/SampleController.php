<?php namespace Codenitiva\PHP\Controllers;

use Codenitiva\PHP\Controllers\Controller;
use Codenitiva\PHP\Responses\Response;
use Codenitiva\PHP\Requests\Request;

class SampleController extends Controller {

  public function index(Request $req, Response $res) {
    return $res->json($req->query)->ok();
  }
}
