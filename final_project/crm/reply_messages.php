<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	/* 
	 * Function returns the resultset corresponding to the All messages of a particular person
	 * sorted by the time stamp
	 */
	$sender_id=$_GET["sender"];	 
	$reciever_id = $_GET['reciever'];
	$message= $_GET["text"];	 

		$query = "INSERT INTO `crm_db`.`message` (`webmail_id_sender`, `webmail_id_reciever`, `message`, `time_stamp`, `reciever_read`) VALUES 
		('{$sender_id}', '{$reciever_id}', '{$message}', CURRENT_TIMESTAMP, '0')";

		$result_set = mysql_query($query);
		?>
		
