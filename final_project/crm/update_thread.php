<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$thread_id=$_GET["id"];
$thread_name = $_GET["t_name"];
$thread_desc= $_GET["t_desc"];
$webmail_id = $_SESSION['webmail_id'];
$counter = $_GET["counter"];
$query = "UPDATE thread
			SET thread_name= '{$thread_name}' , description= '{$thread_desc}'
			where thread_id = '{$thread_id}'";

mysql_query($query);

?>