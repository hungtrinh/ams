<?php
namespace  AchievementTest;

use PDO;
use PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection;

trait DbConnectionTrait
{
     // only instantiate pdo once for test clean-up/fixture load
    static private $pdo = null;

    // only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
    private $conn = null;
    
    /**
     * @see \PHPUnit_Extensions_Database_TestCase_Trait::getConnection() implementation
     * @return PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
     */
    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO(
                    $GLOBALS['DB_DSN'],
                    $GLOBALS['DB_USER'],
                    $GLOBALS['DB_PASSWD'],
                    [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"]
                );
            }
            $this->conn = new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection(
                self::$pdo,
                $GLOBALS['DB_DBNAME']
            );
        }
        return $this->conn;
    }
    
    /**
     * Make db adapter support test with zend 2 app
     * @return \Zend\Db\Adapter\Adapter
     */
    final public function getDbAdapter()
    {
        return new \Zend\Db\Adapter\Adapter([
            'driver' => $GLOBALS['DB_DRIVER'],
            'dsn' => $GLOBALS['DB_DSN'],

            'database' => $GLOBALS['DB_DBNAME'],
            'username' => $GLOBALS['DB_USER'],
            'password' => $GLOBALS['DB_PASSWD'],
            'driver_options' => [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
            ],
        ]);
    }
}
