<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php

	if (logged_in()) {
		redirect_to("courses.php");
	}
	
	include_once("includes/form_functions.php");
	
	// START FORM PROCESSING
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();

		// perform validations on the form data
		$required_fields = array('username', 'password');
		$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

		$fields_with_lengths = array('username' => 30, 'password' => 30);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

		$webmail_id = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));
		$hashed_password = sha1($password);
		$person_type = trim(mysql_prep($_POST['person_type']));
		
		if ( empty($errors) ) {
			// Check database to see if webmail_id and the hashed password exist there.
			$query = "SELECT p.webmail_id, p.psswd ";
			$query .= "FROM person p, {$person_type} pt ";
			$query .= "WHERE p.webmail_id = '{$webmail_id}' AND p.webmail_id = pt.webmail_id ";
			$query .= "AND p.psswd = '{$hashed_password}' ";
			$query .= "LIMIT 1";
			$result_set = mysql_query($query);
			confirm_query($result_set);
			if (mysql_num_rows($result_set) == 1) {
				// username/password authenticated
				// and only 1 match
				$found_user = mysql_fetch_array($result_set);
				$_SESSION['webmail_id'] = $found_user['webmail_id'];
				$_SESSION['person_type'] = $_POST['person_type'];
				
				$user_entity = get_person_entity($person_type, $webmail_id);	// getting the entry in the Corresponding Student/Instructor Table... 
				if($person_type == 'student')
				{
					$_SESSION['name'] = $user_entity['name'];
					$_SESSION['roll_no'] = $user_entity['roll_no'];
					$_SESSION['semester'] = $user_entity['semester'];
					$_SESSION['abs_year'] = $user_entity['abs_year'];
					$_SESSION['abs_semester'] = $_user_entity['abs_semester'];
				}
				else if($person_type == 'instructor')
				{
					$_SESSION['name'] = $user_entity['name'];
					$_SESSION['instructor_id'] = $user_entity['instructor_id'];
				
				}
				else if($person_type == 'admin')
				{
					// Admin goes here.. 
					// Admin goes here.. 
					$_SESSION['name'] = $user_entity['name'];
					$_SESSION['admin_id'] = $user_entity['admin_id'];
					redirect_to("admin_profile.php");
				}
				redirect_to("courses.php");
			} else {
				// username/password combo was not found in the database
				$message = "Username/password combination incorrect.<br />
					Please make sure your caps lock key is off and try again.";
			}
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
		
	} else { // Form has not been submitted.
		if(isset($_GET['logout'])&& $_GET['logout']==1)
		{
			$message = "You are now Logged out !";
		}
		$username = "";
		$password = "";
	}
?>

<html lang="en">
<head>
<title>Course Resource Management</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_300.font.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_400.font.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--[if lt IE 7]>
<link rel="stylesheet" href="css/ie6.css" type="text/css" media="screen">
<script type="text/javascript" src="js/ie_png.js"></script>
<script type="text/javascript">ie_png.fix('.png, footer, header nav ul li a, .nav-bg, .list li img');</script>
<![endif]-->
<!--[if lt IE 9]><script type="text/javascript" src="js/html5.js"></script><![endif]-->
</head>
<body id="page1">
<!-- START PAGE SOURCE -->
<div class="wrap">
  <header>
    <div class="container">
      <h1><a href="#">Course Repository</a></h1>
      <nav>
        <ul>
          <li class="current"><a href="index.php" class="m1">Home Page</a></li>
          <li><a href="about-us.php" class="m2">About Us</a></li>
          <li><a href="contact-us.php" class="m4">Contact Us</a></li>
         <!-- <li class="last"><a href="sitemap.html" class="m5">Sitemap</a></li> -->
        </ul>
      </nav>
    </div>
  </header>
  <div class="container">
    
	<!--   Removed the content of <aside> tag here.. Since it is a publice page..  -->
	
    <section id="content">
      <div id="banner">
       <h2>Course Resource <span><span>Management</span></span></h2>
		<form action="index.php" method="post">
			<table>
				<tr>
					<td width="40%" >Username:</td>
					<td><input type="text" name="username" maxlength="30" style="height:30px" value="" /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password" maxlength="30" style="height:30px" value="" /></td>
				</tr>
				<tr>
					<td>As: </td>
					<td>
						<select name="person_type" style="width:205px">
							<option value="student">Student</option><br /><br />
							<option value="instructor">Instructor</option><br /><br />
							<option value="admin">Admin</option><br /><br />
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2"><input type="submit" name="submit" value="Login" /></td>
				</tr>
			</table>
		</form>
		<?php if (!empty($message)) {echo "<p class=\"error_message\">" . $message . "</p>";} ?>
		<?php if (!empty($errors)) { display_errors($errors); } ?>
		
      </div>
    </section>
  </div>
</div>

<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->

</html>

<?php include("includes/footer.php"); ?>

