<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include("database.php");
include("session.php");

$title = "Compose new letter!";

include("header.php");


	//A recipient ID MUST BE supplied!!!
	if(!isset($_GET["recipient"]))
		return;

$mailrecipient = $_GET["recipient"];

//Recipients name
$getrecipient = "SELECT `firstname` , `lastname` FROM `user` WHERE `userID` =" . $mailrecipient;
	$grecipient = mysql_query($getrecipient, $db->connection);

//The recipients name
$recname = mysql_fetch_row($grecipient);
$recname = $recname[0] . " " . $recname[1];

echo "<br><br>";

?>
	<form action="sendemail.php?recipientid=<?php echo $mailrecipient?>" method="POST">
	Recipient:<A href=viewprofile.php?profileid=<?php echo $mailrecipient?> > <?php echo $recname?> </A>
	<br>
	<input type="text" name="subject" ID=subject value="Subject"><br>
	<TEXTAREA name="composearea" rows="20" cols="40" ID=composearea wrap="physical">
	Compose Message
	</TEXTAREA><br>

	<input type="submit" value="Send" name="Submit">
	</form>





<?php include("footer.php"); ?>
