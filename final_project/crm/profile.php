<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
	if($_SESSION['person_type']=='student')
	{
		$name	=	$_SESSION['name'] ;
		$webmail_id = $_SESSION['webmail_id'];
		$roll_no =	$_SESSION['roll_no'] ;
		$semester = $_SESSION['semester'];
		$abs_year = $_SESSION['abs_year'] ;
		$abs_semester =	$_SESSION['abs_semester'];
		$person_type = $_SESSION['person_type'];
		$course_set = get_courses_for_student($webmail_id);
	}
	
	else if($_SESSION['person_type']=='instructor')
	{
		$name	=	$_SESSION['name'] ;
		$webmail_id = $_SESSION['webmail_id'];
		$instructor_id = $_SESSION['instructor_id'];
		$course_set = get_courses_for_instructor($webmail_id);
	}
?>
<html lang="en">
<head>
<title>Student's Site | Articles</title>
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
<body id="page3">
<!-- START PAGE SOURCE -->
<div class="wrap">
  <header>
    <div class="container">
      <h1><a href="#">Student's site</a></h1>
      <nav>
        <ul>
         <li class="current"><a href="courses.php" class="m1">Home Page</a></li>
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
        <h2>PERSONAL INFORMATION.. </h2>
	
			<?php 
			if($_SESSION['person_type']== 'student')
				display_person_info($name, $webmail_id, $roll_no, $semester, $abs_year); 
			else if($_SESSION['person_type']== 'instructor')
				display_person_info($name, $webmail_id, NULL, NULL, NULL, $instructor_id); 
			?>
			<br /><br />
		<h2> A Track of Your Files : </h2>
		<br />
			<ul class="articles">
			
			 <table id="details1">
				<?php
					//$file_upload_set = get_file_uploads_of_course($sel_course_id, $sel_semester, $sel_abs_year);
					echo "<tr><span>";
					echo "<td> Name </td>";
					echo "<td> Description </td>";
					echo "<td> Course </td>";
					echo "<td> Time </td>";
					echo "</span></tr>";
				while ($course = mysql_fetch_array($course_set)) 
				{
					$sel_course_id = $course["course_id"];
					$sel_semester = $course["semester"];
					$sel_abs_year = $course["absolute_year"];
					
					
				
					$file_upload_set = get_search_files($course["course_id"], $course["semester"],$course["absolute_year"],"",$webmail_id,"");
					
					if($file_upload_set)
					{
						while ($file_upload = mysql_fetch_array($file_upload_set)) 
						{
							echo "<tr><span>";	
							$file_id = $file_upload['file_id'];
							$path = $file_upload['file_data'];
							$name = $file_upload['file_name'];
							$description = $file_upload['file_description'];
							$uploader_id = $file_upload['uploader_id'];
							$time_stamp = $file_upload['time_stamp'];
																			
							echo "<td> <h4><a href=\"{$path}\"> {$name} </a> </h4>";
							echo '<div style="float:left; padding:px">';
							echo "<form action=\"course_files.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)."&delete=".urlencode($file_id)."\" method=\"post\"> <input type=\"submit\" name=\"delete_submit\" value=\"Delete\" /> </form>";
							echo '</div><div style = "float:left; padding:px">';
							echo "<form action=\"course_files.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)."&report=".urlencode($file_id)." \" method=\"post\"> <input type=\"submit\" name=\"report_spam\" value=\"Report Spam\" /> </form>";	
							echo '</div><br />';
							$report_spam_set = get_report_of_file($file_id);
							if(!empty($report_spam_set))
							{
								echo "<br /><h5>Spam Reported !!</h5>";
							}
							echo "</td>";
							echo "<td> {$description} </td>";
							echo "<td> {$sel_course_id} </td>";
							echo "<td> {$time_stamp} </td>";
									
							
						//	echo "<h4><a href=\"{$path}\"> {$name} </a> <br /> </h4></li>";
							echo "</span></tr>";
						}
						
					}
					else
					{
						echo "<p>No files have been uploaded yet for this Course !</p>" ;
					}		
				}
		
				?>
				
			  </table>
			</ul>
      </div>
    </section>
  </div>
</div>

<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->
</html>
<?php include("includes/footer.php"); ?>
