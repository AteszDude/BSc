<?php

include("database.php");
include("session.php");
include("searcharray.php");


	$title = "Registering";
	include("header.php");

try
{

	if(!isset($_POST['sex']) || $_POST['sex'] == 3)
		throw new Exception("No gender entered.");
	if(!isset($_POST['sexuality']) || $_POST['sexuality'] == 3)
		throw new Exception("No sexuality entered.");
	if(!isset($_POST['religion']) || $_POST['religion'] == 0)
		throw new Exception("No religion entered.");
	if(!isset($_POST['books']) || $_POST['books'] == 0)
		throw new Exception("No books entered.");
	if(!isset($_POST['films']) || $_POST['films'] == 0)
		throw new Exception("No films entered.");
	if(!isset($_POST['animals']) || $_POST['animals'] == 0)
		throw new Exception("No animals entered.");
	if(!isset($_POST['music']) || $_POST['music'] == 0)
		throw new Exception("No music entered.");

	$sex = $_POST['sex'];
	$sexuality = $_POST['sexuality'];

	$orientation = 3 * $sex + $sexuality;

$getuserid = mysql_query("SELECT `userID` FROM `user`WHERE `email` ='" . $_SESSION['email'] . "' LIMIT 0, 1");
$userid = mysql_fetch_row($getuserid);

$query = "INSERT INTO `COMP10900_M4`.`userData` (
`userID` ,
`orientation` ,
`religion` ,
`children` ,
`books` ,
`films` ,
`animals` ,
`music`
)
VALUES (
'" . $userid[0] . "', '" . $orientation . "', '" . $_POST['religion'] . "', '" . $_POST['children'] . "',
'" . $_POST['books'] . "', '" . $_POST['films'] . "', '" . $_POST['animals'] . "',
'" . $_POST['music'] . "')";

$result = mysql_query($query, $db->connection);

if($result) echo "You have successfully registered!";

}
catch(Exception $e)
{

	echo "    <h2>Error registering</h2>";
	echo "    <p>" . $e->getMessage() . "</p>";

}


?>
