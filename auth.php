<?php
session_start();

require_once 'db.php';

$db_server = mysql_connect($db_hostname,$db_username,$db_password);

if (!$db_server)
 die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database)
 or die("Unable to select database: " . mysql_error());
//Database Connection complete

if(isset($_SESSION['junetworkuserid']) && isset($_SESSION['junetworkpass']))
{
  echo <<<_END
<html>
<head>
<title>Loading</title>
</head>
<body>
<br><br><br><br><center><img src='loading.gif' /></center>
</body>
</html>
_END;

  $uid = $_SESSION['junetworkuserid'];
  $pwd = $_SESSION['junetworkpass'];
  $query = "SELECT * FROM members WHERE user='$uid' AND pass='$pwd'";
  $result = mysql_query($query);
  if (!$result) die ("Database access failed: " . mysql_error());
  $rows = mysql_num_rows($result);
  $_SESSION['junetworkfname'] = mysql_result($result,0,'fname');

  header("refresh:1;url=dashboard.php");
}
else
{
  header('location: login.php');
}

?>