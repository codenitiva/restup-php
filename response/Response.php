<?php namespace Codenitiva\PHP\Responses;

use Codenitiva\PHP\Responses\ResponseContentType;
use Codenitiva\PHP\Helpers\JSONHelper;
use Codenitiva\PHP\Helpers\CookieHelper;

class Response {

  private $response_data;
  private $type;

  public function json($data = null) {
    $this->set_content($data, ResponseContentType::JSON);
    return $this;
  }

  public function html($html_code) {
    $this->set_content($html_code, ResponseContentType::HTML);
    return $this;
  }

  public function cookie($name, $value, $expiry, $secure, $http_only) {
    CookieHelper::set($name, $value, $expiry, $secure, $http_only);
    return $this;
  }

  public function ok() {
    return $this->build_response(200, $this->response_data);
  }

  public function bad_request() {
    return $this->build_response(400, 'Bad Request');
  }

  public function unauthorized() {
    return $this->build_response(401, 'Unauthorized');
  }

  private function set_content($content, $type) {
    header("Content-Type: $type");
    $this->response_data = $content;
    $this->type = $type;
  }

  private function build_response($status, $data) {
    $data_key = is_array($data) ? 'data' : "message";
    http_response_code($status);
    switch ($this->type) {
      case ResponseContentType::JSON:
        return JSONHelper::stringify([
          'status' => $status,
          $data_key => $data
        ]);
      default:
        return $data;
    }
  }
}
