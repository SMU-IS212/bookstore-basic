<?php
$user = $_SESSION['user'];
if (strtolower($user->gender) == 'male')
$prefix = 'Mr';
elseif (strtolower($user->gender) == 'female')
$prefix = 'Ms';

$name = $prefix.". ".$user->name;
echo "
    <table>
    <tr>
        <td>Welcome {$name} ! </td>
        <td><a id='logout' href='logout.php'>Logout</a></td>
    </tr>
    </table>
    <hr />
";
