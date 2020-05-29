<?php

//use PDO;
//use PDOException;


abstract class AbstractModel
{
  protected $conn;

  public function startSQLConnection(array $config): void
  {
    try {
      $config = $config['db']; // undefined index fix

      $this->validateConfig($config);
      $this->createConnection($config);
    } catch (PDOException $e) {
      echo 'Connection error';
    }
  }

  /* public function __construct(array $config)
  {
    try {
      $config = $config['db']; // undefined index fix

      $this->validateConfig($config);
      $this->createConnection($config);
    } catch (PDOException $e) {
      echo 'Connection error';
    }
  }
 */
  private function createConnection(array $config): void
  {
    $dsn = "mysql:dbname={$config['database']};host={$config['host']}";

    $this->conn = new PDO(
      $dsn,
      $config['user'],
      $config['password'],
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" // utf-8 (europe lang encode) charters fix
      ]
    );
  }

  private function validateConfig(array $config): void
  {

    if (
      empty($config['database'])
      || empty($config['host'])
      || empty($config['user'])
      // || empty($config['password']) //default password is empty
    ) {

      echo 'Storage configuration error';
    }
  }
}
