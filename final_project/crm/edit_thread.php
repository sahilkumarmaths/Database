<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$thread_id=$_GET["id"];
$counter = $_GET["counter"];
$query = "Select th.thread_name,th.description
			from thread th
			where th.thread_id = '{$thread_id}'";
$result_set = mysql_query($query);
confirm_query($result_set);
while ($row = mysql_fetch_array($result_set))
	{
			$thread_name = $row['thread_name'];
			$thread_description=$row['description'];
	}

$str =  "<br/><br/><h3> Edit the thread </h3>
<table>
<tr><td>Thread_name:</td><td> <textarea id='th_name' cols='80' rows='1'>
{$thread_name}
</textarea></td></tr>
<tr><td>Description: </td><td><textarea id='myTextarea' cols='80' rows='5'>
{$thread_description}
</textarea></td></tr>
</table>

<button type='button' onclick='update_thread({$thread_id},{$counter})'>Edit</button>";

$modal_str = "
<a href='#edit_thread_modal' role='button' class='btn' data-toggle='modal'>Create a new Thread</a>	
<div id='edit_thread_modal' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='modal-body'>
<table>
<tr><td>Thread name: </td><td><textarea id='th_name' cols='80' rows='1'>{$thread_name}</textarea></td></tr>
<tr><td>Description: </td><td><textarea id='myTextarea' cols='80' rows='5'>{$thread_description}</textarea></td></tr>
</table>
</div>
<div class='modal-footer'>
<button class='btn' data-dismiss='modal' aria-hidden='true'>Close</button>
<button class='btn btn-primary' type='button' onclick='update_thread({$thread_id},{$counter})'>Edit</button>
</div>
";


echo $str;
?>