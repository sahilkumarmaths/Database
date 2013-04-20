<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	if(isset($_POST['submit']))
	{
		$name = trim(mysql_prep($_POST['name']));
		$webmail_id = trim(mysql_prep($_POST['webmail_id']));
		$roll_no = trim(mysql_prep($_POST['roll_no']));
		$semester= trim(mysql_prep($_POST['semester']));
		$abs_semester= trim(mysql_prep($_POST['abs_semester']));
		$abs_year = trim(mysql_prep($_POST['abs_year']));
		$hashed_password = sha1($webmail_id);
		$query = "insert into person values ('{$webmail_id}', '{$hashed_password}' )";
		$result_set = mysql_query($query);
		//confirm_query($result_set);
		if(!$result_set)
		{
			$error = "Inserting into Database failed.. check for the correctness of data inserted !";
			
		}
		
		$query1 = "insert into student values ('{$webmail_id}', '{$name}', '{$roll_no}', {$semester}, {$abs_semester} , {$abs_year})";
		$result_set1 = mysql_query($query1);
		if(!$result_set1)
		{
			if(!isset($error))
				$error = "Inserting into Database failed.. check for the correctness of data inserted !";
		}
	}


?>

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
<body id="page1">
<!-- START PAGE SOURCE -->
<div class="wrap">
  <header>
    <div class="container">
      
      <h1><a href="#">Student's site</a></h1>
      <nav>
        <ul>
         <li><a href="admin_profile.php" class="m1">Main Page</a></li>
         
         
        </ul>
      </nav>
	  
      
    </div>
  </header>
  <div class="container">
    <aside>
      <h3>Categories</h3>
      <ul class="categories">
         <li><span><a href="admin_profile.php">Personal Profile</a></span></li>
		<li><span><a href="admin_add_course.php">Add a Course</a></span></li>
		<li><span><a href="admin_add_course_offering.php">Add a Course Offering</a></span></li>
        <li><span><a href="admin_add_student.php">Add a Student</a></span></li>
        <li><span><a href="admin_add_instructor.php">Add an Instructor</a></span></li>
		<li><span><a href="admin_reg_instructor.php">Register an Instructor for a course</a></span></li><br />
		<li><span><a href="admin_reg_student.php">Register a Student for a course</a></span></li><br />
        <li class="last"><span><a href="logout.php">Logout</a></span></li>
      </ul>
      
     
    </aside>
    <section id="content">
      
      <div class="inside">
	  <h2> Add a Student</h2>
		<form action="admin_add_student.php" method="post">
			<table>
				<tr>
					<td>Student Name :</td>
					<td><input type="text" name="name" maxlength="30" value="" /></td>
				</tr>
				<tr>
					<td>Webmail id :</td>
					<td><input type="text" name="webmail_id" maxlength="30" value="" /></td>
					<td>(Ex: p.dileep)</td>
				</tr>
				<tr>
					<td>Roll no :</td>
					<td><input type="text" name="roll_no" maxlength="30" value="" /></td>
					<td>(Ex: 10010180)</td>
				</tr>
				<tr>
					<td>Semester :</td>
					<td><input type="text" name="semester" maxlength="30" value="" /></td>
					<td>(The semester of study, Ex: 6th semester)</td>
				</tr>
				<tr>
					<td>Absoulte Semester:</td>
					<td><input type="text" name="abs_semester" maxlength="30" value="" /></td>
					<td>(The absolute semester,Ex: 1st semester of the year 2013)</td>
				</tr>
				<tr>
					<td>Absoulte year :</td>
					<td><input type="text" name="abs_year" maxlength="30" value="" /></td>
					<td>(The absolute year: Ex: 2013)</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" value="Submit" /></td>
				</tr>
			</table>
		</form>
        <?php
			if(isset($error))
			{
				echo "<p>{$error}</p>";
			
			}
			else
			{
				if(isset($_POST['submit']))
				echo "<p> Successfully inserted Student !</p>";
			
			
			}
		?>
        
      </div>
    </section>
  </div>
</div>

<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->

</html>
<?php include("includes/footer.php"); ?>