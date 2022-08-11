<?php
session_start();
//Database Connection start
require_once 'db.php';

$db_server = mysql_connect($db_hostname,$db_username,$db_password);

if (!$db_server)
 die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database)
 or die("Unable to select database: " . mysql_error());
//Database Connection complete

if(isset($_SESSION['junetworkuserid']) && isset($_SESSION['junetworkpass']))
{
  header('Location: auth.php');
}
else
{
if(isset($_POST['uid']))
{
  $uid = $_POST['uid'];
  $pwd = $_POST['pwd'];
  $query = "SELECT * FROM members WHERE user='$uid' AND pass='$pwd'";
  $result = mysql_query($query);
  if (!$result) die ("Database access failed: " . mysql_error());
  $rows = mysql_num_rows($result);
  if ($rows == 0)
  {
    //Error HTML Start
    echo <<<_END
<!DOCTYPE html>
<html >
<head>
<meta charset='UTF-8'>
<title>LogIn Form</title>
<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Hind:300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<link rel='stylesheet' href='./login_files/style.css'>  
</head>
<body>
<H1><font color='red'>Wrong Credentials</font></h1>
<div id='login-button'>
<img src='http://dqcgrsy5v35b9.cloudfront.net/cruiseplanner/assets/img/icons/login-w-icon.png'>
</img>
</div>
<div id='container'>
<h1>Log In</h1>
<span class='close-btn'>
<img src='https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png'></img>
</span>
<form method='POST' action='#'>
<input type='email' name='uid' placeholder='UserId'>
<input type='password' name='pwd' placeholder='Password'>
<input type='submit' value='Submit' />
<div id='remember-container'>
<input type='checkbox' id='checkbox-2-1' class='checkbox' checked='checked'/>
<span id='remember'>Remember me</span>
<span id='forgotten'>Forgotten password</span>
<br>
</div>
</form>
</div>
<!-- Forgotten Password Container -->
<div id='forgotten-container'>
<h1>Forgotten</h1>
<span class='close-btn'>
<img src='https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png'></img>
</span>
<form>
<input type='email' name='email' placeholder='E-mail'>
<a href='#' class='orange-btn'>Get new password</a>
</form>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='./login_files/script.js'></script>
</body>
</html>
_END;
    //Error HTML END
  }
  else
  {
    $_SESSION['junetworkuserid'] = $uid;
    $_SESSION['junetworkpass'] = $pwd;
    header('location: auth.php');
  }
}
else
{
echo <<<_END
<!DOCTYPE html>
<html >
<head>
<meta charset='UTF-8'>
<title>LogIn Form</title>
<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Hind:300' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<link rel='stylesheet' href='./login_files/style.css'>  
</head>
<body>
<div id='login-button'>
<img src='http://dqcgrsy5v35b9.cloudfront.net/cruiseplanner/assets/img/icons/login-w-icon.png'>
</img>
</div>
<div id='container'>
<h1>Log In</h1>
<span class='close-btn'>
<img src='https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png'></img>
</span>
<form method='POST' action='#'>
<input type='email' name='uid' placeholder='UserId'>
<input type='password' name='pwd' placeholder='Password'>
<input type='submit' value='Submit' />
<div id='remember-container'>
<input type='checkbox' id='checkbox-2-1' class='checkbox' checked='checked'/>
<span id='remember'>Remember me</span>
<span id='forgotten'>Forgotten password</span>
</div>
</form>
</div>
<!-- Forgotten Password Container -->
<div id='forgotten-container'>
<h1>Forgotten</h1>
<span class='close-btn'>
<img src='https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png'></img>
</span>
<form>
<input type='email' name='email' placeholder='E-mail'>
<a href='#' class='orange-btn'>Get new password</a>
</form>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='./login_files/script.js'></script>
</body>
</html>
_END;
}
}

?>