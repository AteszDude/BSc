<?php

//THIS PHP FILE DELETES/ADDS/APPROVES THE FRIENDS

include("database.php");
include("session.php");


	$title = "Search";
	include("header.php");

	if(!isset($_GET['friendid']) || $_GET['friendid'] == "")
		{
		echo "Something is bad with the friend";
		return;
		}
	if(!isset($_GET['operation']) || $_GET['operation'] == "")
		{
		echo "Something is bad with the requested operation";
		return;
		}


//Get the current users ID
$getuserid = mysql_query("SELECT `userID` FROM `user` WHERE `email` ='" . $_SESSION['email'] . "' LIMIT 0, 100");
$userid = mysql_fetch_row($getuserid);

$friendid = $_GET['friendid'];//The friend who should altered
$operation = $_GET['operation'];//Operation: 0 - MARK, 1 - DELETE, 2 - ACCEPT, 3 - DECLINE

$request="";

if($operation == 0)
 {//MARK AS A FRIEND
 $request="INSERT INTO `COMP10900_M4`.`friends` (`friend1ID` , `friend2ID` ,`isAccepted`) VALUES ('" . $userid[0] . "', '" . $friendid . "', '0')";
 }
elseif($operation == 1)
 {//DELETE FROM FRIENDS

 $request="DELETE FROM `COMP10900_M4`.`friends` WHERE (`friends`.`friend1ID`=" . $userid[0] . " AND `friends`.`friend2ID`=" . $friendid . " ) OR (`friends`.`friend2ID`=" . $userid[0] . " AND `friends`.`friend1ID`=" . $friendid . ")";

 }
elseif($operation == "2")
 {//ACCEPT REQUEST
 
$request="UPDATE `COMP10900_M4`.`friends` SET `isAccepted` = '1' WHERE `friends`.`friend1ID` =" . $friendid . " AND `friends`.`friend2ID` =" . $userid[0];
 
}
else echo "Something bad happened!";

$result = mysql_query($request, $db->connection);

if(!$result) echo "Something bad happened.";
else echo "Updated!";



include("footer.php");

?>
