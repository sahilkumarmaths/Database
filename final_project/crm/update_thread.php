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



$get_info = "Select th.webmail_id
			from thread th
			where th.thread_id = '{$thread_id}'";
$result_set = mysql_query($get_info);
confirm_query($result_set);
while ($row = mysql_fetch_array($result_set))
	{
			$author_name = $row['webmail_id'];
	}

echo "<td>{$counter}</td>";
echo "<td><a href=\"comments.php?thread_id=".urlencode($thread_id)."\">{$thread_name}</a></td> " ;
echo "<td> {$author_name} </td>";
echo "<td> {$thread_desc}</td>";
		if($author_name==$webmail_id)
			{
				echo "<td><img src='images/del-4.png' alt=\"delete\" onclick = \"delete_thread({$thread_id})\" width = '20' height ='20'>";
				echo "<img src='images/edit-1.png' alt=\"Edit\" onclick = \"edit_thread({$thread_id})\" width = '25' height ='25'  >";
				echo "<br/><br/></td>";
			}

?>