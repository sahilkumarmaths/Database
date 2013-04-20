<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	/* 
	 * Function returns the resultset corresponding to the All messages of a particular person
	 * sorted by the time stamp
	 * 0 means unread
	 * 1 means read
	 */
$sender_id=$_GET["id"];	 
$reciever_id = $_SESSION['webmail_id'];


		$update_query = "UPDATE `crm_db`.`message` SET `reciever_read` = '1' WHERE webmail_id_reciever = '{$reciever_id}' and webmail_id_sender = '{$sender_id}' " ;
		$result_set = mysql_query($update_query);
		
		$query = " SELECT * from message where (webmail_id_reciever = '{$reciever_id}' and webmail_id_sender = '{$sender_id}') or (webmail_id_reciever = '{$sender_id}' and webmail_id_sender = '{$reciever_id}') order by `time_stamp`  ";
		$result_set = mysql_query($query);
		
		
		
		
echo "<table>  ";
	
while ($message_result = mysql_fetch_array($result_set)) 
									{
										$sender_name = $message_result['webmail_id_sender'];
										$message = $message_result['message'];
										$time_stamp = $message_result['time_stamp'];
										

											echo "<tr>";
											
											echo "<td  width='100px' class = 'reply_name'>{$sender_name}</td>";
											echo "<td align='right'>{$time_stamp}</td>";
											echo "</tr>";
											
											echo "<tr>";
											echo "<td colspan='2'>{$message}</td>";
											echo "<td></td>";
											echo "</tr>";
											echo "<tr><td colspan='2'>--------------------------------------------</td></tr>";	
										
									}
	
echo "</table>
<textarea id='myTextarea' >
</textarea>
<br>
<button type='button' onclick=send_message('{$reciever_id}')>Reply</button>";
