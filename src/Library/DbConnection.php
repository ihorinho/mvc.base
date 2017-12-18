<?php

namespace Library;

/**
 * Class DbConnection
 * @package Library
 */
class DbConnection
{

    /**
     * @var null
     */
    private static $instance = null;

    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * DbConnection constructor.
     * @param $config
     */
    public function __construct($config)
    {

        $db_config = $config->get('db');

        $dsn = 'mysql: host=' .$db_config['db_host']. '; dbname=' . $db_config['db_name'];
        $this->pdo = new \PDO($dsn, $db_config['db_user'], $db_config['db_password']);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @return DbConnection|null
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return \PDO
     */
    public function getPDO()
    {
        return $this->pdo;
    }

    /**
     *
     */
    private function __clone(){}

    /**
     *
     */
    private function __wakeup(){}
}