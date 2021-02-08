<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include("database.php");
include("session.php");

function register($email, $password, $firstname, $lastname, $city, $addressline1, $addressline2, $postcode, $skype, $msn, $db, $s)
{
	// Make it so we dont even store the password in the database - for extra security :)
	$password = md5($password . "76t245bo87a");
	$query = "INSERT INTO user (email, password, firstname, lastname, born, city, addressline1, addressline2, postcode, Skype, MSN)
		    VALUES('$email', '$password', '$firstname', '$lastname', '1981-01-14' ,'$city', '$addressline1', '$addressline2', '$postcode', '$skype', '$msn')";
	$result = mysql_query($query, $db->connection);
	if(!$result)
		throw new Exception(mysql_error());

	// Add the user data to the session
	$s->login2($email, $firstname, $lastname);

//MAILING************

	//Send a welcome e-mail from asshole TOM:)
	$getrecID = mysql_query(" SELECT `userID`, `firstname`
FROM `user`
WHERE `email` = '$email'
LIMIT 0 , 30 " ,$db->connection);

	$recID = mysql_fetch_row($getrecID);

	//Genereate the message
	$query = "INSERT INTO `COMP10900_M4`.`message` (
`messageID` ,
`recipientID` ,
`senderID` ,
`status` ,
`isRead` ,
`subject` ,
`body`
)
VALUES (
NULL , '$recID[0]', '1', '0', '0', 'Welcome', 'Hello $recID[1]! This is an auto message. Welcome to Embrace book. You can find your perfect match here using the Search button above. Peace: Tom')
";
	//Send the inner mail
	$result = mysql_query($query, $db->connection);
	if(!$result)
		throw new Exception(mysql_error());


//Do NOT send a mail to Tom asshole


//END OF MAILING************
}
try
{
	// validate user inputs
	if(!isset($_POST['email']) || $_POST['email'] == "")
		throw new Exception("No email address entered.");
	if(!isset($_POST['password']) || $_POST['password'] == "")
		throw new Exception("No password entered.");
	if(!isset($_POST['firstname']) || $_POST['firstname'] == "")
		throw new Exception("No first name entered.");
	if(!isset($_POST['lastname']) || $_POST['lastname'] == "")
		throw new Exception("No last name entered.");

	//The basic compulsory extra inputs
	if(!isset($_POST['city']) || $_POST['city'] == "")
		throw new Exception("No City entered.");
	if(!isset($_POST['addressline1']) || $_POST['addressline1'] == "")
		throw new Exception("No address line 1 entered.");
	if(!isset($_POST['addressline2']) || $_POST['addressline2'] == "")
		throw new Exception("No address line 2 entered.");
	if(!isset($_POST['postcode']) || $_POST['postcode'] == "")
		throw new Exception("No post code entered.");

	$email = $_POST['email'];
	$password = $_POST['password'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];

	$city = $_POST['city'];
	$addressline1 = $_POST['addressline1'];
	$addressline2 = $_POST['addressline2'];
	$postcode = $_POST['postcode'];

	// make the variables safe to use in queries
	$email = mysql_real_escape_string($email);
	$password = mysql_real_escape_string($password);
	$firstname = mysql_real_escape_string($firstname);
	$lastname = mysql_real_escape_string($lastname);

	$city = mysql_real_escape_string($city);
	$addressline1 = mysql_real_escape_string($addressline1);
	$addressline2 = mysql_real_escape_string($addressline2);
	$postcode = mysql_real_escape_string($postcode);

	$skype = mysql_real_escape_string($skype);
	$msn = mysql_real_escape_string($msn);

	// check if the email address already exist in the database
	if(checkexists($email, $db))
		throw new Exception("Email address already in use.");

	// add user to the database
	register($email, $password, $firstname, $lastname, $city, $addressline1, $addressline2, $postcode, $skype, $msn, $db, $s);

	header('Location: index.php');
}
catch(Exception $e)
{
	$title = "Register";
	include("header.php");
	echo "    <h2>Error registering</h2>";
	echo "    <p>" . $e->getMessage() . "</p>";
	include("footer.php");
}
?>
