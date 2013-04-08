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
<title>Student's Site</title>
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
<body id="page1">
<!-- START PAGE SOURCE -->
<div class="wrap">
  <header>
    <div class="container">
      
      <nav>
        <ul>
		  <li><a href="main_page.php" class="m1">Home Page</a></li>
          <li class="current"><?php echo "<a href=\"course_page.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \" class=\"m1\" > Course Page </a> " ; ?></li>
          <li><?php echo "<a href=\"course_files.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \" class=\"m2\" > Files </a> " ; ?></li>
          <li><?php echo "<a href=\"course_threads.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \" class=\"m3\" > Threads </a> " ; ?></li>
          
        </ul>
		
		<h2><?php echo $course_entity['course_name']. " - ". $course_entity['course_id']   ?> </h2>
		
      </nav>
      <form action="#" id="search-form">
        <fieldset>
          <div class="rowElem">
            <input type="text">
            <a href="#">Search Course</a></div>
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
        <li><span><a href="#">Vacancies</a></span></li>
        <li class="last"><span><a href="logout.php">Logout</a></span></li>
      </ul>
      <h2>Latest <span>Updates</span></h2>
      <ul class="news">
	  
	  <?php
			while ($news = mysql_fetch_array($course_news)) 
			  {			
				echo "<li><strong>{$news['news_text']}</strong></li>";
				
			  }
	?>
      </ul>
    </aside>
    <section id="content">
     
      <div class="inside">
		<p> Course Instructor : </p>
	
			
		
        <h2>Recent <span>Files</span></h2>	
        <ul class="list">
          <li><span><img src="images/icon1.png"></span>
            <h4>About Template</h4>
            <p>Eusus consequam vitae habitur amet nullam vitae condis phasellus sed justo. Orcivel mollis intesque eu sempor ridictum a non laorem lacingilla wisi.</p>
          </li>
          <li><span><img src="images/icon2.png"></span>
            <h4>Branch Office</h4>
            <p>Eusus consequam vitae habitur amet nullam vitae condis phasellus sed justo. Orcivel mollis intesque eu sempor ridictum a non laorem lacingilla wisi.</p>
          </li>
          <li class="last"><span><img src="images/icon3.png"></span>
            <h4>Student’s Time</h4>
            <p>Eusus consequam vitae habitur amet nullam vitae condis phasellus sed justo. Orcivel mollis intesque eu sempor ridictum a non laorem lacingilla wisi.</p>
          </li>
        </ul>
        
	 </div>
    </section>
  </div>
</div>
<footer>
  <div class="footerlink">
    <p class="lf">Copyright &copy; 2010 <a href="#">SiteName</a> - All Rights Reserved</p>
    <p class="rf"><a href="http://all-free-download.com/free-website-templates/">Free CSS Templates</a> by <a href="http://in.linkedin.com/in/venkatsai101">Venkat Sai</a></p>
    <div style="clear:both;"></div>
  </div>
</footer>
<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->
<div align=center>This template  downloaded form <a href='http://all-free-download.com/free-website-templates/'>free website templates</a></div></body>
</html>
