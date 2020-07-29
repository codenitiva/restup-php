<?php

require_once(__DIR__ . '/../db/Database.php');

class Role {

  private $table = "role";
  private $roleData;
  private $db;

  public function __construct() {
    $this->db = new Database();
    $this->db->open_connection();
  }

  public function getAll() {
    $this->db->query('SELECT * FROM role');
    return $this->db->resultSet();
  }

  public function insert($response_body) {
    $ROLE_NAME = $response_body->role_name;

    $query = "INSERT INTO role (role_name) VALUES (?)";

    $this->db->prepare($query);
    $this->db->bind('s', array($ROLE_NAME));
    $this->db->execute();
  }

  public function update($response_body) {
    $ROLE_ID = $response_body->id;
    $ROLE_NAME = $response_body->role_name;

    $query = "UPDATE role SET role_name=? WHERE id=?";
    $this->db->prepare($query);
    $this->db->bind('si', array($ROLE_NAME, $ROLE_ID));
    $this->db->execute();
  }

  public function delete($response_body) {
    $ROLE_ID = $response_body->id;

    $query = "DELETE FROM role WHERE id=?";
    $this->db->prepare($query);
    $this->db->bind('i', array($ROLE_ID));
    $this->db->execute();
  }
}