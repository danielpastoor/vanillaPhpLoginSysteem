<?php

class DB extends PDO
{
  private $db_host = 'localhost';
  private $db_username = 'root';
  private $db_password = '';
  private $db_database = 'login_system';

  protected $connection;
  protected $table;
  protected $where = [];
  protected $wherePrepare = [];
  protected $columns = "";


  function __construct()
  {
    try {
      $this->connection = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_database . ";charset=utf8mb4", $this->db_username, $this->db_password);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $err) {
      Helpers::setError("Database connection failed");
    }
  }

  public function table($table = "")
  {
    $this->table = $table;
    $this->where = [];
    $this->wherePrepare = [];

    return $this;
  }

  public function columns($columns = [])
  {
    if (is_array($columns)) {
      foreach ($columns as $column) {
        $this->columns .= "`$column` ";
      }
    }

    return $this;
  }

  public function where($col, $value)
  {
    $this->where[] = "`$col` = :$col";
    $this->wherePrepare[":" . $col] = $value;

    return $this;
  }

  public function first()
  {
    $cols = !empty($this->columns) ? $this->columns : "*";

    $stmt = $this->connection->prepare(
      "SELECT $cols FROM {$this->table} WHERE {$this->buildWhere()} LIMIT 1"
    );

    if ($stmt->execute($this->wherePrepare)) {
      return $stmt->fetch(PDO::FETCH_OBJ);
    }

    return false;
    $this->close();
  }

  public function get()
  {
    $cols = !empty($this->columns) ? $this->columns : "*";

    $stmt = $this->connection->prepare(
      "SELECT $cols FROM {$this->table} WHERE {$this->buildWhere()};"
    );

    $stmt->execute($this->wherePrepare);

    return $stmt->fetchAll();
    $this->close();
  }

  public function insert($values = [])
  {
    $cols = "";
    $valuesQuery = '';
    $prepareValues = [];

    foreach ($values as $key => $value) {
      $cols .= $key . (array_key_last($values) === $key ? "" : ", ");
      $valuesQuery .= ":" . $key . (array_key_last($values) === $key ? "" : ", ");

      $prepareValues[":" . $key] = $value;
    }

    $stmt = $this->connection->prepare(
      "INSERT INTO {$this->table} ($cols) VALUES ($valuesQuery)"
    );

    if ($stmt->execute($prepareValues)) {
      return ['result' => true, 'userID' => $this->connection->lastInsertId()];
    } else {
      return ['result' => false];
    }
    $this->close();
  }

  private function buildWhere()
  {
    $count = count($this->where) - 1;
    $return = "";
    foreach ($this->where as $key => $whereItem) {
      if ($key === $count) {
        $return .= $whereItem;
      } else {
        $return .= $whereItem . " && ";
      }
    }

    return $return;
  }

  private function close()
  {
    return $this->connection = null;
  }
}
