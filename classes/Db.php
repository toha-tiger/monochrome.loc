<?php

class Db extends Config {

    protected $db;

    function __construct() {
        try {
            $this->db = new PDO('mysql:host='. self::DB_HOST .
                                ';dbname=' . self::DB_NAME .
                                ';charset=utf8',
                                self::DB_USER,
                                self::DB_PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log ('Db->_construct error ' . $e->getMessage());
            die('Db error');
        }
    }
}