<?php

Class Validate {
    
    private $db;
    
    public function __construct($conn) {
        
        $this->db = $conn;
        
    }
    
    //Returns validated username or throws an error
    public function usernameValidate($uname) {
        
        if(empty($uname)) {
            return 'Username is blank';
        } elseif (strlen($uname) < 2) {
            return'Username is too short';
        } elseif (strlen($uname) > 64) {
            return 'Username is too long';
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $uname)) {
            return 'Username cannot include special characters';
        } else {
            $uname = strip_tags($uname);
            
            //Query database for duplicate username
            $stmt = $this->db->prepare("SELECT userName FROM users WHERE userName = ?");
            $stmt->bind_param("s", $uname);
            $stmt->execute();
            $stmt->store_result();
            
            //If duplicate username, throw error, else return username
            if ($stmt->num_rows !== 0) {
                return 'Username is already taken';        
            }
            
        }
        
    }
    
    //Returns validated email or throws an error
    public function emailValidate($email) {
        
        if(empty($email)) {
            return 'Email is blank';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Invalid email';
        } elseif(strlen($email) > 64) {
            return 'Email is too long';
        } else {
            $email = strip_tags($email);
            
            //Query database for duplicate email
            $stmt = $this->db->prepare("SELECT userEmail FROM users WHERE userEmail = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            
            //If duplicate email, throw error, else return email
            if ($stmt->num_rows != 0) {
                return 'Email is already in use';        
            }
            
        }
        
    }
    
    //Returns validated password or throws an error
    public function passwordValidate($pass, $pass2) {
        
        if (empty($pass) || empty($pass2)) {
            return 'Password is blank';
        } elseif (strlen($pass) < 6) {
            return 'Password is too short';
        } elseif ($pass !== $pass2) {
            return 'Passwords do not match';
        }
        
    }
    
}

?>