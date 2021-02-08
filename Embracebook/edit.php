<?php

include("database.php");
include("session.php");
include("searcharray.php");
include("grouparray.php");


	$title = "Edit";
	include("header.php");

echo "Here you can edit your matchfinding details. <br>";

//UPLOAD NEW AVATAR

 echo "Upload new Avatar:<br>";

 echo "<form enctype=\"multipart/form-data\" action=\"upload.php\" method=\"POST\">
  <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"100000\" /><br>
  Choose a file to upload: <input name=\"uploadedfile\" type=\"file\" /><br />
  <input type=\"submit\" value=\"Upload File\" />
 </form><br>";


//Alter matchmaking data

$getuserid = mysql_query("SELECT `userID` FROM `user`WHERE `email` ='" . $_SESSION['email'] . "' LIMIT 0, 1");
$userid = mysql_fetch_row($getuserid);


$getuserdata = "SELECT * FROM `userData` WHERE `userID`=" . $userid[0];
  $result = mysql_query($getuserdata, $db->connection);

//If we havent registered
if(mysql_num_rows($result) == 0)
{
	echo "You haven't registered with matchmaking. Please do it now:<br>";

//REGISTERING INPUT

?><form name="insertdata" action="createuserdata.php" method="POST">
Sex:<br>
<select id="sex" name="sex">
  <option value=3>Please Select</option>
  <option value=0>Male</option>
  <option value=1>Female</option>
  <option value=2>Both</option>
</select><br>

Sexuality<br>
<select id="sexuality" name="sexuality">
  <option value=3>Please Select</option>
  <option value=0>Male</option>
  <option value=1>Female</option>
  <option value=2>Both</option>
</select>

<?php


//Religion
echo "<br>Religion:<br> <select id=\"religion\" name=\"religion\"> <option value=0>Please Select</option>";
	for($i = 1; $i < sizeof($religion) + 1;$i++)
		echo "<option value=" . $i . ">" . $religion[$i] . "</option>";
	echo "</select>";

//Children
echo "<br>Children:<br> <select id=\"children\" name=\"children\"> <option value=0>Please Select</option>";
	for($i = 1; $i < sizeof($children) + 1;$i++)
		echo "<option value=" . $i . ">" . $children[$i] . "</option>";
	echo "</select>";

//Books
echo "<br>Books:<br> <select id=\"books\" name=\"books\"> <option value=0>Please Select</option>";
	for($i = 1; $i < sizeof($books) + 1;$i++)
		echo "<option value=" . $i . ">" . $books[$i] . "</option>";
	echo "</select>";

//Films
echo "<br>Films:<br> <select id=\"films\" name=\"films\"> <option value=0>Please Select</option>";
	for($i = 1; $i < sizeof($films) + 1;$i++)
		echo "<option value=" . $i . ">" . $films[$i] . "</option>";
	echo "</select>";

//Animals
echo "<br>Animals:<br> <select id=\"animals\" name=\"animals\"> <option value=0>Please Select</option>";
	for($i = 1; $i < sizeof($animals) + 1;$i++)
		echo "<option value=" . $i . ">" . $animals[$i] . "</option>";
	echo "</select>";

//Music
echo "<br>Music:<br> <select id=\"music\" name=\"music\"> <option value=0>Please Select</option>";
	for($i = 1; $i < sizeof($music) + 1;$i++)
		echo "<option value=" . $i . ">" . $music[$i] . "</option>";
	echo "</select>";
?>
<br>
<input type="submit" value="Register!" name="submit">
</form>

<?php
//END OF REGISTERING


}//register
else
{
//list current things
$matchdata = mysql_fetch_array($result, MYSQL_ASSOC);

    echo "Sex: " . $sex[$matchdata["orientation"]] . "<br>";
    echo "Sexuality: " . $sexuality[$matchdata["orientation"]] . "<br>";
    echo "Religion: " . $religion[$matchdata["religion"]] . "<br>";
    echo "Children: " . $children[$matchdata["children"]] . "<br>";
    echo "Books: " . $books[$matchdata["books"]] . "<br>";
    echo "Films: " . $films[$matchdata["films"]] . "<br>";
    echo "Animals: " . $animals[$matchdata["animals"]] . "<br>";
    echo "Music: " . $music[$matchdata["music"]] . "<br>";


//Now list the modifying things

?><form name="modifydata" action="alterdata.php" method="POST"><?php

//Religion
echo "<br>Religion:<br> <select id=\"religion\" name=\"religion\"> <option value=0>Don't Modify</option>";
	for($i = 1; $i < sizeof($religion) + 1;$i++)
		echo "<option value=" . $i . ">" . $religion[$i] . "</option>";
	echo "</select>";

//Children
echo "<br>Children:<br> <select id=\"children\" name=\"children\"> <option value=0>Don't Modify</option>";
	for($i = 1; $i < sizeof($children) + 1;$i++)
		echo "<option value=" . $i . ">" . $children[$i] . "</option>";
	echo "</select>";

//Books
echo "<br>Books:<br> <select id=\"books\" name=\"books\"> <option value=0>Don't Modify</option>";
	for($i = 1; $i < sizeof($books) + 1;$i++)
		echo "<option value=" . $i . ">" . $books[$i] . "</option>";
	echo "</select>";

//Films
echo "<br>Films:<br> <select id=\"films\" name=\"films\"> <option value=0>Don't Modify</option>";
	for($i = 1; $i < sizeof($films) + 1;$i++)
		echo "<option value=" . $i . ">" . $films[$i] . "</option>";
	echo "</select>";

//Animals
echo "<br>Animals:<br> <select id=\"animals\" name=\"animals\"> <option value=0>Don't Modify</option>";
	for($i = 1; $i < sizeof($animals) + 1;$i++)
		echo "<option value=" . $i . ">" . $animals[$i] . "</option>";
	echo "</select>";

//Music
echo "<br>Music:<br> <select id=\"music\" name=\"music\"> <option value=0>Don't Modify</option>";
	for($i = 1; $i < sizeof($music) + 1;$i++)
		echo "<option value=" . $i . ">" . $music[$i] . "</option>";
	echo "</select>";
?>
<br>
<input type="submit" value="Modify" name="submit">
</form>

<br><br>
<?php
//END OF MODIFYING
}

//CREATE GROUP

echo "Create a group:<br>";

?><form name="creategroup" action="creategroup.php" method="POST"><?php

echo "<br>Group name: <input name=\"gname\" />";

//Category
echo "<br>Category: <select id=\"gcategory\" name=\"gcategory\"> <option value=" . sizeof($groupcategory) . ">Please Select</option>";
	for($i = 0; $i < sizeof($groupcategory);$i++)
		echo "<option value=" . $i  . ">" . $groupcategory[$i] . "</option>";
	echo "</select>";

echo "<br>Description <input name=\"gdescr\" />";

?>
<br>
<input type="submit" value="Register!" name="submit">
</form>

<?php


include("footer.php");

?>
