<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
	// Get the corresponding course entity from the database.. 
	if (!(isset($_GET['thread_id']) ))
	{
		redirect_to("course_threads.php");
	}
	
	if(isset($_GET['thread_id']))
	{
		// These are the primary keys.. corresponding to the course page.. 
		$sel_thread_id = mysql_prep($_GET['thread_id']);
		$thread_comments = get_thread_comments($sel_thread_id);
		$thread_details = get_thread_details($sel_thread_id);
		
		
		
		while ($row = mysql_fetch_array($thread_details))
		{
			$thread_name = $row['thread_name'];
			$thread_creator = $row['webmail_id'];
		}
		
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
<title>Thread | Comments</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_300.font.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_400.font.js"></script>
<script type="text/javascript" src="js/script.js"></script>

<script type="text/javascript">

var xmlhttp;
function loadXMLDoc(url,cfunc)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=cfunc;
xmlhttp.open("GET",url,true);
xmlhttp.send();
}


function edit_comment(comment_id)
{
var url="edit_box.php?id="+comment_id.toString();
loadXMLDoc(url,function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  });
}

function update_comment(comment_id)
{
	var url="update_comment.php?id="+comment_id.toString()+"&text="+document.getElementById("myTextarea").value;
	loadXMLDoc(url,function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		var field = "edited_comment"+comment_id.toString();
		alert(field);
		document.getElementById(field).innerHTML=xmlhttp.responseText;
		document.getElementById("myDiv").innerHTML="";
		}
	  });
}
function delete_comment(comment_id)
{
	var url="delete_comment.php?id="+comment_id.toString();
	loadXMLDoc(url,function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		var field = "table_row"+comment_id.toString();
		document.getElementById(field).style.display = 'none';
		}
	  });

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
      <nav>
        <ul>
		  <li><a href="main_page.php" class="m1">Home Page</a></li>
        </ul>
		
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
        <li><span><a href="#">Vacancies</a></span></li>
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
        <h2><?php echo $thread_name. " - ". $sel_thread_id  ?>  </h2>		
        
		
		<table id = "details" >
			<tr><span>
				<th>S.No.</th>
				<th>Comment </th>
				<th>Author <br/><br/></th>
				</span>
			</tr>
			<?php 
			  $i = 1;
			  while ($comment = mysql_fetch_array($thread_comments)) 
			  {
				echo "<tr id='table_row{$comment['comment_id']}' ><span>";
					echo "<td>".$i."</td>";
					echo "<td id = \"edited_comment{$comment['comment_id']}\">".$comment["comment_text"]."</td>";
					echo "<td>".$comment["webmail_id"]."</td>";
					if($comment["webmail_id"]==$webmail_id || $_SESSION['person_type'] == 'instructor' )
					{
							echo "<td><img src='images/del-4.png' alt=\"delete\" onclick = \"delete_comment({$comment['comment_id']})\" width = '20' height ='20'>";
							if($comment["webmail_id"]==$webmail_id)
							{
								echo "<img src='images/edit-1.png' alt=\"Edit\" onclick = \"edit_comment({$comment['comment_id']})\" width = '25' height ='25'  >";
							}
							echo "<br/><br/></td>";
					}
					
					echo "</span></tr>";
					echo "<div id=\"myDiv\"></div>";
				
				$i++;
			 }
			?> 
        </table>
		
		 	<br/>
		   <?php echo "<form action=\"comments.php?thread_id=".urlencode($sel_thread_id)." \"    " ; ?>
				method="post" enctype="multipart/form-data" >
				
				<textarea cols="81" rows="1" name ="comment_text" ></textarea>
				<input type="submit" name="submit" value="Comment">
				
			</form>
		
			 <?php
				if (isset($_POST['submit']))
				{
					$query = "INSERT INTO `crm_db`.`comments` (`comment_id`, `webmail_id`, `comment_text`, `thread_id`)
					VALUES (NULL, '".$_SESSION['webmail_id']."', '".$_POST['comment_text']."', '".$sel_thread_id."'); ";
					$res=mysql_query($query);
					$location = "comments.php?thread_id=".urlencode($sel_thread_id);
					redirect_to($location);
				}
			?>
			
	  
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