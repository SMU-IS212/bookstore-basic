<?php

require_once '../include/common.php';
require_once '../include/token.php';


// isMissingOrEmpty(...) is in common.php
$errors = [ isMissingOrEmpty ('username'), 
            isMissingOrEmpty ('password') ];
$errors = array_filter($errors);


if (!isEmpty($errors)) {
    $result = [
        "status" => "error",
        "messages" => $errors
        ];
}
else{
    $username = $_POST['username'];
    $enteredPwd = $_POST['password'];

    $dao = new UserDAO();
    $user = $dao->retrieve($username);

    
    if ($username == "admin" && $enteredPwd == "admin"){
        $_SESSION['admin'] = 1;
        $user = new User();
        $user->name = "Admin";
        $user->gender = "male";
        $user->username="admin";
        $_SESSION['user'] = $user;
        $token = generate_token($user->username);
        $_SESSION['token'] = $token;
        $result = [ 
            "status" => "success",
            "token" => $token
        ];
    }    
    elseif (isset($user) && $user->authenticate($enteredPwd)) {
        $token = generate_token($username);
        $result = [ 
            "status" => "success",
            "token" => $token
        ];
        $_SESSION['token'] = $token;
        
    } else {
    	$result = [ 
            "status" => "error", 
            "messages" => [ "invalid username or password" ]
        ];
        $_SESSION['token'] = "";
    }
}

header('Content-Type: application/json');
echo json_encode($result, JSON_PRETTY_PRINT);
 
?>