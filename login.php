<?php

require_once 'include/common.php';
require_once 'include/token.php';

// isMissingOrEmpty(...) is in common.php
$errors = [ isMissingOrEmpty ('username'), isMissingOrEmpty ('password') ];
$errors = array_filter($errors);


if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;
    include "login-view.php";
    exit();
}

$username = $_POST['username'];
$enteredPwd = $_POST['password'];



$dao = new UserDAO();
$user = $dao->retrieve($username);

# This is hardcode for admin
if ($username == "admin" && $enteredPwd == "admin"){
	$user = new User($username, 'male', $enteredPwd, 'Admin');
	
	$_SESSION['user'] = $user;
	$token = generate_token($username);
    $_SESSION['token'] = $token;
	header("Location: list-view.php");
}    
# This is for the rest of users
elseif (isset($user) && $user->authenticate($enteredPwd)) {
    $_SESSION['user'] = $user;
    $token = generate_token($username);
    $_SESSION['token'] = $token;
    header("Location: list-view.php");
} else {
    $_SESSION['errors'] = [ 'Username/password is incorrect' ];
    include 'login-view.php';
}
?>