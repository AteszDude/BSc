<?php

include("database.php");
include("session.php");

// check if the user is logged in, if not give them a login screen.
if($s->loggedin)
{
	$title = "Welcome to Embracebook! ";
	include("header.php");
	
	?>

	<p>Inbox:</p><br>
<?php
//Get the current users ID to determine the relation between the user and the profile owner
$getuserid = mysql_query("SELECT `userID` FROM `user` WHERE `email` ='" . $_SESSION['email'] . "' LIMIT 0, 4");
$userid = mysql_fetch_row($getuserid);

//Select the messages where we are the recipient and we haven't deleted it yet
$query="SELECT * FROM `message` INNER JOIN `user` ON `message`.`senderID` = `user`.`userID`
WHERE `recipientID` =" . $userid[0] . " AND (`status` =0 OR `status` =1)
LIMIT 0 , 30 ";

$inboxresult = mysql_query($query);

while($row = mysql_fetch_array($inboxresult))
  {//DISPLAY INBOX

  echo "<A href=viewprofile.php?profileid=" . $row['senderID'] . ">" . $row['firstname'] . " " . $row['lastname'] . "</A>";
       /*Determine if the letter is read*/
   if($row["isRead"] ==0) {$letterimage = "new_mail.png";} else {$letterimage = "read_mail.png";}
  echo "<img src=http://soba.cs.man.ac.uk/~tordag7/group_project/M4/images/" . $letterimage . " width=20 height=20></img>";
  echo "<br>";
  echo $row['subject'] . "<br>";
  echo " " . $row['date'];
  echo "<A href=readletter.php?letterid=" . $row['messageID'] . "> ->> </A><br>";

  }

//INBOX****
?>


	<p><br><br>Outbox:</p><br>

<?php
//Select the messages where we are the sender and we haven't deleted it yet
$query="SELECT * FROM `message` INNER JOIN `user` ON `message`.`recipientID` = `user`.`userID`
WHERE `senderID` =" . $userid[0] . " AND (`status` =0 OR `status` =2)
LIMIT 0 , 30 ";

$inboxresult = mysql_query($query);

while($row = mysql_fetch_array($inboxresult))
  {//DISPLAY INBOX

  echo "<A href=viewprofile.php?profileid=" . $row['recipientID'] . ">" . $row['firstname'] . " " . $row['lastname'] . "</A>";
  echo "<br>";
  echo $row['subject'] . "<br>";
  echo " " . $row['date'];
  echo "<A href=readletter.php?letterid=" . $row['messageID'] . "> ->> </A><br>";

  }

//OUTBOX****
?>




<?php
include("footer.php");

}
else
{
	$title = "Welcome to Embracebook! ";
	include("header.php");
	?>
    
    <h3>You need to log in.</h3>
	<p>
<?php
	
	include("footer.php");
//End of check
}
?>
