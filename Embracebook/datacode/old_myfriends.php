<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.descriptiontext {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
	padding-left: 5px;
	margin-right: 10px;
}
.descriptionbox ul {
	list-style-type: none;
}
.descriptionbox {
	float: right;
}
.friend {
}
-->
</style>
</head>

<body>

<?php
include("session.php");
include("database.php");
include("header.php");

$con = mysql_connect("ramen.cs.man.ac.uk", "COMP10900_M4", "wN1jYkmZ9Yu9i50g")
    or die('Could not connect: ' . mysql_error());
mysql_select_db("COMP10900_M4", $con)
    or die('Could not select database');

//Get my ID for selecting friends
$getuserid = mysql_query("SELECT `userID` FROM `user`WHERE
	`email` ='" . $_SESSION['email'] . "' LIMIT 0, 100");

$myid = mysql_fetch_row($getuserid);

//TRHOW AN EXCEPTION IF NOT LOGGED IN!!!

//Get a list of friends
$result = mysql_query("SELECT lastname, firstname, userID, city, email, avatarurl
FROM `user` 
JOIN friends ON ( user.userID = friends.friend1ID && friend2ID =$myid[0] ) || ( user.userID = friends.friend2ID && friend1ID =$myid[0] ) 
WHERE friend1ID = '$myid[0]'
OR friend2ID = '$myid[0]'
LIMIT 0 , 50 ");


while($row = mysql_fetch_array($result))
{
echo "<p><div class=friend>
<img src=userimages/" . $row['avatarurl'] . " alt=profileimage width=80 height=120>
<div class=descriptionbox>
  <ul>
    <li><span class=descriptiontext>Name</span><A href=viewprofile.php?profileid=";
echo $row['userID'];
echo "> ";
echo $row['lastname'] . " " . $row['firstname'];
echo "</A></li>
    <li><span class=descriptiontext>E-mail</span>";
echo $row['email'];
echo "</li>
    <li><span class=descriptiontext>City</span>";
echo $row['city'];
echo "</li></ul></div></div></p>";

}

?>
<?php include("footer.php"); ?>


</body>
</html>
