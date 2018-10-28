<?php
require_once 'token.php';
require_once 'common.php';

if (isset($_REQUEST['token'])) {
	$token = $_REQUEST['token'];
}
else {
	$token = $_SESSION['token'];
}

$pathSegments = explode('/',$_SERVER['PHP_SELF']); # Current url
$numSegment = count($pathSegments);
$currentFolder = $pathSegments[$numSegment - 2]; # Current folder
$page = $pathSegments[$numSegment -1]; # Current page

# If page is bootstrap-view or bootstrap, check if token is from admin user
if ($page == "bootstrap-view.php" || $page == "bootstrap.php" || $page == "upload.php")
{	
	if (verify_token($token) != 2){
			$_SESSION['errors'] =  ["not admin user"]; # Sorry sir
			# Go back to login
			header("Location: login-view.php");
		}
}
# if we're in JSON, then we should return JSON
elseif ($currentFolder == "json" && !verify_token($token))
{
	$result = [
            "status"=>"error",
            "messages"=> "token is invalid"
        ];
    
 	header('Content-Type: application/json');
 	echo json_encode($result, JSON_PRETTY_PRINT);
 	exit();
}
elseif (!verify_token($token)) {

     $_SESSION['errors'] =  "token is invalid";
     
     header("Location: login-view.php");
}
?>