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
		// These are the primary keys.. corresponding to the course page.. 
		$sel_course_id = mysql_prep($_GET['course_id']);
		$sel_semester = mysql_prep($_GET['semester']);
		$sel_abs_year = mysql_prep($_GET['abs_year']);
		
		// The complete course entity corresponding to that course .. 
		$course_entity = get_course_by_key($sel_course_id, $sel_semester, $sel_abs_year);	// returns the record(or the fetch array) corresponding to the given course id..
		
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
		$name	=	$_SESSION['name'] ;
		$webmail_id = $_SESSION['webmail_id'];
		$instructor_id = $_SESSION['instructor_id'] ;
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

<script>
function delete_failed()
{
	alert("You do not have permissions to Delete this File!");
}
function delete_success()
{
	alert("File Successfully Deleted !");
}
function report_failed()
{
	alert("You have already reported spam for this file !");
}
</script>
</head>
<body id="page3">
<!-- START PAGE SOURCE -->
<div class="wrap">
  <header>
    <div class="container">
      <nav>
        <ul>
		  <li><a href="main_page.php" class="m1">Home Page</a></li>
          <li><?php echo "<a href=\"course_page.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \" class=\"m1\" > Course Page </a> " ; ?></li>
          <li class="current"><?php echo "<a href=\"course_files.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \" class=\"m2\" > Files </a> " ; ?></li>
          <li><?php echo "<a href=\"course_threads.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \" class=\"m3\" > Threads </a> " ; ?></li>
        </ul>
		<h2><?php echo $course_entity['course_name']. " - ". $course_entity['course_id']   ?> </h2>
      </nav>
      <form action="#" id="search-form">
        <fieldset>
          <div class="rowElem">
            <input type="text">
            <a href="#">Search</a></div>
        </fieldset>
      </form>
    </div>
  </header>
  <div class="container">
    <aside>
      <h3>Categories</h3>
      <ul class="categories">
        <li><span><a href="courses.php">Courses</a></span></li>
        <li><span><a href="profile.php">Personal Profile</a></span></li>
        <li><span><a href="#">Course Info</a></span></li>
        <li><span><a href="#">Description</a></span></li>
        <li><span><a href="#">Administrators</a></span></li>
        <li><span><a href="#">Basic Information</a></span></li>
       <li><span><?php echo "<a href=\"quiz.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \" class=\"m3\" > Quiz </a> " ; ?></span></li>
        <li class="last"><span><a href="logout.php">Logout</a></span></li>
      </ul>
      <form action="#" id="newsletter-form">
        <fieldset>
          <div class="rowElem">
            <h2>Newsletter</h2>
            <input type="email" value="Enter Your Email Here" onFocus="if(this.value=='Enter Your Email Here'){this.value=''}" onBlur="if(this.value==''){this.value='Enter Your Email Here'}" >
            <div class="clear"><a href="#" class="fleft">Unsubscribe</a><a href="#" class="fright">Submit</a></div>
          </div>
        </fieldset>
      </form>
	 
      <h2>Fresh <span>News</span></h2>
      <ul class="news">
        <li><strong>June 30, 2010</strong>
          <h4><a href="#">Sed ut perspiciatis unde</a></h4>
          Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque. </li>
        <li><strong>June 14, 2010</strong>
          <h4><a href="#">Neque porro quisquam est</a></h4>
          Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit consequuntur magni. </li>
        <li><strong>May 29, 2010</strong>
          <h4><a href="#">Minima veniam, quis nostrum</a></h4>
          Uis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae. </li>
      </ul>
    </aside>
    <section id="content">

    <div class="inside">

	<!-- Search files UI implementation.. -->
	<?php echo "<form action=\"course_files.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \"    " ; ?> method="post" >
	<label for="file_name">File Name</label>
	<input type="text" name="string" id="string" size=10 value="<?php if(isset($_REQUEST["string"]))echo $_REQUEST["string"]; ?>" />
	<label>Uploaded by</label>
	<select name="uploader_id">
	<option value="">--</option>
		<?php
			global $connection;
			
			$sql_result = get_uploaders();
			while ($row = mysql_fetch_assoc($sql_result)) {
				echo "<option value='".$row["uploader_id"]."'".($row["uploader_id"]==$_REQUEST["uploader_id"] ? " selected" : "").">".$row["uploader_id"]."</option>";
			}
		?>
	</select>
	
	<label for="descr">Description</label>
	<input type="text" name="descr" id="descr" size=10 value="<?php if(isset($_REQUEST["descr"]))echo $_REQUEST["descr"]; ?>" />
	<input type="submit" name="button" id="button" value="Filter" />
    </label>
	<?php echo "<a href=\"course_files.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \" class=\"m2\" > reset </a> " ; ?>
    </form>
	<br/><br/><br/><br/>
	<!-- End of Search files UI implementation.. -->
	
	   <h3> Upload file </h3>
	   <?php echo "<form action=\"course_files.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \"    " ; ?>
	   method="post" enctype="multipart/form-data" >
			<p><label for="file">File to Upload:</label>
			<input type="file" name="file" id="file_id"><br></p>
			<p>Description : <input type="text" name="description"  value="" /></p>
			<input type="submit" name="submit" value="Submit">
	    </form>
		
		 <?php
		
			file_upload($sel_course_id,$sel_semester,$sel_abs_year);
				
		 ?>
		
		<?php
		
			file_delete($sel_course_id, $sel_semester, $sel_abs_year, $webmail_id);
			file_report_spam($sel_course_id, $sel_semester, $sel_abs_year, $webmail_id);
		?>
		
	   </div>
      <div class="inside">
        <h2>Track of Files..  </h2>
        <ul class="articles">
		
		 <table id="details1">
			<?php
				//$file_upload_set = get_file_uploads_of_course($sel_course_id, $sel_semester, $sel_abs_year);
				echo "<tr><span>";
				echo "<td> Name </td>";
				echo "<td> Description </td>";
				echo "<td> Uploaded by </td>";
				echo "<td> Time </td>";
				echo "</span></tr>";
				
				if (!(isset($_REQUEST["string"]) ))
				{
					$file_upload_set = get_file_uploads_of_course($sel_course_id, $sel_semester, $sel_abs_year);
				}
				else
				{
					$file_upload_set = get_search_files($sel_course_id, $sel_semester,$sel_abs_year,$_REQUEST["string"],$_REQUEST["uploader_id"],$_REQUEST["descr"]);
				}
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
						echo "<td> {$uploader_id} </td>";
						echo "<td> {$time_stamp} </td>";
								
						
					//	echo "<h4><a href=\"{$path}\"> {$name} </a> <br /> </h4></li>";
						echo "</span></tr>";
					}
					
				}
				else
				{
					echo "<p>No files have been uploaded yet for this Course !</p>" ;
				}		
				
			?>
			<li>
            <h4><a href="#">Article 2</a></h4>
            Eusus consequam vitae habitur amet nullam vitae condis phasellus sed justo. Orcivel mollis intesque eu sempor ridictum a non laorem lacingilla wisi.
			</li>
          </table>
        </ul>
      </div>
    </section>
  </div>
</div>
<footer>
  <div class="footerlink">
    <p class="lf">Copyright &copy; 2010 <a href="#">SiteName</a> - All Rights Reserved</p>
    <p class="rf"><a href="http://all-free-download.com/free-website-templates/">Free CSS Templates</a> by <a href="http://www.templatemonster.com/">TemplateMonster</a></p>
    <div style="clear:both;"></div>
  </div>
</footer>
<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->
<div align=center>This template  downloaded form <a href='http://all-free-download.com/free-website-templates/'>free website templates</a></div></body>
</html>
<?php include("includes/footer.php"); ?>