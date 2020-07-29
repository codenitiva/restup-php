<?php

require_once(__DIR__ . '/DBConstants.php');

class Database {

  private $conn = null;
  private $stmt;
  private $rs;

  public function open_connection() {
    $this->conn = mysqli_connect(
      DBConstants::HOST, 
      DBConstants::USER, 
      DBConstants::PASSWORD, 
      DBConstants::DB_NAME
    );
    if (mysqli_connect_errno()) die('Failed to connect: ' . mysqli_connect_errno());
  }

  public function close_connection() {
    mysqli_close($this->conn);
    $this->conn = null;
  }

  public function prepare($query) {
    if ( !($this->stmt = $this->conn->prepare($query)) )
      die($this->stmt->error);
  }

  public function query($query) {
    $this->rs = $this->conn->query($query);
  }

  public function bind($type, $params) {
    $args = array(&$type);
    $count = count($params);

    for ($i=0; $i<$count; $i++) {
      $args[] = &$params[$i];
    }

    if( !call_user_func_array(array($this->stmt, 'bind_param'), $args) )
      die($this->stmt->error);
  }

  public function execute() {
    if( !$this->stmt->execute() )
      die($this->stmt->error);
  }

  public function resultSet() {
    return $this->rs->fetch_all(MYSQLI_ASSOC);
  }

}
