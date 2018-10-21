<?php
require_once '../include/common.php';
require_once '../include/protect.php';

	# need tmp_name -a temporary name create for the file and stored inside apache temporary folder- for proper read address
$errors = array();

$zip_file = $_FILES["bootstrap-file"]["tmp_name"];
# Get temp dir on system
$temp_dir = sys_get_temp_dir();
if ($_FILES["bootstrap-file"]["size"] > 0) {
	$zip = new ZipArchive;
	$res = $zip->open($zip_file);
	if ($res === TRUE) {
		$zip->extractTo($temp_dir);
		$zip->close();
	} else {
		$errors[] = 'extraction error';
	}

	
	$user_path = "$temp_dir/user.csv";
	$book_path = "$temp_dir/book.csv";


	if (($userlist = @fopen($user_path, "r")) && ($booklist = @fopen($book_path, "r")))
	{
		if (filesize($user_path) > 0 && filesize($book_path) > 0) {	
		$connMgr = new ConnectionManager();
		$conn = $connMgr->getConnection();

	# Delete curent table data
		$stmt = $conn->prepare("TRUNCATE TABLE book"); 
		$stmt->execute();

		$stmt = $conn->prepare("TRUNCATE TABLE admin_user"); 
		$stmt->execute();


	# Insert new data
		$booksql = "INSERT IGNORE INTO book (title, isbn13, price, availability) VALUES (:title, :isbn13, :price, :availability)";
		$usersql = "INSERT IGNORE INTO admin_user (username, gender, password, name) VALUES (:username, :gender, :password, :name)";


		$m = 1;
		$stmt = $conn->prepare($usersql); 
    # Header process
		$data = fgetcsv($userlist);
    # Your code here


    # Data process
		while ($data = fgetcsv($userlist)) {

			$m++;
    	# Error checking for users
    	# invalid username
			$parts = explode('.',$data[0]);

			if (preg_match( '/[^a-zA-Z.]/', $parts[0])){
				$errors[] = "invalid user id";
			}
			elseif (intval($parts[1])>2018 || intval($parts[1])<2014 || !isset($parts[1])){
				$errors[] = "invalid user id";

			}
			$userDao = new UserDAO();
			if ($userDao->retrieve($data[0]))
				$errors[] = "duplicate user id";
			if ($data[1] != "male" && $data[1] != "female")
				$errors[] = "invalid user id";
    	# invalid password
			if (strlen($data[2]) < 8 || preg_match('/\s/',$data[2])) 
				$errors[] = "password must more than 8 characters";
			if (strlen($data[3]) > 60)
				$errors[] = "invalid name";


			if (!isEmpty($errors)) {
				$errors[] = "user.csv line $m";
			} 
			else {
				$data[2] = password_hash($data[2],PASSWORD_DEFAULT);
				$stmt->bindParam(':username', $data[0], PDO::PARAM_STR);
				$stmt->bindParam(':gender', $data[1], PDO::PARAM_STR);
				$stmt->bindParam(':password', $data[2], PDO::PARAM_INT);
				$stmt->bindParam(':name', $data[3], PDO::PARAM_INT);

				$stmt->execute();
				
			}
		}

		$stmt = $conn->prepare($booksql); 
		$n = 1;
	# Header process
		$data = fgetcsv($booklist);
    # Your code here

    # Data process
		while ($data = fgetcsv($booklist)) {

			$n++;
			$bookDao = new BookDAO();
			$book = new Book();
			$book->title = $data[0];
			$book->isbn13 = $data[1];
			$book->price = $data[2];
			$book->availability = $data[3];

    	# checkError is in common.php
			
			$temp = checkError($book, ["title","isbn13","price","availability"]);
			if ($bookDao->retrieve($book->isbn13)) 
				$temp[] = "duplicate ISBN13 record";
			
			if (!isEmpty($temp)) {
				$temp[] = "book.csv line $n";
				$errors = array_merge($errors,$temp);
			}
			else {
				$stmt->bindParam(':title', $data[0], PDO::PARAM_STR);
				$stmt->bindParam(':isbn13', $data[1], PDO::PARAM_STR);
				$stmt->bindParam(':price', $data[2], PDO::PARAM_INT);
				$stmt->bindParam(':availability', $data[3], PDO::PARAM_INT);

				$stmt->execute();	
				
			} 
			

		}	
		fclose($userlist);
		fclose($booklist);

		unlink($user_path);
		unlink($book_path);	
		}
		else{
		$errors[] = "file is empty";
		}

	}
	else 
		$errors[] = "can't find user.csv and book.csv, make sure they're directly under the zip, not inside a folder";
	
}
else {
	$errors[] = "file is empty";
}

if (!isEmpty($errors))
{
	$result = [ 
		"status" => "error",
		"message" => $errors
	];
}
else
{	
	$result = [ 
		"status" => "success",
		"num-record-loaded" => [
			"user.csv" => $m ,
			"book.csv" => $n
		]
	];
}
header('Content-Type: application/json');
echo json_encode($result, JSON_PRETTY_PRINT);


?>