<?php

include("database.php");
include("session.php");
include("searcharray.php");


	$title = "Search";
	include("header.php");

echo "Find your match today! Or find new friends! Or just abuse someone!<br><br>";


?>

<form name="searchdata" action="searchmate.php" method="POST">
Gender:<br>
<select id="gender" name="gender">
  <option value=2>No Preference</option>
  <option value=0>Male</option>
  <option value=1>Female</option>
</select>

<?php
//Do the others based on this

//Religion
echo "<br>Religion:<br> <select id=\"religion\" name=\"religion\"> <option value=0>No Preference</option>";
	for($i = 1; $i < sizeof($religion) + 1;$i++)
		echo "<option value=" . $i . ">" . $religion[$i] . "</option>";
	echo "</select>";

//Children
echo "<br>Children:<br> <select id=\"children\" name=\"children\"> <option value=0>No Preference</option>";
	for($i = 1; $i < sizeof($children) + 1;$i++)
		echo "<option value=" . $i . ">" . $children[$i] . "</option>";
	echo "</select>";

//Books
echo "<br>Books:<br> <select id=\"books\" name=\"books\"> <option value=0>No Preference</option>";
	for($i = 1; $i < sizeof($books) + 1;$i++)
		echo "<option value=" . $i . ">" . $books[$i] . "</option>";
	echo "</select>";

//Films
echo "<br>Films:<br> <select id=\"films\" name=\"films\"> <option value=0>No Preference</option>";
	for($i = 1; $i < sizeof($films) + 1;$i++)
		echo "<option value=" . $i . ">" . $films[$i] . "</option>";
	echo "</select>";

//Animals
echo "<br>Animals:<br> <select id=\"animals\" name=\"animals\"> <option value=0>No Preference</option>";
	for($i = 1; $i < sizeof($animals) + 1;$i++)
		echo "<option value=" . $i . ">" . $animals[$i] . "</option>";
	echo "</select>";

//Music
echo "<br>Music:<br> <select id=\"music\" name=\"music\"> <option value=0>No Preference</option>";
	for($i = 1; $i < sizeof($music) + 1;$i++)
		echo "<option value=" . $i . ">" . $music[$i] . "</option>";
	echo "</select>";
?>
<br>
<input type="submit" value="submit" name="submit">
</form>

<?php
include("footer.php");

?>


