<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include("database.php");
include("session.php");

function verifylogin($email, $password, $db, $s)
{
	$query = "SELECT * FROM user WHERE email = '$email'";
	$result = mysql_query($query, $db->connection);

	if(!$result)
		throw new Exception(mysql_error());

	if(mysql_num_rows($result) == 0)
		throw new Exception("User not found.");
    
	$userdata = mysql_fetch_array($result, MYSQL_ASSOC);
    
	if(md5($password . "76t245bo87a") != $userdata['password'])
		throw new Exception("Passwords didn't match.");
    	
	// Login successful, set session information
	$s->login($userdata);
}

try
{
	if(!isset($_POST['email']) || $_POST['email'] == "")
		throw new Exception("No email address entered.");
		
	if(!isset($_POST['password']) || $_POST['password'] == "")
		throw new Exception("No password entered.");
	
	verifylogin($_POST['email'], $_POST['password'], $db, $s);
}
catch(Exception $e)
{
	$title = "Error logging in";
	
	include("header.php");
	echo "<p>" . $e->getMessage() . "</p>";
	include("footer.php");
	
	die();
}

if(!isset($_GET['goto']))
	header('Location: index.php');
else
	header('Location: ' . $_GET['goto']);
?>
