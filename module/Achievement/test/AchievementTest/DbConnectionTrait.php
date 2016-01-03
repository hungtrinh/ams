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
     * 
     * @return PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
     */
    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO(
                    $GLOBALS['DB_DSN'],
                    $GLOBALS['DB_USER'],
                    $GLOBALS['DB_PASSWD']
                );
            }
            $this->conn = new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection(
                self::$pdo,
                $GLOBALS['DB_DBNAME']
            );
        }
        return $this->conn;
    }
    
    final public function getDbAdapter()
    {
         return new \Zend\Db\Adapter\Adapter([
            'driver' => 'Pdo_Sqlite',
            'dsn' => $GLOBALS['DB_DSN']
         ]);

    }
}