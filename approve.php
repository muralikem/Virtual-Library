<?php

session_start();
if(!isset($_SESSION['username']))
{ echo "<h1>Access Denied</h1>"; exit(); }

?>


<?php

$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "murali=1256";
$mysql_database = "library";
$prefix = "";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
$con=mysql_select_db($mysql_database, $bd) or die("Could not select database");

$i=$_GET['id'];
$role=$_GET['role'];

if($role==4) {

	$query = mysql_query("SELECT * FROM Pending_resources where ID=" . $i . ";");
	$row = mysql_fetch_array($query,MYSQL_ASSOC);
	
	$id = $row['ID'];
	$user = $row['Username'];
	$name = $row['Name'];
	$link = $row['Link'];
	$desc = $row['Description'];
	$status = 0;

	mysql_query("INSERT INTO Research_papers VALUES('$id', '$user', '$name', '$link', '$desc', '$status');");
	mysql_query("DELETE FROM Pending_resources WHERE ID=" . $id . ";");
	echo "<script> window.location='pending_resources.php'; </script>";
}

else {

if($role==2)
	$query = mysql_query("SELECT * FROM Pending_authors where ID=" . $i . ";");
else
	$query = mysql_query("SELECT * FROM Pending_managers where ID=" . $i . ";");

$row = mysql_fetch_array($query,MYSQL_ASSOC);
$id = $row['ID'];
$fname = $row['F_Name'];
$lname = $row['L_Name'];
$email = $row['Email'];
$user = $row['Username'];
$pwd = $row['Password'];
$mob = $row['Mobile_No'];

if($role==2) {
	mysql_query("INSERT INTO Authors VALUES('$id','$fname','$lname','$email','$user','$pwd','$mob');");
	mysql_query("DELETE FROM Pending_authors WHERE ID=" . $id . ";");
	echo "<script> window.location='pending_authors.php'; </script>";
}
else {
	mysql_query("INSERT INTO Managers VALUES('$id','$fname','$lname','$email','$user','$pwd','$mob');");
	mysql_query("DELETE FROM Pending_managers WHERE ID=" . $id . ";");
	echo "<script> window.location='pending_managers.php'; </script>";
}

}

?>