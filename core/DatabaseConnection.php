<?php

class DatabaseConnection
{
    private $connection = null;

    private function __construct(){
        $this->connection = new PDO('mysql:host=localhost;dbname=jewelrystore', 'root', '',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false]);
    }

    private function __clone(){}

    public function __wakeup()
    {
        throw new \http\Exception\BadMethodCallException();
    }


    private static $instance = null;

    public static function instance(): DatabaseConnection{
        if(self::$instance === null){
            self::$instance = new DatabaseConnection();
        }

        return self::$instance;
    }

    public static function connection(): PDO{
        return self::instance()->connection;
    }

    public static function prepare($query):PDOStatement{
        return self::connection()->prepare($query);
    }
}