<?php

require_once(__DIR__ . '/Base_model.php');

class Role extends Model{

  public function __construct() {
    parent::__construct("role");
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