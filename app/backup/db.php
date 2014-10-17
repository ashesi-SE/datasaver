<?php 
	DEFINE('DBUSER', 'csashesi_ma15');
	DEFINE('DBPW', 'db!bed26a');
	DEFINE('DBHOST', 'localhost');
	DEFINE('DBNAME', 'csashesi_mohammed-abdulai');

	$conn = mysql_connect(DBHOST, DBUSER, DBPW);

	if (!$conn) {
		die('Could not connect: '. myql_error());
	}

	$db = @mysql_select_db(DBNAME, $conn) or die(mysql_error());

	$username = $_POST[username];
	$fname = $_POST[firstname];
	$lname = $_POST[lastname];
	$email = $_POST[email];
	$phone = $_POST[phone];
	$pword = md5($_POST[password]);

	$query = "INSERT INTO data_saver_users(username, firstname, lastname, email, phone, password) VALUES('$username', '$fname', '$lname', '$email', '$phone', '$pword')";


	if(!mysql_query($query, $conn)){
		die('Error: ' . mysql_error());
	}

	echo "1 record added";
	mysql_close($conn);
 ?>