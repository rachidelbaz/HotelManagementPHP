<?php
class Database
{
  //get this value from config file
  private $db_host = DB_HOST;
  private $db_name = DB_NAME;
  private $db_user = DB_USER;
  private $db_pass = DB_PASS;
  private $charset = DB_CHARSET;
  private $port = DB_PORT;

  private $db_handler;
  private $error;
  private $statment;

  public function __construct()
  {
    $dsn = "mysql:host=" . $this->db_host . ";dbname=" . $this->db_name . ";charset=" . $this->charset . ";port=" . $this->port;
    //print_r($dsn);
    $options = [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    try {
      $this->db_handler = new PDO($dsn, $this->db_user, $this->db_pass, $options);
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      throw new PDOException($this->error);
      //echo $this->error;
    }
  }
  //Create prepared setatment
  public function Query($query)
  {
    $this->statment = $this->db_handler->prepare($query);
  }
  //Bind values
  public function Bind($params, $value, $type = null)
  {
    switch (is_null($type)) {
      case (is_int($value)):
        $type = PDO::PARAM_INT;
        break;
      case (is_bool($value)):
        $type = PDO::PARAM_BOOL;
        break;
      case (is_null($value)):
        $type = PDO::PARAM_NULL;
        break;
      default:
        $type = PDO::PARAM_STR;
    }
    $this->statment->bindvalue($params, $value, $type);
  }
  //Execute prepared stetment 
  public function Excute()
  {
    return $this->statment->execute();
  }
  //Get results as array
  public function ResultSet()
  {
    $this->Excute();
    return $this->statment->fetchAll(PDO::FETCH_OBJ);
  }
  //Get one object as row
  public function Single()
  {
    $this->Excute();
    return $this->statment->fetch(PDO::FETCH_OBJ);
  }
  //Get row counts
  public function Count()
  {
    $this->Excute();
    return $this->statment->rowCount();
  }
}
