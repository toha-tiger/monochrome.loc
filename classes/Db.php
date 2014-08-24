<?php

class Db extends Config {

    private $db;

    function __construct() {
        try {
            $this->db = new PDO('mysql:host='. self::DB_HOST .
                                ';dbname=' . self::DB_NAME .
                                ';charset=utf8',
                                self::DB_USER,
                                self::DB_PASSWORD);
        } catch (PDOException $e) {
            error_log ('Db construct error ' . $e->getMessage());
            die('Db error');
        }
    }
}