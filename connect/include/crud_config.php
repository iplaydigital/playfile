<?php

class Config
{
  private const DBHOST = '203.146.252.149';
  private const DBUSER = 'fufudev_panjaree';
  private const DBPASS = '6%Dn3j8a';
  private const DBNAME = 'panjaree_web';

  private $dsn = 'mysql:host=' . self::DBHOST . ';dbname=' . self::DBNAME . '';

  protected $conn = null;

  // Method for connection to the database
  public function __construct()
  {
    try {
      $this->conn = new PDO($this->dsn, self::DBUSER, self::DBPASS);
      $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die('Error: ' . $e->getMessage());
    }
  }
}
