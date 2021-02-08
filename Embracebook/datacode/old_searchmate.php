<?php

include("database.php");
include("session.php");
include("searcharray.php");

	$title = "Matchfinding...";
	include("header.php");

//We need to extend it with the required parameters
$searchquery = "SELECT `firstname` , `lastname` , `city` , `userID` , `orientation` , `religion` , `children` , `books` , `films` , `animals` , `music`
FROM `userData`
JOIN user
USING ( `userID` )
WHERE ";

//CONSTRUCT SEXUALITY THINGS;)


$lookingfor = $_POST['gender'];

echo "Looking" . $lookingfor . " <br>";

if($lookingfor != 0)//IF WE DONT INTERESTED IN GENRES!
{

$lookingfor = $lookingfor-1;

echo "new " . $lookingfor;

$getuserid = mysql_query("SELECT `userID` FROM `user` WHERE `email` ='" . $_SESSION['email'] . "' LIMIT 0, 1");
$userid = mysql_fetch_row($getuserid);


//Get the users sex*****
$getsex = mysql_query("SELECT `orientation` FROM `userData` WHERE `userID`=$userid[0] LIMIT 0,1");
$orientation = mysql_fetch_row($getsex);

if($orientation[0] <= 2) $usersex = 0;
elseif($orientation[0] <= 5) $usersex = 1;
else $usersex = 2;

//Deafault
$genderquery = " `orientation`>=0 ";


//Make the genders
switch($lookingfor)
	{
	case 0://looking for a MALE
		if($usersex == 0)$genderquery=" (`orientation`=0 OR `orientation`=2) ";
		elseif($usersex == 1)$genderquery=" (`orientation`=1 OR `orientation`=2) ";
		else $genderquery=" `orientation`=2 ";
	break;
	case 1://looking for a FEMMALE
		if($usersex == 0)$genderquery=" (`orientation`=3 OR `orientation`=5) ";
		elseif($usersex == 1)$genderquery=" (`orientation`=4 OR `orientation`=5) ";
		else $genderquery=" `orientation`=5 ";
	break;
	case 2://looking for BOTH
		if($usersex == 0)$genderquery=" (`orientation`=0 OR `orientation`=2 OR `orientation`=3 OR `orientation`=5 OR `orientation`=6 OR `orientation`=8) ";
		elseif($usersex == 1)$genderquery=" (`orientation`=1 OR `orientation`=2 OR `orientation`=4 OR `orientation`=5 OR `orientation`=7 OR `orientation`=8) ";
		else $genderquery=" (`orientation`=2 OR `orientation`=5 OR `orientation`=6 OR `orientation`=7 OR `orientation`=8) ";
		break;
	default: echo "Invalid arguments!";
	}
$searchquery = $searchquery . $genderquery;

}

else //IF WE DONT INTERESTED IN GENRES
{
$searchquery = $searchquery . " `orientation`>=0 ";
}

//GENDER*****

//Religion

  if(!(!isset($_POST['religion']) || $_POST['religion'] == "" || $_POST['religion'] == 0))
	{
	$newcriteria = " AND `religion`=" . $_POST['religion'] . " ";
	$searchquery = $searchquery . $newcriteria;
	}//end of religion query

//Children

  if(!(!isset($_POST['children']) || $_POST['children'] == "" || $_POST['children'] == 0))
	{
	$newcriteria = " AND `children`=" . $_POST['children'] . " ";
	$searchquery = $searchquery . $newcriteria;
	}//end of religion query

//Books

  if(!(!isset($_POST['books']) || $_POST['books'] == "" || $_POST['books'] == 0))
	{
	$newcriteria = " AND `books`=" . $_POST['books'] . " ";
	$searchquery = $searchquery . $newcriteria;
	}//end of religion query

//Films

  if(!(!isset($_POST['films']) || $_POST['films'] == "" || $_POST['films'] == 0))
	{
	$newcriteria = " AND `films`=" . $_POST['films'] . " ";
	$searchquery = $searchquery . $newcriteria;
	}//end of religion query

//Animals

  if(!(!isset($_POST['animals']) || $_POST['animals'] == "" || $_POST['animals'] == 0))
	{
	$newcriteria = " AND `animals`=" . $_POST['animals'] . " ";
	$searchquery = $searchquery . $newcriteria;
	}//end of religion query

//Music

  if(!(!isset($_POST['music']) || $_POST['music'] == "" || $_POST['music'] == 0))
	{
	$newcriteria = " AND `music`=" . $_POST['music'] . " ";
	$searchquery = $searchquery . $newcriteria;
	}//end of religion query

//END


//!!!POST QUERY

echo $searchquery;
$result = mysql_query($searchquery, $db->connection);

		while($line = mysql_fetch_array($result))
		{
		echo $line['firstname'] . " " . $line['lastname'] . " " . $line['city'] . " <br>";
		}

include("footer.php");

?>
