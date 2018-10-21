<?php


require_once 'include/common.php';
require_once 'include/protect.php';


$dao = new BookDAO();
$dao->remove($_GET['id']);

header("Location: list-view.php");
