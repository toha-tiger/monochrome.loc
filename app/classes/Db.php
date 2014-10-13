<?php

class Db extends Config {

    private $db;
    private $db_result;
    private $db_count;
    private $db_errors = array();

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

    //query('SELECT login FROM WHERE id = ?' , array($id))
    //or
    //query('SELECT login FROM WHERE id = :id' , array(':id' => $id))
    function query($query, $params = array()) {
        $this->db_errors[] = array();
        $this->db_count = null;
        $stmt = $this->db->prepare($query);
        if (!empty($params)) {
            $i = 1;
            foreach ($params as $param_name => $param_value) {
                if (is_numeric($param_name)) {
                    $stmt->bindValue($i, $param_value);
                } else {
                    $stmt->bindValue($param_name, $param_value);
                }
                $i++;
            }
        }
        try {
            $stmt->execute();
            if ($stmt->columnCount() && $stmt->rowCount()) {
                $this->db_count = $stmt->rowCount();
                if($this->db_count) {
                    $this->db_result = $stmt->fetchAll(PDO::FETCH_OBJ);
                }
            }
            return true;
        } catch (PDOException $e) {
            $this->db_errors[] = 'DB->query error ';
            if(self::DEBUG_MODE) {
                $this->db_errors[] = $e->getMessage();
            }
            error_log ('Db->query error ' . $e->getMessage());
        }
        return false;
    }

    function db_get_result() {
        return $this->db_result;
    }

    function db_get_count() {
        return $this->db_count;
    }

    public function db_get_errors() {
        return $this->db_errors;
    }
}