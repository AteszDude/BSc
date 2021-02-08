<?php

//THIS PHP FILE DELETES/ADDS/APPROVES THE FRIENDS

include("database.php");
include("session.php");

	$title = "Group membership";
	include("header.php");

	if(!isset($_GET['groupid']) || $_GET['groupid'] == "")
		{
		echo "Something is bad with the group";
		return;
		}
	if(!isset($_GET['operation']) || $_GET['operation'] == "")
		{
		echo "Something is bad with the requested operation";
		return;
		}


//Get the current users ID
$getuserid = mysql_query("SELECT `userID` FROM `user` WHERE `email` ='" . $_SESSION['email'] . "' LIMIT 0, 100", $db->connection);
$userid = mysql_fetch_row($getuserid);

$groupid = $_GET['groupid'];//The group which should altered
$operation = $_GET['operation'];//Operation: 0 - ADD, 1 - DELETE

$request="";

//What shall we do?
if($operation == 0)//Insert
	$request = "INSERT INTO `COMP10900_M4`.`groupMember` (`memberID` , `groupID`) VALUES ('" . $userid[0] . "', '" . $groupid . "')";
elseif($operation == 1)//Delete
	$request = "DELETE FROM `COMP10900_M4`.`groupMember` WHERE `groupMember`.`memberID`=" . $userid[0] . " AND `groupMember`.`groupID`=" . $groupid;
else echo "Wrong request";


$result = mysql_query($request, $db->connection);

if(!$result) echo "Something bad has happened!";
else echo "Request completed!";

?>
