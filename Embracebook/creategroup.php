<?php


include("database.php");
include("session.php");
include("grouparray.php");

	$title = "Create Group";
	include("header.php");

try
{

	if(!isset($_POST['gname']) || $_POST['gname'] == "")
		throw new Exception("No name entered.");
	if(!isset($_POST['gcategory']) || $_POST['gcategory'] == sizeof($groupcategory))
		throw new Exception("No category entered.");
	if(!isset($_POST['gdescr']) || $_POST['gdescr'] == "")
		throw new Exception("No description entered.");


	$gname = $_POST['gname'];
	$gcategory = $_POST['gcategory'];
	$gdescr = $_POST['gdescr'];

	// make the variables safe to use in queries
	$gname = mysql_real_escape_string($gname);
	$gdescr = mysql_real_escape_string($gdescr);


	//Is the name exist?

	$checkq = "SELECT * FROM `COMP10900_M4`.`group` WHERE `name`='" . $gname . "'";
	$isexist = mysql_query(checkq, $db->connection);
	if(mysql_num_rows($isexist) != 0)
		throw new Exception("Name in use!");

	$query = "INSERT INTO `COMP10900_M4`.`group` (
`groupID` ,
`name` ,
`category` ,
`description`
)
VALUES (
NULL , '" . $gname ."', '" . $gcategory . "', '" . $gdescr . "'
)";

	$result = mysql_query($query);
	if($result) echo "Group created!";

//Now insert the user into the group

//user id
$getuserid = mysql_query("SELECT `userID` FROM `user`WHERE `email` ='" . $_SESSION['email'] . "' LIMIT 0, 1");
$userid = mysql_fetch_row($getuserid);

//group id
$getid = mysql_query("SELECT `groupID` FROM `group`WHERE `name` ='" . $gname . "' LIMIT 0, 1");
$groupid = mysql_fetch_row($getid);

	$query = "INSERT INTO `COMP10900_M4`.`groupMember` (
`memberID` ,
`groupID`
)
VALUES (
'" . $userid[0] ."', '" . $groupid[0] ."'
)";

	$result = mysql_query($query);
	if($result) echo "You became a member!";

}
catch(Exception $e)
{

	echo "    <h2>Error creating</h2>";
	echo "    <p>" . $e->getMessage() . "</p>";

}



$include("footer.php");






?>
