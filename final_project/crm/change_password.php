<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

	

<html lang="en">
<head>
<title>Student's Site | Articles</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="css/structure.css">
<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_300.font.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_400.font.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script language="Javascript">
function validateForm()
{
var x=document.forms["loginForm"]["new_password"].value;
var y=document.forms["loginForm"]["cnf_password"].value;
if (x!=y)
  {
  alert("New and Confirm passwords do not match");
  return false;
  }
  else return true;
}

</script>
<!--[if lt IE 7]>
<link rel="stylesheet" href="css/ie6.css" type="text/css" media="screen">
<script type="text/javascript" src="js/ie_png.js"></script>
<script type="text/javascript">ie_png.fix('.png, footer, header nav ul li a, .nav-bg, .list li img');</script>
<![endif]-->
<!--[if lt IE 9]><script type="text/javascript" src="js/html5.js"></script><![endif]-->
</head>
<body id="page3">
<!-- START PAGE SOURCE -->
<div class="wrap">
  <header>
    <div class="container">
      <h1><a href="#">Student's site</a></h1>
      <nav>
        <ul>
          <li><a href="courses.php" class="m1">Home Page</a></li>
		  <li><span><a href="list_message.php" class="m3">Message
		<?php
			$webmail_id = $_SESSION['webmail_id'];
			$total = total_unread_messages($webmail_id);
			echo"(".$total.")";
		?>
		</a></span></li>
          <li><a href="about-us.php" class="m2">About Us</a></li>
          <li><a href="contact-us.php" class="m4">Contact Us</a></li>
        </ul>
      </nav>
      
    </div>
  </header>
  <div class="container">
    <aside>
       <h3>Categories</h3>
      <ul class="categories">
        <li><span><a href="courses.php">Courses</a></span></li>
        <li><span><a href="profile.php">Personal Profile</a></span></li>
        <li><span><a href="change_password.php">Change password</a></span></li>
		<li><span><a href="list_message.php">Message
		<?php
			$webmail_id = $_SESSION['webmail_id'];
			$total = total_unread_messages($webmail_id);
			echo"(".$total.")";
		?>
		</a></span></li>
        <li class="last"><span><a href="logout.php">Logout</a></span></li>
      </ul>
  
    </aside>
    <section id="content">
     
      <div class="inside">
        <h2>Change password.. </h2>
		<div>
		<form method="post" name="loginForm" action="password_change-exec.php" onsubmit="return validateForm()">
			<fieldset >
			  <label>Old Password</label>
			  <input name="old_password" type="password" tabindex="1" required>
			  <br/>
			  <br/>
			  <br/>
			  <label>New Password</label>
			  <input name="new_password" type="password" tabindex="2" required>
			  <br/>
			  <br/>
			  <br/>
			  <label>Confirm Password</label>
			  <input name="cnf_password" type="password" tabindex="3" required>
			</fieldset>
			<br/>
			<br/>

			  <input type="submit" value="Change" tabindex="4">
	
		</form>

</div>
		

      </div>
    </section>
  </div>
</div>
<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->
</html>
<?php include("includes/footer.php"); ?>
	
	
