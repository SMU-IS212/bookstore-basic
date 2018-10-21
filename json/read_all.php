<?php

require_once '../include/common.php';
require_once '../include/protect.php';

$dao = new BookDAO();
$list = $dao->retrieveAll();

$sortclass = new Sort();
$list = $sortclass->sort_it($list,'title');

$result = [
            "status"=>"success",
            "storeid"=>$storeid,
            "result"=>$list
        ];
        
 header('Content-Type: application/json');
 echo json_encode($result, JSON_PRETTY_PRINT);
 
?>