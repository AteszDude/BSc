<?php

include("database.php");
include("session.php");
include("searcharray.php");

	$title = "Modifying";
	include("header.php");

$getuserid = mysql_query("SELECT `userID` FROM `user` WHERE `email` ='" . $_SESSION['email'] . "' LIMIT 0, 4");
$userid = mysql_fetch_row($getuserid);

$request = "UPDATE `COMP10900_M4`.`userData` SET ";//`children` = '2', `animals` = '2' WHERE `userData`.`userID` =4 LIMIT 1";

//Religion

  if(!(!isset($_POST['religion']) || $_POST['religion'] == "" || $_POST['religion'] == 0))
	{
	$newcriteria = "  `religion`=" . $_POST['religion'] . ", ";
	$request = $request . $newcriteria;
	}//end of religion query

//Children

  if(!(!isset($_POST['children']) || $_POST['children'] == "" || $_POST['children'] == 0))
	{
	$newcriteria = " `children`=" . $_POST['children'] . ", ";
	$request = $request . $newcriteria;
	}//end of religion query

//Books

  if(!(!isset($_POST['books']) || $_POST['books'] == "" || $_POST['books'] == 0))
	{
	$newcriteria = " `books`=" . $_POST['books'] . ", ";
	$request = $request . $newcriteria;
	}//end of religion query

//Films

  if(!(!isset($_POST['films']) || $_POST['films'] == "" || $_POST['films'] == 0))
	{
	$newcriteria = " `films`=" . $_POST['films'] . ", ";
	$request = $request . $newcriteria;
	}//end of religion query

//Animals

  if(!(!isset($_POST['animals']) || $_POST['animals'] == "" || $_POST['animals'] == 0))
	{
	$newcriteria = " `animals`=" . $_POST['animals'] . ", ";
	$request = $request . $newcriteria;
	}//end of religion query

//Music

  if(!(!isset($_POST['music']) || $_POST['music'] == "" || $_POST['music'] == 0))
	{
	$newcriteria = " `music`=" . $_POST['music'] . ", ";
	$request = $request . $newcriteria;
	}//end of religion query

//END


//WE DONT NEED THE LAST COMMA!!!
$request = substr($request, 0, -2);

//REQUEST
$request = $request . " WHERE `userData`.`userID`=" . $userid[0] . " LIMIT 1";
  $result = mysql_query($request, $db->connection);

if($result) echo "Your details successfully altered!";
else echo "Something bad happened!";

include("footer.php");

?>