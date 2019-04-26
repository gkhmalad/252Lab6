<?php
class DatabaseConnection{
    private static $instance = null;
    private $connection;
    private $host = 'us-cdbr-iron-east-02.cleardb.net';
    private $username = 'b57824e205c97b';
    private $password = 'afca4188';
    private $database = 'heroku_50cfedd6d87cf7d';
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
