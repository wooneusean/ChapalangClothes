<?php

declare(strict_types=1);

class mysqlidb
{
  #region Database Settings
  private static $host = "localhost";
  private static $db = "chapalang";
  private static $user = "root";
  private static $pass = "";
  private static $port = 3306;
  private static $con = null;
  #endregion

  #region Class Methods
  private function __construct()
  {
  }
  private function __clone()
  {
  }
  public function __wakeup()
  {
  }
  #endregion

  static function getConn()
  {
    if (is_null(self::$con)) {
      self::$con = mysqli_connect(self::$host, self::$user, self::$pass, self::$db, self::$port);
    }

    return self::$con;
  }

  static function getError()
  {
    return self::getConn()->error;
  }

  static function getAffectedRows()
  {
    return self::getConn()->affected_rows;
  }

  static function query(string $queryString)
  {
    $result = self::getConn()->query($queryString);
    if ($result) {
      return $result;
    } else {
      throw new Exception("Query $queryString: " . self::getError());
    }
  }

  static function multiQuery(string $queryString)
  {
    $results = [];
    if (self::getConn()->multi_query($queryString)) {
      do {
        if ($result = self::getConn()->store_result()) {
          while ($resultSet = $result->fetch_all(MYSQLI_ASSOC)) {
            array_push($results, $resultSet);
          }
          $result->free();
        }
      } while (self::getConn()->more_results() && self::getConn()->next_result());

      return $results;
    } else {
      throw new Exception("Query $queryString: " . self::getError());
    }
  }

  static function lastInsertId()
  {
    return self::getConn()->insert_id;
  }

  static function escape(string $string)
  {
    return mysqli_real_escape_string(self::getConn(), $string);
  }

  static function fetchAllRows(string $queryString)
  {
    $result = self::query($queryString);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $result->free_result();

    return $rows;
  }

  static function fetchRow(string $queryString)
  {
    $result = self::query($queryString);
    $row = $result->fetch_assoc();
    $result->free_result();

    return $row;
  }

  static function checkRecordExists(string $queryString): bool
  {
    $result = self::query($queryString);
    if ($result->num_rows > 0) {
      return true;
    } else {
      return false;
    }
  }
}
