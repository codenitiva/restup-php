<?php namespace Codenitiva\PHP\Models;

class Sample extends Model {

  private $table = "sample";

  public function __construct() {
    parent::__construct($this->table);
  }
}