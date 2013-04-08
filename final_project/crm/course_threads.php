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
		$course_entity = get_course_by_key($sel_course_id, $sel_semester, $sel_abs_year);	// returns the record(or the fetch array) corresponding to the given subject id..
		$course_threads = get_threads_of_course($sel_course_id, $sel_semester, $sel_abs_year);
		
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
<title>Student's Site | Articles</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_300.font.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_400.font.js"></script>
<script type="text/javascript" src="js/script.js"></script>
    <!-- Bootstrap -->
<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
	

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


function edit_thread(thread_id , counter)
{
var url="edit_thread.php?id="+thread_id.toString()+"&counter="+counter.toString();
alert(url);
loadXMLDoc(url,function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  });
}

function update_thread(thread_id , counter)
{
	var url="update_thread.php?id="+thread_id.toString()+"&t_name="+document.getElementById("th_name").value+"&t_desc="+document.getElementById("myTextarea").value+"&counter="+counter.toString();
	//var url="update_comment.php?id="+comment_id.toString()+"&text="+document.getElementById("myTextarea").value;
	
	
	alert(url);
	loadXMLDoc(url,function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		var field = "thread_row"+thread_id.toString();
		alert(field);
		document.getElementById(field).innerHTML=xmlhttp.responseText;
		document.getElementById("myDiv").innerHTML="";
		}
	  });
}
function delete_thread(thread_id)
{
	var url="delete_thread.php?id="+thread_id.toString();
	loadXMLDoc(url,function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		var field = "thread_row"+thread_id.toString();
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
          <li><?php echo "<a href=\"course_page.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \" class=\"m1\" > Course Page </a> " ; ?></li>
          <li><?php echo "<a href=\"course_files.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \" class=\"m2\" > Files </a> " ; ?></li>
          <li class="current"><?php echo "<a href=\"course_threads.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \" class=\"m3\" > Threads </a> " ; ?></li>
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
	<!-- Modal  added by shaarth -->	
	<a href="#myModal" role="button" class="btn" data-toggle="modal">Create a new Thread</a>
		
			<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-body">	
				<?php echo "<form action=\"course_threads.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \"    " ; ?>
			method="post" enctype="multipart/form-data" >
			<table>
				<tr><td>Thread name: </td><td><input type="text" name="t_name"></td></tr>
				<tr><td>Description: </td><td><input cols="81" rows="1" type="text" name="t_desc"></td></tr>
				
			</table>
			</div>
				<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				<input  class="btn btn-primary" type="submit" name="submit" value="Submit">
				</div>
				 </form>
			</div>
			
	
	
	<!-- Modal  code ends -->
	
    <section id="content">
	
		<div class="inside">
		
		 <!-- 			 Search Box                      -->
		
	    <?php echo "<form action=\"course_threads.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \"    " ; ?> method="post" >
			
			<label for="thread_name">Thread Name</label>
			<input type="text" name="string" size=10 width="1px" value="<?php if(isset($_REQUEST["string"]))echo $_REQUEST["string"]; ?>" />
			
			<label>Author</label>
			<select name="author">
				<option value=""></option>
				<?php
					global $connection;
					
					$sql_result = get_authors();
					while ($row = mysql_fetch_assoc($sql_result)) 
					{
						echo "<option value='".$row["webmail_id"]."'".($row["webmail_id"]==$_REQUEST["author"] ? " selected" : "").">".$row["webmail_id"]."</option>";
					}
				?>
			</select>
			<label for="descr">Description</label>
				<input type="text" name="descr" id="descr" size=10 value="<?php if(isset($_REQUEST["descr"]))echo $_REQUEST["descr"]; ?>" />
				<input type="submit" name="button" id="button" value="Filter" />
			</label>

			<?php echo "<a href=\"course_threads.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)." \" class=\"m2\" > reset </a> " ; ?>
		</form>
	<br/><br/><br/><br/>
	
	<!-- Search Ends --->
	   
	   

		 
		 <?php
			//insert_thread($sel_course_id,$sel_semester,$sel_abs_year);
			if (isset($_POST['submit']))
			{
				//FINAL
				$query = "INSERT INTO `crm_db`.`thread` (`thread_id`, `thread_name`, `webmail_id`, `course_id`, `semester`, `year`, `description`) 
				VALUES (NULL, '".$_POST['t_name']."', '".$_SESSION['webmail_id']."', '".$sel_course_id."', '".$sel_semester."', '".$sel_abs_year."', '".$_POST['t_desc']."'); ";
				 
				$res=mysql_query($query);
				
				unset(  $_POST['submit'] );
				$new_page = "course_threads.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year);
				redirect_to($new_page);
			}

		?>
	   </div>
	   
	   
	   <div id="myDiv"></div>
		
		<div class="inside">
        <h2>Track of Threads..  </h2>
		
		
		<!-- Search Results -->
		<table id="details">
			<?php
				echo "<tr><span>";
				echo "<th> S. No.</th>";
				echo "<th> Thread Name </th>";
				echo "<th> Author</th>";
				echo "<th> Description</th><th> <br/><br/></th>";
				echo "</span></tr>";
				
				if(isset($_REQUEST["string"]))
					$thread_name_set = $_REQUEST["string"];
				else
					$thread_name_set = "";
			
				if(isset($_REQUEST["author"]))
					$author_name_set = $_REQUEST["author"];
				else
					$author_name_set="";
					
				if(isset($_REQUEST["descr"]))
					$description_set = $_REQUEST["descr"];
				else
					$description_set = "";
					
				$result_set = get_search_thread($thread_name_set,$author_name_set,$description_set,$sel_course_id, $sel_semester,$sel_abs_year);
				
				$counter = 1;
				while ($thread_search = mysql_fetch_array($result_set)) 
					{
						$thread_name = $thread_search['thread_name'];
						$author_name = $thread_search['webmail_id'];
						$description = $thread_search['description'];
						
						echo "<tr  id='thread_row{$thread_search['thread_id']}' ><span>";
						echo "<td>{$counter}</td>";
						echo "<td><a href=\"comments.php?thread_id=".urlencode($thread_search["thread_id"])."\">{$thread_name}</a></td> " ;
						
						//echo "<td> {$thread_name} </td>";
						echo "<td> {$author_name} </td>";
						echo "<td> {$description}</td>";
						if($thread_search['webmail_id']==$webmail_id || $_SESSION['person_type'] == 'instructor' )
						{
							echo "<td><img src='images/del-4.png' alt=\"delete\" onclick = \"delete_thread({$thread_search['thread_id']})\" width = '20' height ='20'>";
							if($thread_search['webmail_id']==$webmail_id)
							{
								echo "<img src='images/edit-1.png' alt=\"Edit\" onclick = \"edit_thread({$thread_search['thread_id']} ,{$counter})\" width = '25' height ='25'  >";
							}
							echo "<br/><br/></td>";
						}
						
						echo "</span></tr>";
						$counter++;
					}
			?>
          </table>

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