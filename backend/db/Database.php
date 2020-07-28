<?php

require_once(__DIR__ . '/DBConstants.php');

class Database {

  public $conn = null;
  
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
}
