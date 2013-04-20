<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	// Get the corresponding course entity from the database.. 
	if (!(isset($_GET['course_id']) && isset($_GET['semester']) && isset($_GET['abs_year'])) )
	{
		redirect_to("courses.php");
	}
	
	if(isset($_GET['course_id']) && isset($_GET['semester']) && isset($_GET['abs_year']))
	{
		$sel_course_id = trim(mysql_prep($_GET['course_id']));
		$sel_semester =trim(mysql_prep($_GET['semester']));
		$sel_abs_year = trim(mysql_prep($_GET['abs_year']));
		$course_entity = get_course_by_key($sel_course_id, $sel_semester, $sel_abs_year);	// returns the record(or the fetch array) corresponding to the given subject id..
		$course_news = get_news_by_course($sel_course_id, $sel_semester, $sel_abs_year);
	}
?>
<?php
	if($_SESSION['person_type'] == 'student')
	{
		$name	=	$_SESSION['name'] ;
		$webmail_id = $_SESSION['webmail_id'];
		$roll_no =	$_SESSION['roll_no'] ;
		$semester = $_SESSION['semester'];
		$abs_year = $_SESSION['abs_year'] ;
		$abs_semester =	$_SESSION['abs_semester'];
	}

	else if($_SESSION['person_type'] == 'instructor')
	{
		$name = $_SESSION['name'];
		$webmail_id = $_SESSION['webmail_id'];
		$instructor_id = $_SESSION['instructor_id'];
	
	}
?>

<html lang="en">
<head>
<title>CRM</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_300.font.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_400.font.js"></script>
<script type="text/javascript" src="js/script.js"></script>

    <!-- Bootstrap -->
<script src="js/jquery.js"></script>
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
      
      <nav>
        <ul>
		  <li><a href="courses.php" class="m1">Home Page</a></li>
          <li class="current"><?php echo "<a href=\"course_page.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \" class=\"m1\" > Course Page </a> " ; ?></li>
          <li><?php echo "<a href=\"course_files.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \" class=\"m2\" > Files </a> " ; ?></li>
          <li><?php echo "<a href=\"course_threads.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \" class=\"m3\" > Threads </a> " ; ?></li>
          
        </ul>
		
		<h2><?php echo $course_entity['course_name']. " - ". $course_entity['course_id']   ?> </h2>
		
      </nav>
      
    </div>
  </header>
  <div class="container">
    <aside>
      <h3>Categories</h3>
      <ul class="categories">
        <li><span><a href="courses.php">Courses</a></span></li>
        <li><span><a href="profile.php">Personal Profile</a></span></li>
        <li><span><?php echo "<a href=\"quiz.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \" class=\"m3\" > Quiz </a> " ; ?></span></li>
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
		<?php
		if($_SESSION['person_type'] == 'instructor')
		{
				?>
				<a href="#news_modal" role="button" class="btn" data-toggle="modal">Update news</a>
		
					<div id="news_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-body">	
						<?php echo "<form action=\"course_page.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \"    " ; ?>
					method="post" enctype="multipart/form-data" >
					<table>

						<tr><td >News name</td><td><textarea  name="news_name" style='height:30px;width:400px;' cols='80' rows='1'></textarea></td></tr>
						<tr><td >Content </td><td><textarea name="news_content" style='height:100px;width:400px;' cols='80' rows='5'></textarea></td></tr>

					</table>
					</div>
						<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
						<input  class="btn btn-primary" type="submit" name="submit" value="Submit">
						</div>
						 </form>
					</div>
				
				<?php
		}
		?>
	<?php
			//insert_thread($sel_course_id,$sel_semester,$sel_abs_year);
			if (isset($_POST['submit']))
			{
				//FINAL
				$query = "INSERT INTO `crm_db`.`news_feed` (`nid`, `news_text`, `webmail`, `news_content`) 
				VALUES (NULL, '".$_POST['news_name']."','".$_SESSION['webmail_id']."','".$_POST['news_content']."'); ";

				 //INSERT INTO `news_feed`(`nid`, `news_text`, `webmail`, `date`) VALUES (NULL,'test','srs',NOW())
				$res1=mysql_query($query);
				
				$get_nid="SELECT nid FROM news_feed order by nid desc LIMIT 0,1";
				
				$result_set=mysql_query($get_nid);
				while ($news = mysql_fetch_array($result_set)) 
					  {			
						$nid=$news['nid'];
					  }
				
				$query3="INSERT INTO `crm_db`.`news_course` (`nid`, `course_id`, `semester`, `year`) 
				VALUES ('".$nid."', '".$sel_course_id."','".$sel_semester."','".$sel_abs_year."'); ";
				
				print '<script type="text/javascript">';
				print 'alert("The email addre is already registered")';
				print '</script>';  
				
				
				$res3=mysql_query($query3);
				
				unset(  $_POST['submit'] );
				$new_page = "course_page.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year);
				redirect_to($new_page);
			}

		?>
      <h3>Latest <span>Updates</span></h3>
      <ul class="news">
	  
	  <?php
			while ($news = mysql_fetch_array($course_news)) 
			  {			
				echo "<li>{$news['date']}
						<h4><a href='#'>{$news['news_text']}</a></h4>
						{$news['news_content']}</li>
						";

			  }
	?>
      </ul>
	 </div>
    </section>
  </div>
</div>
<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->
</html>
<?php include("includes/footer.php"); ?>
