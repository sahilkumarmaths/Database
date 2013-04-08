<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$comment_id=$_GET["id"];

$query = "Select th.comment_text
			from comments th
			where th.comment_id = '{$comment_id}'";
$result_set = mysql_query($query);
confirm_query($result_set);
while ($row = mysql_fetch_array($result_set))
	{
			$comment_text = $row['comment_text'];
	}


echo "<textarea id='myTextarea' cols='80' rows='5'>
.{$comment_text}.
</textarea>
<br>

<button type='button' onclick='update_comment({$comment_id})'>Edit</button>";

?>