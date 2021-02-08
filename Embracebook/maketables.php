<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include("database.php");
include("session.php");

if(isprivilegeduser($s) || (isset($_GET['password']) && md5($_GET['password']) == "5e8667a439c68f5145dd2fcbecf02209"))
{
	try
	{
		createtables($db);
		$s->logout();
		$title = "Tables succesfully (re-)created";
		include("header.php");
		echo '<p>The tables were succesfully (re-)created. <a href="index.php">Click here to go back</a></p>';
		include("footer.php");
	}
	catch(Exception $e)
	{
		$title = "Error creating tables";
		include("header.php");
		echo "<p>" . $e->getMessage() . "</p>";
		include("footer.php");
	}
}
else
{
	$title = "Re-create tables";
?>
<?php include("header.php"); ?>
	  <p>Please login as a privileged to re-create the tables:</p>
	  <p>
		<div class="loginbox">
		  <form method="post" action="dologin.php?goto=maketables.php">
			Email address:<br />
			<input name="email"><br />
	
			Password:<br />
			<input name="password" type="password"><br />
	
			<input type="submit" value="login">
		  </form>
		</div>
	  </p>
	<?php include("footer.php"); ?>
<?php 
}
?>
