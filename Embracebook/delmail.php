<?php

include("database.php");
include("session.php");

	$title = "Delete Mail";
	include("header.php");


  if(!isset($_GET['mailid']) || $_GET['mailid'] == "")
	{
	echo "Something bad happened!";
	}

//Which mail must be deleted?
$mailid = $_GET['mailid'];


//The current users id
$getuserid = mysql_query("SELECT `userID` FROM `user` WHERE `email` ='" . $_SESSION['email'] . "' LIMIT 0, 1", $db->connection);
$userid = mysql_fetch_row($getuserid);


//Is the user a sender or a recipient?
$mailquery = "SELECT `recipientID`, `senderID`, `status` FROM `message` WHERE `messageID`=" . $mailid;
$mail = mysql_query($mailquery, $db->connection);
$maildata = mysql_fetch_array($mail);


if($userid[0] == $maildata['recipientID']) $isSender = FALSE;
elseif($userid[0] == $maildata['senderID']) $isSender = TRUE;
else echo "Invalid message!";

//Lets construct the query!
$query="";

//Is the message deleted by the another user?

//Delete from Database
if(($isSender && $maildata['status']==2) || (!$isSender && $maildata['status']==1))
	{
	$query="DELETE FROM `message` WHERE `message`.`messageID`=" . $mailid;
	}

elseif($isSender)//If we are the sender: changes status to 1
	{
	$query="UPDATE `COMP10900_M4`.`message` SET `status` = '1' WHERE `message`.`messageID` =" . $mailid;
	}

else	{//We are the recipient: change status to 2
	$query="UPDATE `COMP10900_M4`.`message` SET `status` = '2' WHERE `message`.`messageID` =" . $mailid;
	}

$result = mysql_query($query, $db->connection);

if($result) echo "Message deleted!";
else echo "Unknown problem!";

include("footer.php");
?>
