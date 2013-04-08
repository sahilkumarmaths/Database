<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php

	include_once("includes/form_functions.php");
	$webmail_id = $_SESSION['webmail_id'];
	// START FORM PROCESSING	
		$old_passwd= mysql_prep($_POST['old_password']);
		$new_passwd= mysql_prep($_POST['new_password']);
		$cnf_passwd= mysql_prep($_POST['cnf_password']);
		
		$qry1="SELECT * FROM person WHERE webmail_id='{$webmail_id}'";
		$result=mysql_query($qry1);
		confirm_query($result);
		
		
		if(mysql_num_rows($result) == 1)
		{
				$row=mysql_fetch_array($result);
				
				$passwd=$row['psswd'];
				$user_name=$row['webmail_id'];
			
			
			if($passwd==sha1($old_passwd) && $new_passwd == $cnf_passwd)
			{
				$new_hash = sha1($new_passwd);
				echo $webmail_id;
				echo $new_hash;
				$query="UPDATE person SET psswd='{$new_hash}' WHERE webmail_id= '{$webmail_id}'";
				echo $query;
				$result=mysql_query($query);
				confirm_query($result);
				if($result){
					echo "Your password updated";
					echo "<a href=\"profile.php\">Click here</a> to go home. This page will redirect to home in 4 seconds ";
					redirect_to("profile.php") ;
				}
				else{
					die("Query failed");
				}
			}
			else
			{
				echo "You have entered wrong password, pass in database";
				echo"<br/>";
				echo "";
				echo "<a href=\"profile.php\">Click here</a> to go home. This page will redirect to home in 4 seconds ";
				header( "refresh:4;url=change_password.php" );
			}
		}
		else
		{
			echo "Same user name for more than one people, contact admin.";
		}

?>