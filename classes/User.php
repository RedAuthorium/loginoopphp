<?php

class User{
    private $_db;

    public function __construct()
    {
        $this->_db = Database::getInstance();
    }

    public function register_user($fields = array())
    {
        if ($this->_db->insert('users', $fields)) return true;
        else return false;
    }

    public function login_user($username, $password)
    {
        $data = $this->_db->get_info('users', 'username', $username);
        if(password_verify($password, $data['password'])){
            return true;
        }else {
            return false;
        }
    }

    public function check_name($username)
    {
        $data = $this->_db->get_info('users', 'username', $username);
        if (empty($data)) {
            return false;
        }else{
            return true;
        }
    }

    public function is_admin($username)
    {
        $data = $this->_db->get_info('users', 'username', $username);
        if ($data['role'] == 1) {
            return true;
        }else{
            return false;
        }
    }

    public function is_premiUser($username)
    {
        $data = $this->_db->get_info('users', 'username', $username);
        if ($data['role'] == 2) {
            return true;
        }else{
            return false;
        }
    }

    public function is_loggedIn()
    {
        if (Session::exist('username')) {
            return true;
        }else {
            return false;
        }
    }

    public function get_data($username)
    {
        if($this->check_name($username)){
            return $data = $this->_db->get_info('users', 'username', $username);
        }else {
            return false;
        }
    }
}


?>