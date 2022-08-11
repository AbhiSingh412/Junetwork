<html>
<head></head>
<body>

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
  $mobile = mysql_result($result,0,'mobile');

  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
  else  
         $url = "http://";   
  $url.= $_SERVER['HTTP_HOST'];   
  $url.= $_SERVER['REQUEST_URI'];    

  $tmp = explode("?", $url);
  $temper = end($tmp);
  $reciepent = strtok($temper, '#');

  $queery = "SELECT * FROM messages WHERE (friend1='$mobile' && friend2='$reciepent') OR (friend1='$reciepent' && friend2='$mobile') ORDER BY timestmp";
  $reesult = mysql_query($queery);
  if (!$reesult) die ("Database access failed: " . mysql_error());
  $roows = mysql_num_rows($reesult);

  $up_q2 = "UPDATE messages set isread=1 WHERE (friend2='$mobile' && friend1='$reciepent')";
  $upres2 = mysql_query($up_q2);
  if (!$upres2) die ("Database access failed: " . mysql_error());
  if($roows) {
  for($i=0;$i<$roows;$i++)
  {
     $isread = "NOT READ";
     $timestmp = mysql_result($reesult,$i,'timestmp');
     $mssg = "<br><span style='position:relative;display:box;clear:both;'>".mysql_result($reesult,$i,'message')."</span>";
     if(mysql_result($reesult,$i,'friend1') == $mobile) {
       if(mysql_result($reesult,$i,'isread'))
         $isread = "READ";
       if($isread == "READ")
         $ticker = "<img style='position:relative;float:right;' src='bluetick.png' height='15px' width='25px' />";
       else
         $ticker = "<img style='position:relative;float:right;' src='blacktick.png' height='15px' width='15px' />";
       echo "<div style='background:linear-gradient(215deg, #ffffff 0%, #191919 60%);opacity:0.9;margin-left:58.99%;border-bottom-left-radius:12px;padding:9px;width:30%;color:white;'><span style='position:relative;margin-top:-7px; font-size:10px;'><span style='position:relative;float:left;'>".$timestmp."</span>".$ticker."</span>".$mssg."</div><br>";
     }
     else
      echo "<div style='background:linear-gradient(195deg, #fff 0%, #191919 100%);opacity:0.9;color:white;border-bottom-left-radius:6px;padding:9px;margin-left:0%;width:30%;'><span style='position:relative;margin-top:-7px; font-size:10px;'><span style='position:relative;float:left;'>".$timestmp."</span></span>".$mssg."</div><br>";
  } echo "<a name='lastmsg'></a>"; }
  else
     echo "You haven't started any conversation yet. Say Hi!!";
}

?>

<script>
setTimeout(function () { location.reload(1); }, 5000);
</script>
</body>
</html>