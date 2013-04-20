<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$thread_id=$_GET["id"]; 
$query = "DELETE FROM thread
		where thread_id = '{$thread_id}'";
mysql_query($query);
echo "";
?>