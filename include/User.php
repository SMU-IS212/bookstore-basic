<?php

class User {
    // property declaration
    public $name;
    public $gender;
    public $username;    
    public $password;
    
    public function __construct($username='', $gender='', $password='', $name='') {
        $this->username = $username;
        $this->gender = $gender;
        $this->password = $password;
        $this->name = $name;
    }
    
    public function authenticate($enteredPwd) {
        return password_verify ($enteredPwd, $this->password);
    }
}

?>