<?php

class UserDAO {
    
    public  function retrieve($username) {
        $sql = 'select username, gender, password, name from admin_user where username=:username';
        
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
        
            
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();


        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new User($row['username'], $row['gender'],$row['password'], $row['name']);
        }
    }

    public  function retrieveAll() {
        $sql = 'select * from admin_user';
        
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = array();


        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new User($row['username'], $row['gender'],$row['password'], $row['name']);
        }
        return $result;
    }
  

}
