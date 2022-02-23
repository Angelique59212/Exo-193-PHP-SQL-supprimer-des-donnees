<?php

/**
 * Handle MySQL Connection with PDO.
 * Class DB
 */
class DB
{
    private string $server = 'localhost';
    private string $db = 'donnees';
    private string $user = 'root';
    private string $pwd = '';

    private static PDO $dbInstance;

    /**
     * DbStatic constructor.
     */
    public function __construct() {
        try {
            self::$dbInstance = new PDO("mysql:host=$this->server;dbname=$this->db;charset=utf8", $this->user, $this->pwd);
            self::$dbInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Return PDO instance.
     */
    public static function getInstance(): ?PDO {
        if( is_null(self::$dbInstance) ) {
            new self();
        }
        return self::$dbInstance;
    }

    /**
     * Avoid instance to be cloned.
     */
    public function __clone() {}
}
