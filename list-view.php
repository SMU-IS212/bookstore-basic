<?php

require_once 'include/common.php';
require_once 'include/protect.php';

$dao = new BookDAO();
$result = $dao->retrieveAll();

    
?>

<html>
    <body>
        <?php include 'header.php' ;
        
        echo "<h1><a href='bootstrap-view.php'>Bootstrap</a></h1>";
        echo "<h1><a href='json/'>Json API</a></h1>";
        ?>
        
        <h1>Book Listing</h1>
        <table id='book-list' border='1'>
            <tr>
                <th>Title</th>
                <th>ISBN 13</th>
                <th>Price</th>
                <th></th>
                <th></th>
            </tr>
<?php            
        foreach($result as $book) {
            echo "
            <tr>
                <td>$book->title</td>
                <td>$book->isbn13</td>
                <td>$book->price</td>
                <td><a href='edit-view.php?id=$book->isbn13'>edit</a></td>
                <td><a href='delete.php?id=$book->isbn13'>delete</a></td>
            </tr>
            ";
            
        }
?>
        
        </table>

        
        <p>
        <h2><a href="add-view.php">Add Book</a></h2>
    </body>
</html>


