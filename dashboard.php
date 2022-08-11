<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="./assets/img/favicon.png">

<title>Dashboard</title>

<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

<link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="./assets/css/nucleo-svg.css" rel="stylesheet" />

<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

<link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
<style> 
#flex-main {
  width: 400px;
  height: auto;
  border: 1px solid #c3c3c3;
  display: flex;
  flex-direction: row;
  border:none;
}

body
{
  background-image: url('dashboard.jpg');
  background-size: cover;
  background-blend-mode: darken;
}

#flex-main div {
  width: 50px;
  height: auto;
}

.sideenav {
  height: 100%;
  width: 260px;
  position: fixed;
  z-index: 1;
  top: 0;
  right: 0%;
  background:linear-gradient(195deg, #42424a 0%, #191919 100%);
  overflow-x: hidden;
  padding-top: 20px;
}

.sideenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sideenav a:hover {
  color: #f1f1f1;
}
</style>
</head>
<body class="g-sidenav-show  bg-gray-100">
    
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
<div class="sidenav-header">
<i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
<a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
<span class="ms-1 font-weight-bold text-white">Welcome, 
<?php
session_start();

if(isset($_SESSION['junetworkfname']))
  echo $_SESSION['junetworkfname'];

session_abort();
?>
</span>
</a>
</div>
<hr class="horizontal light mt-0 mb-2">
<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link text-white " href="">
    
<div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
<i class="material-icons opacity-10">dashboard</i>
</div>

<span class="nav-link-text ms-1">Dashboard</span>
</a>
</li>

 
<li class="nav-item">
  <a class="nav-link text-white " href="./messages.php">
    
      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="material-icons opacity-10">chat</i>
      </div>
    
    <span class="nav-link-text ms-1">Messages</span>
  </a>
</li>

  
    <li class="nav-item mt-3">
      <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
    </li>
  
<li class="nav-item">
  <a class="nav-link text-white " href="./profile.php">
    
      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="material-icons opacity-10">person</i>
      </div>
    
    <span class="nav-link-text ms-1">Profile</span>
  </a>
</li>

  
<li class="nav-item">
  <a class="nav-link text-white " href="./logut.php">
    
      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
        <i class="material-icons opacity-10">assignment</i>
      </div>
    
    <span class="nav-link-text ms-1">Log Out</span>
  </a>
</li>
  
    </ul>
  </div>
  
  <div class="sidenav-footer position-absolute w-100 bottom-0 ">
    <div class="mx-3">
    </div>
    
  </div>
  
</aside>

<main class="main-content border-radius-lg ">

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
  $uid = $_SESSION['junetworkuserid'];
  $pwd = $_SESSION['junetworkpass'];
  $query = "SELECT * FROM members WHERE user='$uid' AND pass='$pwd'";
  $result = mysql_query($query);
  if (!$result) die ("Database access failed: " . mysql_error());
  $rows = mysql_num_rows($result);
  $fname = mysql_result($result,0,'fname');
  $lname = mysql_result($result,0,'lname');
  $about = mysql_result($result,0,'about');
  $mobile = mysql_result($result,0,'mobile');


  echo "<!-- Info Start --><div style='display:box;border-radius:15px;background:white;opacity:0.9;height:530px;overflow-y: auto; position:relative;margin:37px 0 0 15px;width:70%;'>
<div style='position:relative;margin:37px 0 0 15px;'>
<div id='flex-main'>
<div style='float:left;'><img style='border-radius:5rem;' src='./dp-pics/".$mobile.".jpg' height='150px' width='150px' /></div>
<div style='position:relative;float:left;margin-left:120px;width:50%;padding-top:15px;padding-left:15px;'>".$about."iofdif ido fdfj dofd od </div>
</div>
</div>
<H3>&ensp;&ensp;Connections</h3>";

  if(isset($_POST['acceptdata']) || isset($_POST['declinedata']))
  {
    if(isset($_POST['acceptdata']))
    {
      $newfriend = $_POST['acceptdata'];
	$updatequery = "INSERT INTO friends (friend1,friend2) VALUES('$newfriend','$mobile')";
	$upd_result = mysql_query($updatequery);
      if (!$upd_result) die ("Database access failed: " . mysql_error());

	$updatequery1 = "UPDATE pending set status=1 WHERE friend1='$newfriend' AND friend2='$mobile'";
	$upd1_result = mysql_query($updatequery1);
      if (!$upd1_result) die ("Database access failed: " . mysql_error());
      $_POST['acceptdata'] = NULL;
    }
    else if(isset($_POST['declinedata']))
    {
      $notfriend = $_POST['declinedata'];
	$updatequery = "UPDATE pending set status=0 WHERE friend1='$notfriend' AND friend2='$mobile'";
	$upd_result = mysql_query($updatequery);
      if (!$upd_result) die ("Database access failed: " . mysql_error());
      $_POST['declinedata'] = NULL;
    }
  }
  else if(isset($_POST['invite']))
  {
    $ally=$_POST['invite'];
    $updatequery = "INSERT INTO pending (friend1,friend2) VALUES('$mobile','$ally')";
    $upd_result = mysql_query($updatequery);
    if (!$upd_result) die ("Database access failed: " . mysql_error());
  }

  //friend-requests-to-you
  $query2 = "SELECT * FROM pending WHERE friend2='$mobile' AND status IS NULL";
  $result2 = mysql_query($query2);
  if (!$result2) die ("Database access failed: " . mysql_error());
  $rows2 = mysql_num_rows($result2);
  if($rows2) {
  for($j=0;$j<$rows2;$j++)
  {
    $futurefriend = mysql_result($result2,$j,'friend1');

    $sub_query2 = "SELECT * FROM members WHERE mobile='$futurefriend'";
    $sub_result2 = mysql_query($sub_query2);
    if (!$sub_result2) die ("Database access failed: " . mysql_error());
    $sub_rows2 = mysql_num_rows($sub_result2);
    $futurefriendname = "" .mysql_result($sub_result2,0,'fname'). " " .mysql_result($sub_result2,0,'lname'). "";

    echo"
<div style='position:relative;clear:both;padding-left:12px;padding-top:8px;'>
<div style='float:left;'><img src='./dp-pics/".$futurefriend.".jpg' height='77px' width='77px' /></div>
<div style='position:relative;float:left;margin-left:2%;width:100px;'>".$futurefriendname."<br><form action='' method='POST'><input type='hidden' name='acceptdata' value='".$futurefriend."'><button style='float:left;' type='submit'><img src='tick.png' height='20px' widht='20px' /></button></form><form action='' method='POST'><input type='hidden' name='declinedata' value='".$futurefriend."'><button style='float:left;' type='submit'><img src='reject.png' height='20px' widht='20px' /></button></form></div>
</div>
<br>";
  }}

  //friends
  $query1 = "SELECT * FROM friends WHERE friend1='$mobile' OR friend2='$mobile'";
  $result1 = mysql_query($query1);
  if (!$result1) die ("Database access failed: " . mysql_error());
  $rows1 = mysql_num_rows($result1);
  if($rows1) {
  for($i=0;$i<$rows1;$i++)
  {
    if($mobile == mysql_result($result1,$i,'friend1'))
        $myfriend = mysql_result($result1,$i,'friend2');
    else
        $myfriend = mysql_result($result1,$i,'friend1');

    $sub_query1 = "SELECT * FROM members WHERE mobile='$myfriend'";
    $sub_result1 = mysql_query($sub_query1);
    if (!$sub_result1) die ("Database access failed: " . mysql_error());
    $sub_rows1 = mysql_num_rows($sub_result1);
    $myfriendname = "" .mysql_result($sub_result1,0,'fname'). " " .mysql_result($sub_result1,0,'lname'). "";

    echo"
<div style='position:relative;clear:both;padding-left:12px;padding-top:8px;'>
<div style='float:left;'><img src='./dp-pics/".$myfriend.".jpg' height='77px' width='77px' /></div>
<div style='position:relative;float:left;margin-left:2%;width:auto;'>".$myfriendname."<br><form action='messages.php' method='POST'><input type='hidden' name='chatnamedata' value='".$myfriendname."'><input type='hidden' name='chatdata' value='".$myfriend."'><input type='submit' value='Chat' /></form></div>
</div>
<br>";
  }}
  else
  echo "<div style='position:relative;clear:both;'><br><br>You currently have no connections</div>";

echo "</div><!-- Info End -->";


echo "<div class='sideenav'>";
// div start
$query3 = "SELECT * FROM members WHERE mobile!='$mobile'";
$result3 = mysql_query($query3);
if (!$result3) die ("Database access failed: " . mysql_error());
$rows3 = mysql_num_rows($result3);

for($k=0;$k<$rows3;$k++)
{
  $match = 0;
  $sub_query3 = "SELECT * FROM friends WHERE friend1='$mobile' || friend2='$mobile'";
  $sub_result3 = mysql_query($sub_query3);
  if (!$sub_result3) die ("Database access failed: " . mysql_error());
  $sub_rows3 = mysql_num_rows($sub_result3);

  for($kk=0;$kk<$sub_rows3;$kk++) {
    if(mysql_result($result3,$k,'mobile') == mysql_result($sub_result3,$kk,'friend1') || mysql_result($result3,$k,'mobile') == mysql_result($sub_result3,$kk,'friend2')) {
    $match = 1;  break;
   }
  }
  if(!$match)
  {
    $peoplename = "" .mysql_result($result3,$k,'fname'). " " .mysql_result($result3,$k,'lname'). "";
    echo"
<div style='position:relative;clear:both;padding-left:12px;padding-top:8px;'>
<div style='float:left;'><img style='border-radius:1.5rem;' src='./dp-pics/".mysql_result($result3,$k,'mobile').".jpg' height='77px' width='77px' /></div>
<div style='position:relative;float:left;margin-left:2%;width:auto;'>".$peoplename."<br>";

   $temp = mysql_result($result3,$k,'mobile');
   $subb_query3 = "SELECT * FROM pending WHERE ((friend1='$mobile' && friend2='$temp') || (friend1='$temp' && friend2='$mobile')) AND status IS NULL";
   $subb_result3 = mysql_query($subb_query3);
   if (!$subb_result3) die ("Database access failed: " . mysql_error());
   $subb_rows3 = mysql_num_rows($subb_result3);
   if($subb_rows3)
      echo "Invited";
   else
      echo "<form action='' method='POST'><input type='hidden' name='invite' value='".mysql_result($result3,$k,'mobile')."'><input type='submit' value='Invite' /></form>";
   echo "</div>
</div><br>";
  }
}
// div end
echo "</div>";

}
else
{
  header('location: login.php');
}

?>


</main>


<script src="./assets/js/core/popper.min.js" ></script>
<script src="./assets/js/core/bootstrap.min.js" ></script>
<script src="./assets/js/plugins/perfect-scrollbar.min.js" ></script>
<script src="./assets/js/plugins/smooth-scrollbar.min.js" ></script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>

<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="./assets/js/material-dashboard.min.js?v=3.0.4"></script>
  </body>

</html>