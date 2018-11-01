<?php
require_once 'include/common.php';
require_once 'include/protect.php';

include 'header.php';

?>

<form id='bootstrap-form' action="json/bootstrap.php" method="post" enctype="multipart/form-data">
	Bootstrap file: 
	<input id='bootstrap-file' type="file" name="bootstrap-file"></br>
	<input type="submit" name="submit" value="Import">
</form>

