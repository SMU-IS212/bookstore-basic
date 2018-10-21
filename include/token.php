<?php
require_once "JWT.php";

// Secret key is something you hardcoded for your server/application
// Admin will have different secret key
const SECRET_KEY = "qwertyuiop";
const SECRET_KEY_ADMIN = "qwertyadmi"; 

/**
 * @param string $username  Login user's username
 * 
 * @return string The token
 */
function generate_token($username) {
	if ($username == 'admin')
    // The username obtained from login form, admin is hardcode name
    	return JWT::generate_token($username, SECRET_KEY_ADMIN);
	else
		return JWT::generate_token($username, SECRET_KEY);
}

/**
 * @param string $token The token to be verified
 * 
 * @return mixed  If verified, return string username.  Else return boolean false.
 */
function verify_token($token) {
    $admin = JWT::verify_token($token, SECRET_KEY_ADMIN); # Verify for admin
    $user = JWT::verify_token($token, SECRET_KEY); # Verify for normal users
    if ($admin)
    	return 2;
    elseif ($user)
    	return 1;
    else return 0;
}

