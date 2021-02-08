<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" id="embracebook">
<head>
<title>
<?php
    if(isset($title))
      echo $title;
    else
      echo "Untitled";
    ?>&nbsp;| Embracebook</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="common.css" type="text/css" media="all" />
<link rel="stylesheet" href="welcome.css" type="text/css" />
<link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body class="welcome">
<div id="book">
<div id="sidebar"><a href="index.php" class="go_home" style="background-image:url(images/embracebook_logo.gif)"> </a>
	<div id="sidebar_content">
	<?php
	if(!$s->loggedin)
	{
	?>
		<div id="squicklogin">
			<form method="post" action="dologin.php" id="loginform">
				<label><span>Email:</span><br />
				<input type="text" class="inputtext" name="email" value="" id="email" size="20" />
				</label>
				<br />
				<label><span>Password:</span><br />
				<input class="inputtext" type="password" name="password" id="pass" size="20" />
				</label>
				<label class="persistent">
				<input type="checkbox" class="inputcheckbox" id="persistent" name="persistent" value="1" />
				<span>Remember me</span></label>
				<input type="submit" value="Login" name="doquicklogin" id="doquicklogin" onclick="this.disabled=true; this.form.submit();" class="inputsubmit" />
			</form>
			<a href="reset.php">Forgot Password?</a></div>
	</div>
	<?php
	}
	else
	{
	?>
	<div id="squicklogin">
		Welcome to Embracebook, <?php echo $s->firstname; ?>!
	</div>
	</div>
	<?php
	}
	?>
</div>
<div id="widebar" class="clearfix">
<?php
if(!$s->loggedin)
{
?>
	<div id="navigator">
		<ul class="secondary_set" id="nav_unused_2">
			<li><a href="blank/sitetour.html" target=_blank>Site tour</a></li>
			<li><a href="login.php">Login</a></li>
		</ul>
</div>
<?php
}
else
{

$con = mysql_connect("ramen.cs.man.ac.uk", "COMP10900_M4", "wN1jYkmZ9Yu9i50g")
    or die('Could not connect: ' . mysql_error());
$getuserid = mysql_query("SELECT `userID` FROM `user` WHERE `email` ='" . $_SESSION['email'] . "' LIMIT 0, 4", $con);
$userid = mysql_fetch_row($getuserid);

?>
<div id="navigator">
	<ul class="main_set" id="nav_unused_1">
		<li class="main_set_first">
			<a href="viewprofile.php?profileid=<?php echo $userid[0]?>" class="profile_link">Profile</a>
			<a href="edit.php" class="edit_link">edit</a>
		</li>
		<li>
			<a href="myfriends.php">Friends</a>
		</li>
		<li>
			<a href="findmatch.php">Search</a>
		</li>
		<li>
			<a href="messagebox.php">Messages</a>
		</li>
		<li>
			<a href="wall.php">Wall</a>
		</li>
	</ul>
	<ul class="secondary_set" id="nav_unused_2">
		<li><a href="index.php">home</a></li>
		<li><a href="logout.php">logout</a></li>
	</ul>
</div>
<?php
}
?>
<div id="page_body" class="pagebody welcome">
<div id="content_shadow">
<div id="content" class="clearfix">
<div id="content_frame">
<div id="content_stage" class="clearfix">
<div class="main_column">
<div id="welcome">
<h2>
	<?php
    if(isset($title))
      echo $title;
    else
      echo "First year group project - Page not titled";
    ?>
</h2>

