<?php

interface IResponse {

  public function ok();
  public function bad_request();
  public function unauthorized();
}
