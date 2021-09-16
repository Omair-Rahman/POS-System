<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "posDB";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn)
		die("Connection failed: " . mysqli_connect_error());

	// sql to create table
	$sql = "CREATE TABLE user
			(
			UserName VARCHAR(20) NOT NULL PRIMARY KEY,
			Password VARCHAR(15) NOT NULL,
			Email VARCHAR(50) NOT NULL,
			Phone VARCHAR (10) NOT NULL,
			Address VARCHAR(100) NOT NULL,
			DOB VARCHAR(15) NOT NULL,
			Gender VARCHAR(10) NOT NULL
			)";
	$sql = "CREATE TABLE auth
			(
			UserName VARCHAR(20) NOT NULL PRIMARY KEY,
			active VARCHAR(10) NOT NULL
			)";
	$sql = "CREATE TABLE product
			(
			ID INT(10) UNSIGNED NOT NULL PRIMARY KEY,
			Name VARCHAR(20) NOT NULL,
			Img BLOB,
			Number INT UNSIGNED NOT NULL,
			tPrice INT UNSIGNED NOT NULL
			)";
	$sql = "CREATE TABLE purchase
			(
			ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
			pID INT(10) UNSIGNED NOT NULL,
			pName VARCHAR(20) NOT NULL,
			pImg BLOB,
			pQuantity INT UNSIGNED NOT NULL,
			price INT UNSIGNED NOT NULL
			)";
	$sql = "CREATE TABLE sales
					(
			    ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
			    sID INT(10) UNSIGNED NOT NULL,
			    sName VARCHAR(20) NOT NULL,
			    sQuantity INT UNSIGNED NOT NULL,
			    sPrice INT UNSIGNED NOT NULL
					)";

	if (mysqli_query($conn, $sql)) {
		echo "Tables created successfully";
	}
	else {
		echo "Error creating tables: " . mysqli_error($conn);
	}

	mysqli_close($conn);
?>
