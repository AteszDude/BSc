<?php

class database
{
	var $connection;

	function database()
	{
		$this->connection = mysql_connect("ramen.cs.man.ac.uk", "COMP10900_M4", "wN1jYkmZ9Yu9i50g")
			or die('Could not connect: ' . mysql_error());
		mysql_select_db("COMP10900_M4", $this->connection)
			or die('Could not select database');
	}
}
$db = new database();

//
// Helper functions
//

include("createtables.php");

function checkexists($email, $db)
{
	$query = "SELECT * FROM user WHERE email='$email'";
	$result = mysql_query($query, $db->connection);
	if(mysql_num_rows($result) != 0)
		return true;
	return false;
}

function printusertable($db)
{
	$query = 'SELECT * FROM user';
	$result = mysql_query($query, $db->connection);
	if(!$result)
		throw new Exception(mysql_error());
	echo "		<table>\n";
	if(mysql_num_rows($result) == 0)
	{
		echo "			<tr>\n				<td>No data to display.</td>\n			</tr>\n";
	}
	else
	{
		echo "			<tr>\n";
		echo "				<td>id</td>\n";
		echo "				<td>email</td>\n";
		echo "				<td>password</td>\n";
		echo "				<td>firstname</td>\n";
		echo "				<td>lastname</td>\n";
		echo "				<td>born</td>\n";
		echo "				<td>addressline1</td>\n";
		echo "				<td>addressline2</td>\n";
		echo "				<td>city</td>\n";
		echo "				<td>postcode</td>\n";
		echo "				<td>avatarID</td>\n";
		echo "				<td>Skype</td>\n";
		echo "				<td>MSN</td>\n";
		echo "			</tr>\n";
		while($line = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			echo "			<tr>\n";
			foreach($line as $col_value)
				echo "				<td>$col_value</td>\n";
			echo "			</tr>\n";
		}
	}
	echo "		</table>\n";
}

?>
