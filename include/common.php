<?php

// this will autoload the class that we need in our code
spl_autoload_register(function($class) {
 
    // we are assuming that it is in the same directory as common.php
    // otherwise we have to do
    // $path = 'path/to/' . $class . ".php"    
    require_once "$class.php"; 
  
});


// session related stuff

session_start();
ini_set('display_errors', 1);

# get configuration parameters
include "configuration.php";


error_reporting(E_ALL ^ E_NOTICE);

function printErrors() {
    if(isset($_SESSION['errors'])){
        echo "<ul style='color:red;'>";
        
        foreach ($_SESSION['errors'] as $value) {
            echo "<li>" . $value . "</li>";
        }
        
        echo "</ul>";   
        unset($_SESSION['errors']);
    }    
}

# check if field is set
function isMissingOrEmpty($name) {
    $value = $_REQUEST[$name];
    if (!isset($value) || empty($value)) {
        return "$name cannot be empty";
    }
}


# check if an int input is an int and non-negative
function isNonNegativeInt($var) {
    if (is_numeric($var) && $var >= 0 && $var == round($var))
        return TRUE;
}

# check if a float input is is numeric and non-negative
function isNonNegativeFloat($var) {
    if (is_numeric($var) && $var >= 0)
        return TRUE;
}

# check error one by one using a checklist
function checkError($book, $checklist) {
    $errors = array();
    foreach ($checklist as $item) {
        switch ($item) {
            case "title":
                if (strlen($book->title) > 100 || empty($book->title))
                    $errors[] = "invalid title";
                break;
            case "isbn13":  # check isbn13 format
                if (strlen($book->isbn13) != 13 || !isNonNegativeInt($book->isbn13)) {
                    $index = array_search('ISBN13 record not found',$errors);
                    if($index !== FALSE){
                        unset($errors[$index]);
                    }
                    $errors[] = "invalid ISBN13 value";
                }
                break;    
            case "isbn13record":  # check if record exist
                if (!in_array("invalid ISBN13 value",$errors)) {
                    $dao = new BookDAO();  
                    if (!$dao->retrieve($book->isbn13))
                        $errors[] = "ISBN13 record not found";
                }
                break;
            case "price":   # check price format
                if (!isNonNegativeFloat($book->price))
                    $errors[] = "invalid price";
                break;
            case "availability":    # check availability format
                if (!isNonNegativeInt($book->availability))
                    $errors[] = "invalid availability";
        }
    }
    return $errors;
}



function isEmpty($var) {
    if (isset($var))
    foreach ($var as $key => $value) {
    if (empty($value)) {
       unset($var[$key]);
    }
    }

    if (empty($var))
        return TRUE;
}