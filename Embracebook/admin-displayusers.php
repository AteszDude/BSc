<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include("database.php");
include("session.php");

$title = "Table of registered users.";
?>
<?php include("header.php"); ?>
	<p>
		<?php
			printusertable($db);
		?>
	</p>
<?php include("footer.php"); ?>