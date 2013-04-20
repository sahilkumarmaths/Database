<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<html lang="en">
<head>
<title>CRM</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_300.font.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_400.font.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<!--[if lt IE 7]>
<link rel="stylesheet" href="css/ie6.css" type="text/css" media="screen">
<script type="text/javascript" src="js/ie_png.js"></script>
<script type="text/javascript">ie_png.fix('.png, footer, header nav ul li a, .nav-bg, .list li img');</script>
<![endif]-->
<!--[if lt IE 9]><script type="text/javascript" src="js/html5.js"></script><![endif]-->
</head>
<body id="page5">
<!-- START PAGE SOURCE -->
<div class="wrap">
  <header>
    <div class="container">
      <h1><a href="#">Student's site</a></h1>
      <nav>
         <ul>
          <li><a href="courses.php" class="m1">Home Page</a></li>
          <li><a href="about-us.php" class="m2">About Us</a></li>
          <li  class="last current"><a href="contact-us.php" class="m4">Contact Us</a></li>
         
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
		<li><span><a href="list_message.php">Message
		<?php
			if(logged_in())
			{
				$webmail_id = $_SESSION['webmail_id'];
				$total = total_unread_messages($webmail_id);
				echo"(".$total.")";
			}
		?>
		</a></span></li>
        <li class="last"><span><a href="logout.php">Logout</a></span></li>
      </ul>
      
     
    </aside>
    <section id="content">
      <div id="banner">
        
        <h2>Course <span>Resource <span>Management</span></span></h2>
      </div>
      <div class="inside">
        <h2>Our <span>Contacts</span></h2>
        <div class="address">
          <address>
          <strong>Zip Code:</strong>781039<br>
          <strong>Country:</strong>India<br>
          <strong>Email:</strong>venkatsai101@gmail.com<br />pvsdileep@gmail.com<br /> gsharathreddy77@gmail.com <br /> sahilkumarmaths@gmail.com
          
          </address>
          <div class="extra-wrap">
            <h4>Miscellaneous info:</h4>
            <p>Please contact us in case of any help/info</p>
          </div>
        </div>
       
     
      </div>
    </section>
  </div>
</div>

<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->
</html>
<?php include("includes/footer.php"); ?>
