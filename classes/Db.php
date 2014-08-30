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

    //query('SELECT login FROM WHERE id = ?' , array($id))
    //or
    //query('SELECT login FROM WHERE id = :id' , array(':id' => $id))
    function query($query, $params = array()) {
        $stmt = $this->db->prepare($query);
        if (!empty($params))
        {
            $i = 0; 
            foreach ($params as $param_name => $param_value) {
                if (is_numeric($param_name)) {
                    $stmt->bindValue($i, $param_value);
                } else {
                    $stmt->bindParam($param_name, $param_value);
                }
                $i++;
            }
        }
        try {
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            $this->errors[] = 'Error ';
            if(self::DEBUG_MODE) {
                $this->errors[] = $e->getMessage();
            }
            error_log ('Db->query error ' . $e->getMessage());
        }
        return false;
    }

    //get('users', array('login', '=', 'test'))
    function get($table, $where = array()) {
        if (count($where) == 3)
        {
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];
            $query = "SELECT * FROM {$table} WHERE {$field} {$operator} ?";
            $result = $this->query($query, array($value));
            
        }

    }
}