<?php namespace Codenitiva\PHP\Models;

class Role extends Model{

  public function __construct() {
    parent::__construct("role");
  }

  public function get_sample() {
    return parent::query('SELECT * FROM role');
  }
}