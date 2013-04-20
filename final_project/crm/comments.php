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
<title>CRM</title><meta charset="utf-8">
  <!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="css/table_styles.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_300.font.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_400.font.js"></script>
<script type="text/javascript" src="js/script.js"></script>
    <!-- Bootstrap -->
<script src="js/jquery.js"></script>
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


function update_comment(comment_id)
{
	var tid = "<?php echo $sel_thread_id; ?>";
	var comment_text_id = "myTextarea"+comment_id.toString();
	//alert(comment_text_id);
	var comment_text = document.getElementById(comment_text_id).value;
	//alert(comment_text);
	var url="update_comment.php?id="+comment_id.toString()+"&text="+comment_text;
	
	var redirection = "comments.php?thread_id="+tid;
	loadXMLDoc(url,function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		var field = "edited_comment"+comment_id.toString();
		//alert(redirection);
		window.location=redirection;
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
		  <li><a href="courses.php" class="m1">Home Page</a></li>
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
        <h2><?php echo $thread_name. " - ". $sel_thread_id  ?>  </h2>		
        
		
		<!-- <table id = "details" > -->
		<table id="hor-minimalist-b" summary="Comments">
			<tr><span>
				<th>S.No.</th>
				<th>Comment </th>
				<th>Author </th><th></th><th></th><th><br/><br/></th>
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
							echo "<a href='#edit_comment_modal{$comment['comment_id']}' role='button' class='btn' data-toggle='modal'><img src='images/edit-1.png' alt=\"Edit\" width = '15' height ='15'  ></a>";

						$modal_str = "		
							<td id='td_element'>
								<div id='edit_comment_modal{$comment['comment_id']}' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
								<div class='modal-body'>
								<textarea id='myTextarea{$comment['comment_id']}' style='height:300px;width:500px;'>{$comment["comment_text"]}</textarea>
								<div class='modal-footer'>
								<button class='btn' data-dismiss='modal' aria-hidden='true'>Close</button>
								<button class='btn btn-primary' type='button' onclick='update_comment({$comment['comment_id']})'>Edit</button>
								</div>
								</div>
							<br/><br/><td/>
								";

						echo $modal_str;		
							}
							echo "<br/><br/></td>";
					}
					else
						{
							echo"<td> </td>
							<td> <br/><br/></td>";
						}
					
					echo "</span></tr>";
					echo "<div id=\"myDiv\"></div>";
				
				$i++;
			 }
			?> 
		</table>
		   <?php echo "<form action=\"comments.php?thread_id=".urlencode($sel_thread_id)." \"    " ; ?>
				method="post" enctype="multipart/form-data" >
				
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<textarea id="text_area" rows="4" cols="100" name ="comment_text" ></textarea>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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

<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->

</html>
<?php include("includes/footer.php"); ?>