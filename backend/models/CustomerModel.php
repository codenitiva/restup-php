<?php

require_once(__DIR__ . '/BaseModel.php');

class Customer extends Model{

  public function __construct() {
    parent::__construct("customer");
  }

  public function get_by_id($data) {
    return parent::get_by_id($data);
  }

  public function get_all() {
    return parent::get_all();
  }

  public function insert($types, $data) {
    parent::insert($types, $data);
  }

  public function update($types, $data) {
    parent::update($types, $data);
  }

  public function delete($data) {
    parent::delete($data);
  }
}