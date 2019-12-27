<?php
class DatabaseConnection{
    private static $instance = null;

    private const HOST = '127.0.0.1';
    private const USERNAME = 'root';
    private const PASSWORD = '12341234';
    private const NAME = 'Piccy';

    private $link;

    private function __construct(){
        $this->link = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USERNAME, self::PASSWORD);
        $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(){
        if($this->instance === null)
            $this->instance = new DatabaseConnection();
        return $this->instance;
    }

}
