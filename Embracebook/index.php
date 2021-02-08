<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

include("database.php");
include("session.php");

function displaygroupmemberlink($s)
{
	if(isprivilegeduser($s))
	{
		echo "<a href=\"http://www2.cs.man.ac.uk/~";
		switch($s->email)
		{
			case "loachs7@cs.man.ac.uk": echo "loachs7"; break;
			case "meads7@cs.man.ac.uk": echo "meads7"; break;
			case "myersdb7@cs.man.ac.uk": echo "myersdb7"; break;
			case "tordag7@cs.man.ac.uk": echo "tordag7"; break;
		}
		echo "\">Users homepage</a>";
	}
}

// check if the user is logged in, if not give them a login screen.
if($s->loggedin)
{
	$title = "Welcome to Embracebook! ";
	include("header.php");
	
	?>
	<p>You are logged in as <?php echo $s->email; ?>. <?php displaygroupmemberlink($s) ?></p>
	<p><a href="logout.php">logout</a></p>
	<p>The system administrator can output here important messages.</p>
	<!--<p><?php/* printusertable($db); */?></p>
	<p><a href="maketables.php">re-create the database tables</a>.</p> DONT NEED-->
	<?php

	include("footer.php");
}
else
{
	$title = "Welcome to Embracebook! ";
	include("header.php");
	?>
    
    <h3>You need to log in.</h3>
	<p>Alternatively click to <a href="register.php">register</a></p><!-- or even <a href="maketables.php">re-create the database tables</a>.</p>
	<p><?php printusertable($db); ?></p>-->
    
	<?php
	
	include("footer.php");
}
?>
