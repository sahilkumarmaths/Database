<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php

$webmail_id = $_SESSION['webmail_id'];
$a=$_GET["a"];
$b=$_GET["b"];
$c=$_GET["c"];
$d=$_GET["d"];
$e=$_GET["e"];
$e=$_GET["e"];
$f=$_GET["f"];
$g=$_GET["g"];
$h=$_GET["h"];
$i=$_GET["i"];
$j=$_GET["j"];
$k=$_GET["k"];

$query = "INSERT INTO quiz(webmail_id, first, second, third, fourth, fifth, sixth, seventh, eighth, ninth, tenth, total) VALUES ('$webmail_id','$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k')";

$result_set = mysql_query($query);
confirm_query($result_set);

echo "";

?>
