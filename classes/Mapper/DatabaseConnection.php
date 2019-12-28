<?php

namespace Mapper;

/*
 * Database connection class (Singleton)
 */
class DatabaseConnection{
    private static $instance = null;

    private const HOST = '127.0.0.1';
    private const USERNAME = 'root';
    private const PASSWORD = '';
    private const NAME = 'Piccy';

    private $link;

    private function __construct(){
        // Connect using PDO
        $this->link = new \PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USERNAME, self::PASSWORD);
        $this->link->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(){
        if(DatabaseConnection::$instance === null)
            DatabaseConnection::$instance = new DatabaseConnection();
        return DatabaseConnection::$instance;
    }

    /*
     * A wrapper function for PDO::prepare();
     * @param string $statment
     */
    public static function prepare($statment){
        $db = DatabaseConnection::getInstance();
        // $db->link->prepare() is a method in PDO class itself, different from this on DatabaseConnection::prepare();
        return $db->link->prepare($statment);
    }

    public static function getLastInsertID(){
        $db = DatabaseConnection::getInstance();
        return $db->link->lastInsertId();
    }

}
