<?php namespace Codenitiva\PHP\Models;

use Codenitiva\PHP\Database\Database;
use Codenitiva\PHP\Database\DBConstants;
use Codenitiva\PHP\Utils\QueryBuilder;

class Model {

  private $table;
  private $db = null;
  private $query_builder = null;
  
  protected function __construct($table) {
    $this->db = new Database();
    $this->db->open_connection();

    $this->query_builder = new QueryBuilder();

    $this->table = $table;
  }

  protected function get_by_id($data) {
    $query = "SELECT * FROM " . $this->table . " WHERE id=?";
    $this->db->prepare($query);
    $this->db->bind(array_values($data));
    $this->db->execute();
    return $this->db->result_set();
  }

  protected function get_all() {
    $this->db->query("SELECT * FROM " . $this->table);
    return $this->db->result_set();
  }

  protected function insert($data) {
    $query = $this->query_builder->insert_query_builder($this->table, array_keys($data));
    $this->db->prepare($query);
    $this->db->bind(array_values($data));
    $this->db->execute();
  }

  protected function update($data){
    $query = $this->query_builder->update_query_builder($this->table, array_keys($data));
    $this->db->prepare($query);
    $this->db->bind(array_values($data));
    $this->db->execute();
  }

  protected function delete($data){
    $query = "DELETE FROM " . $this->table . " WHERE id=?";
    $this->db->prepare($query);
    $this->db->bind(array_values($data));
    $this->db->execute();
  }

  protected function query($sql) {
    $this->db->query($sql);
    return $this->db->result_set();
  } 
}