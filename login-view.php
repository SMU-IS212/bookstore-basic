<?php

//require_once 'include/session.php';
require_once 'include/common.php';

$username = '';
if (isset($_POST['username'])) {
    $username = $_POST['username'];
}


?>

<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php printErrors(); ?>
    
    <form method="post" action="login.php">
        <table>
        <tr>
            <td>
                Username
            </td>
            <td>
                <input name="username" value="<?= $username ?>" />
            </td>
        </tr>
        <tr>
            <td>
                Password
            </td>
            <td>
                <input name="password" type="password" />
            </td>
        </tr>
        </table>
        <input type="submit" value="Login"/>
    </form>
</body>
</html>