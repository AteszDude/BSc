<?php

include("vector.php");

function createtables($db)
{


return; //THIS THINGS ARE DEPRECATED USE PHPMYADMIN
	$v = new Vector();
	
	$v->push_back("DROP TABLE IF EXISTS user");
	
	$v->push_back("CREATE TABLE user(
		userID int NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(userID),
		email VARCHAR(40),
		password VARCHAR(32),
		firstname VARCHAR(20),
		lastname VARCHAR(25),
		born DATE,
		addressline1 VARCHAR(30),
		addressline2 VARCHAR(30),
		city VARCHAR(20),
		postcode VARCHAR(8),
		avatarID int
		)");
		
	$v->push_back("DROP TABLE IF EXISTS userAvatar");
		
	$v->push_back("CREATE TABLE userAvatar(
		avatarID int NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(avatarID),
		location VARCHAR(256),
		width int,
		height int
		)");
	
	$v->push_back("DROP TABLE IF EXISTS message");
	
	$v->push_back("CREATE TABLE message(
		messageID int NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(messageID),
		recipientID int,
		senderID int,
		isRead bool,
		subject VARCHAR(30),
		body TEXT
		)");
	
	$v->push_back("DROP TABLE IF EXISTS MessageWall");
		
	$v->push_back("CREATE TABLE MessageWall(
		msgNo int NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(msgNo),
		userID int,
		date TIMESTAMP,
		body TEXT
		)");

	$v->push_back("DROP TABLE IF EXISTS friends");
		
	$v->push_back("CREATE TABLE friends(
		friend1ID int,
		friend2ID int
		)");

	$v->push_back("DROP TABLE IF EXISTS groupMember");
		
	$v->push_back("CREATE TABLE groupMember(
		memberID int,
		groupID int
		)");

	$v->push_back("DROP TABLE IF EXISTS group");
		
	$v->push_back("CREATE TABLE group(
		groupID int NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(groupID),
		name VARCHAR(30),
		category int,
		description TEXT
		)");

	$v->push_back("DROP TABLE IF EXISTS userData");
		
	$v->push_back("CREATE TABLE userData(
		userID int NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(userID),
		orientation int,
		religion int,
		children int,
		films int,
		books int
		)");

	
	for($i=0;$i<$v->size();$i++)
	{
		if(!mysql_query($v->liste[$i], $db->connection))
			throw new Exception("There was an error executing:<br />" . $v->liste[$i] . "<br />" . mysql_error());
	}
}

?>
