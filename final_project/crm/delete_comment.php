<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$comment_id=$_GET["id"];

print '<script type="text/javascript">';
print 'alert("In delete comment")';
print '</script>';  

$query = "DELETE FROM comments
		where comment_id = '{$comment_id}'";
mysql_query($query);
//confirm_query($result_set);
echo "";
?>