<?php

class Validation{

    private $_passed = FALSE,
            $_errors = array();

    public function check($items = array())
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $ruleValues) {
                
                switch ($rule) {
                    case 'required':
                        if (trim(Input::get($item)) == false && $ruleValues == true) {
                            $this->addError("$item cannot be null!");
                        }
                        break;
                    case 'min':
                        if (strlen(Input::get($item)) < $ruleValues ) {
                            $this->addError("$item username at least 5 characters");
                        }
                        break;
                    case 'max':
                        if (strlen(Input::get($item)) > $ruleValues ) {
                            $this->addError("$item username maximum 11 characters");
                        }
                        break;
                    case 'match':
                        if (Input::get($item) != Input::get($ruleValues)) {
                            $this->addError("Password Should be same!");
                        }
                        break;

                    default:
                        break;
                }
            }
        }
        if (empty($this->_errors)) {
            $this->_passed = TRUE;
        }

        return $this;
    }

    private function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function passed()
    {
        return $this->_passed;
    }
}

?>