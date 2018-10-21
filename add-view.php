<?php

require_once 'include/common.php';
require_once 'include/protect.php';
  
$book = new Book();

if (isset($_POST['title'])) {
    $book->title = $_POST['title'];
    $book->isbn13 = $_POST['isbn13'];
    $book->price = $_POST['price'];
}

?>

<html>
    <body>
        <?php include 'header.php' ?>
        
        <h1>Add Book</h1>
        
        <?php printErrors(); ?>

        <form id='add-form' action='add.php' method='post'>
            <table>
                <tr>
                    <td>
                        Title
                    </td>
                    <td>
                        <input type='text' name='title' value='<?php echo $book->title; ?>' />
                    </td>
                </tr>
                <tr>
                    <td>
                        ISBN13
                    </td>
                    <td>
                        <input type='text' name='isbn13' value='<?php echo $book->isbn13; ?>'  />
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