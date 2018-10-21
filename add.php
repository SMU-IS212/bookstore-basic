<?php

require_once 'include/common.php';
require_once 'include/protect.php';


$errors = [
            isMissingOrEmpty ('title', $_POST['title']),
            isMissingOrEmpty ('isbn13', $_POST['isbn13']),
            isMissingOrEmpty ('price', $_POST['price']),
        ];
$errors = array_filter($errors);


if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;

    include "add-view.php";
    exit();
}

$dao = new BookDAO();

$book = new Book();
$book->title = $_POST['title'];
$book->isbn13 =  $_POST['isbn13'];
$book->price = $_POST['price'];

$errors = checkError($book, ["title","isbn13","price"]);

if ($dao->retrieve($book->isbn13)) {
    $errors[] = "duplicate ISBN13 record";
}

if (!isEmpty($errors)) {
    $_SESSION['errors'] = $errors;
    
    include "add-view.php";
    exit();
}

$dao->add($book);

// send back to listing page
header("Location: list-view.php");

?>