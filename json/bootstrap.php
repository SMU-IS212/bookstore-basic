<?php
require_once '../include/common.php';
require_once '../include/protect.php';

$errors = array();
# need tmp_name -a temporary name create for the file and stored inside apache temporary folder- for proper read address
$zip_file = $_FILES["bootstrap-file"]["tmp_name"];
# Get temp dir on system for uploading
$temp_dir = sys_get_temp_dir();

# check file size
if ($_FILES["bootstrap-file"]["size"] <= 0)
	$errors[] = "input files not found";
else {
	
	$zip = new ZipArchive;
	$res = $zip->open($zip_file);
	if ($res === TRUE) {
		$zip->extractTo($temp_dir);
		$zip->close();
	} else 
		$errors[] = "extraction error";
	
	
	$user_path = "$temp_dir/user.csv";
	$book_path = "$temp_dir/book.csv";

	$userlist = @fopen($user_path, "r");
	$booklist = @fopen($book_path, "r");
	
	$n = 1;
	$m = 1;
	# check if open success
	if (empty($booklist) || empty($userlist))
		$errors[] = "input files not found";
	else {
		$connMgr = new ConnectionManager();
		$conn = $connMgr->getConnection();

		# Delete curent table data

		$stmt = $conn->prepare("TRUNCATE TABLE admin_user"); 
		$stmt->execute();

		$stmt = $conn->prepare("TRUNCATE TABLE book"); 
		$stmt->execute();

		if (!empty($userlist))
		{
			# Skip header
			$data = @fgetcsv($userlist);
	 		
	    	# Data process
	    	$userDao = new UserDAO();
			while ($data = fgetcsv($userlist)) {

				$temp = array();
				$m++;
				
				# $data row into [0] useranme [1] gender [2] password [3] name
				$user = new User($data[0], $data[1], $data[2], $data[3]);
				
	    		# Error checking for users
				# check 2 parts of username 
				$parts = explode('.',$user->username);
				$last = array_pop($parts);
				$parts = array(implode('.',$parts),$last);

				# username format first part only character or dot
				if (preg_match( '/[^a-zA-Z0-9.]/', $parts[0])){
					$temp[] = "invalid userid";
				}
				# second part is year between 2018 and 2014
				elseif (intval($parts[1])>2018 || intval($parts[1])<2014 || !isset($parts[1])){
					$temp[] = "invalid userid";
				}

				# ip duplicate
				if ($userDao->retrieve($user->username))
					$temp[] = "duplicate userid";
				
				# gender either male of female
				if ($user->gender != "male" && $user->gender != "female")
					$temp[] = "invalid gender";

	    		# invalid password if less than 8 characters or inlcudes white space
				if (strlen($user->password) < 8 || preg_match('/\s/',$user->password)) 
					$temp[] = "invalid password";
				
				# name less than 60 chars
				if (strlen($user->name) > 60 || empty($user->name))
					$temp[] = "invalid name";


				if (!isEmpty($temp)) {
					sort($temp);
					$temp[] = "user.csv line $m";
					$errors[] = $temp;
				} 
				else {
						$userDao->create($user);
				}
			}
			fclose($userlist);
			@unlink($user_path);
		}
		
		if (!empty($booklist)) {
			
			# skip header
			$data = fgetcsv($booklist);

	    	# data process
	    	$bookDao = new BookDAO();
			while ($data = fgetcsv($booklist)) {

				$n++;
				$temp = array();
				
				$book = new Book();
				$book->title = $data[0];
				$book->isbn13 = $data[1];
				$book->price = $data[2];
				$book->availability = $data[3];

	    		# checkError is in common.php
				$temp = checkError($book, ["title","isbn13","price","availability"]);
				# if duplicate
				if ($bookDao->retrieve($book->isbn13)) 
					$temp[] = "duplicate ISBN13 record";
				
				if (!isEmpty($temp)) {
					sort($temp);
					$temp[] = "book.csv line $n";
					$errors[] = $temp;
				}
				else 
				{
						$bookDao->add($book);
				}
				
			}	
			fclose($booklist);
			@unlink($book_path);	
		}
	}
}


# check error list
if (!isEmpty($errors))
{	
	$sortclass = new Sort();
	$errors = $sortclass->sort_it($errors,"bootstrap");
	$result = [ 
		"status" => "error",
		"messages" => $errors
	];
}
else
{	
	$result = [ 
		"status" => "success",
		"num-record-loaded" => [
			"user.csv" => $m-1 ,
			"book.csv" => $n-1
		]
	];
}
header('Content-Type: application/json');
echo json_encode($result, JSON_PRETTY_PRINT);


?>