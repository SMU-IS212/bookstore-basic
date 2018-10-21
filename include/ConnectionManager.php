<?php
class ConnectionManager {
    
   
    public function getConnection() {
        
        include 'configuration.php';
        $url  = "mysql:host={$server};dbname={$dbname}";
        $conn = new PDO($url, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        return $conn;  
        
    }
    
}

