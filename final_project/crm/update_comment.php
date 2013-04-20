<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$comment_id=$_GET["id"];
$comment_text = $_GET["text"];
$query = "UPDATE comments
			SET comment_text = '{$comment_text}'
			where comment_id = '{$comment_id}'";
mysql_query($query);
//confirm_query($result_set);
?>