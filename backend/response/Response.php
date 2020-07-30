<?php

require_once(__DIR__ . '/./IResponse.php');
require_once(__DIR__ . '/./ResponseContentType.php');

class Response implements IResponse {

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

  public function ok() {
    return $this->build_response(200, $this->response_data, 'data');
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

  private function build_response($status, $data, $data_key = 'message') {
    http_response_code($status);
    switch ($this->type) {
      case ResponseContentType::JSON:
        return json_encode([
          'status' => $status,
          $data_key => $data
        ]);
      default:
        return $data;
    }
  }
}
