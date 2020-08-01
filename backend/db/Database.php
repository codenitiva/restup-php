<?php namespace Codenitiva\PHP\Database;

use Codenitiva\PHP\Utils\TypeChecker;

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
    if ($this->stmt = $this->conn->prepare($query))
      echo $this->stmt->error;
  }

  public function query($query) {
    $this->rs = $this->conn->query($query);
  }

  public function bind($params) {
    $args = array(TypeChecker::get_type($params));
    print_r($args);
    $count = count($params);

    for ($i=0; $i<$count; $i++) {
      $args[] = &$params[$i];
    }

    if(!call_user_func_array(array($this->stmt, 'bind_param'), $args))
      echo $this->stmt->error;
  }

  public function execute() {
    if(!$this->stmt->execute())
      echo $this->stmt->error;
      
    $this->rs = $this->stmt->get_result();
  }

  public function result_set() {
    return $this->rs->fetch_all(MYSQLI_ASSOC);
  }

}
