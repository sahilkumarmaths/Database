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
<body id="page2">
<!-- START PAGE SOURCE -->
<div class="wrap">
  <header>
    <div class="container">
      <h1><a href="#">Student's site</a></h1>
      <nav>
          <ul>
         <li><a href="courses.php" class="m1">Home Page</a></li>
          <li class="current"><a href="about-us.php" class="m2">About Us</a></li>
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
	  <h2>About <span>The Website</span></h2>
        <div class="img-box"><img src="images/2page-img4.jpg"><span class="txt1">Course Resource Management</span> 
		This website would serve as an extremely useful platform for the Students, professors,etc. to share all the useful resources of a course.
		</div>
        <p class="p0"><span class="txt1">Course Files</span>
		Students/Instructors can upload useful documents related to a course, which can be accessed by all the members of a course.
		</p>
		<p class="p0"><span class="txt1">Course Threads</span>
		Useful discussion threads can be posted in the website as well, which serve as a good platform for discussions among the students/professors.
		</p>
		<br /><br />
		
        <h2>About <span>the team</span></h2>
	
        <table>
		<tr>
		<td>
         <img src="images/vs.JPG" hspace="10" vspace="10" width="250" height="240" >
            <h4><a href="http://in.linkedin.com/in/venkatsai101">Venkat Sai</a></h4>
            <p>Budding pre final year in Computer Science and Engineering from IIT Guwahati</p>
          
		 </td> 
			<td>
          <img src="images/dileep.JPG" width="250" height="240" >
            <h4>PVS Dileep</h4>
            <p>Third year Undergraduate, CSE, IIT Guwahati who hails from Vizag.</p>
          
		  </td>  
		</tr>  
		<tr>
		<td>
          <img src="images/sharath.JPG" width="250" height="240">
            <h4>Sharath Reddy</h4>
            <p>Third year Undergraduate, CSE, IIT Guwahati .</p>
          
		</td>  
		<td>
		<img src="images/sahil.JPG" width="250" height="240">
            <h4>Sahil Kumar Goyal</h4>
            <p>Third year Undergraduate, CSE, IIT Guwahati</p>
         
		  </td>  
			</tr>
		  </table>

      </div>
    </section>
  </div>
</div>
<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->
</html>
<?php include("includes/footer.php"); ?>
