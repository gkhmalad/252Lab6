<?php
class DatabaseConnection{
    private static $instance = null;
    private $connection;
    private $host = 'us-cdbr-iron-east-02.cleardb.net';
    private $username = 'be0a8efb543439';
    private $password = 'c92d1aba';
    private $database = 'heroku_e1ba5c910aaeefe';
    private function __construct(){
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);
    }
    public static function getInstance(){
        if(!self::$instance) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }
    public function getConnection(){
        return $this->connection;
    }
}
