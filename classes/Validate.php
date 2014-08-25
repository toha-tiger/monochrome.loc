<?php

class Validate {
	public $errors = array();
	
	public function check($data, $ruleset = array()){
		foreach ($ruleset as $field => $rules) {
			$value = $data[$field];
			if ($rules['required'] && !empty($value)) {
				foreach ($rules as $rule => $rule_value) {
					
				}

			} elseif (!empty($value)) {
				$this->errors[] .= "{$field} is required";
			}
		}
		
		return !count($this->errors);
	}
}