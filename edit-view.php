<?php

require_once 'include/common.php';
require_once 'include/protect.php';

$dao = new BookDAO();
$book = new Book();

if (isset($_GET['id'])) {
    $book = $dao->retrieve($_GET['id']);
} else if (isset($_POST['title'])) {
    $book->title = $_REQUEST['title'];
    $book->isbn13 = $_REQUEST['isbn13'];
    $book->price = $_REQUEST['price'];
}


?>

<html>
    <body>
        <?php include 'header.php' ?>
        
        <h1>Edit Book</h1> 
        <?php printErrors(); ?>
        
        <form id='edit-form' action='edit.php' method='post'>
        <table>
                <tr>
                    <td>
                        Title
                    </td>
                    <td>
                        <input type='text' name='title' value='<?php echo htmlspecialchars($book->title, ENT_QUOTES, 'UTF-8');?>' />
                    </td>
                </tr>
                <tr>
                    <td>
                        ISBN13
                    </td>
                    <td>
                        <?php echo $book->isbn13; ?>
                        <input type='hidden' name='isbn13' value='<?php echo $book->isbn13; ?>'  />
                    </td>
                </tr>
                <tr>
                    <td>
                        Price
                    </td>
                    <td>
                        <input type='text' name='price' value='<?php echo $book->price; ?>'  />
                    </td>
                </tr>
            </table>
            <input type='submit' />
        
        </form>
        
    </body>
</html>