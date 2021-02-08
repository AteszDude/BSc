<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include("database.php");
include("session.php");

$s->logout();

header('Location: index.php');
?>
