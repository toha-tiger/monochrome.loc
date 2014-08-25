<?php

class Validate extends Db {
	public $errors = array();
	
	public function check($data, $ruleset = array()){
		foreach ($ruleset as $field => $rules) {
			$value = $data[$field];
			if ($rules['required'] && !empty($value)) {
				foreach ($rules as $rule => $rule_value) {
					switch ($rule) {
                        case 'email':
                            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                                $this->errors[] = 'Wrong email address';
                            }
                            break;
                        case 'min':
                            if (mb_strlen($value) < $rule_value) {
                                $this->errors[] = "{$field} should be at least {$rule_value} characters";
                            }
                            break;
                        case 'max':
                            if (mb_strlen($value) > $rule_value) {
                                $this->errors[] = "{$field} should be not most {$rule_value} characters";
                            }
                            break;
                        case 'match':
                            if ($value != $data[$rule_value]) {
                                $this->errors[] = "{$field} should match {$rule_value}";
                            }
                            break;
                        case 'set_in':
                            if (!in_array($value, $rule_value)) {
                                $possible_vals = implode(" or ", $rule_value);
                                $this->errors[] = "{$field} can be only {$possible_vals}";
                            }
                            break;
                        case 'preg':
                            if(!preg_match("{$rule_value}", $value)) {
                                $this->errors[] = "{$field} doesn't math pattern";
                            }
                            break;
                        case 'date':
                            list($y, $m, $d) = explode('-', $value);
                            if (!checkdate($m, $d, $y)) {
                                $this->errors[] = "Wrong {$field} date";
                            }
                            break;
                        case 'unique':
                            try {
                                $select = $this->db->prepare("SELECT `${field}` FROM {$rule_value} WHERE `${field}` = :value;");
                                $select->bindParam(':value', $value);
                                if ($select->execute()) {
                                    if ($select->rowCount()) {
                                        $this->errors[] = "{$field} is already taken";
                                    }
                                }
                            } catch (PDOException $e) {
                                $this->errors[] = "Can not check {$field}";
                                if(self::DEBUG_MODE) {
                                    $this->errors[] = $e->getMessage();
                                }
                                error_log('Validate->check unique error ' . $e->getMessage());
                                return true;
                            }
                    }
				}

			} elseif ($rules['required']) {
				$this->errors[] = "{$field} is required";
			}
		}
		return !count($this->errors);
	}
}