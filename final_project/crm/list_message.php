<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
	
	if($_SESSION['person_type'] == 'student')
	{
		$name	=	$_SESSION['name'] ;
		$webmail_id = $_SESSION['webmail_id'];
		$roll_no =	$_SESSION['roll_no'] ;
		$semester = $_SESSION['semester'];
		$abs_year = $_SESSION['abs_year'] ;
		$abs_semester =	$_SESSION['abs_semester'];
		$course_set = get_courses_for_student($webmail_id);
	}
?>

<html lang="en">
<head>
<title>Student's Site | Articles</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_300.font.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_400.font.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript">

var xmlhttp;
var reply_to;				// To be sent to the reply
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


function fill_messages(webmail_id)
{
	reply_to = webmail_id;
	var url="get_messages.php?id="+webmail_id;
	loadXMLDoc(url,function()
	{
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("message_right").innerHTML=xmlhttp.responseText;
    }
  });
}
function send_message(sender_id)
{
	var message = document.getElementById("myTextarea").value;
	message = message.replace(/^\s+|\s+$/g,'');
	if(message.length == 0 || message ==="" || message=="" )
	{
		alert("hjellsdf");
		return;
	}
	alert(message);
	var url="reply_messages.php?sender="+sender_id+"&reciever="+reply_to+"&text="+message;
	alert(url);
	loadXMLDoc(url,function()
	{
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		fill_messages(reply_to);
    }
  });
  
  //fill_messages(reply_to);
}


function new_message(sender)
{
	var reciever = document.getElementById("id_reciever").value;
	var message =  document.getElementById("myTextmessage").value;
	alert(message);
	message = message.replace(/^\s+|\s+$/g,'');
	reciever = reciever.replace(/^\s+|\s+$/g,'');
	
	if(reciever == "")
	{
		alert("Please write some Sender name");
		return;
	}
	else if(message == "")
	{
		alert("Please write some message.");
		return;
	}
	
	var url="reply_messages.php?sender="+sender+"&reciever="+reciever+"&text="+message;
	loadXMLDoc(url,function()
	{
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		alert("Message sent successfully");
		window.location = "list_message.php";
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
      <h1><a href="#">Student's site</a></h1>
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
        <li><span><a href="list_message.php">Messages</a></span></li>
        <li><span><a href="#">Descriptions</a></span></li>
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
		<a href="#compose_message_modal" role="button" class="btn" data-toggle="modal">New Message</a>
				
				 <div id='compose_message_modal' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
								<div class='modal-body'>
									<table border='0'>
									<tr><td > To: </td><td><input id='id_reciever' style="width:400px;" type="text"></input></td></tr>
									<tr><td > Message : </td><td><textarea id='myTextmessage'  style="width:400px; height:100px;" ></textarea></td></tr>
									</table>
									</div>
									<div class='modal-footer'>
									<button class='btn' data-dismiss='modal' aria-hidden='true'>Cancel</button>
									<button class='btn btn-primary' type='button' onclick="new_message( <?php echo "'".$webmail_id."'"; ?> )">Send</button>
								</div>
				</div>
    <section id="content">
     
      <div class="inside">
		
			<div id="message_right" class="message_right" style="height:500px;width:57%;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;float:right;" >
			
			</div>
			
			<div  style="height:500px;width:42%;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;" >
				
				
					<table  id="message" >
						<?php
							
							$result_set = get_recent_chat($webmail_id);
							if($result_set<>NULL)
							{
								while ($message_result = mysql_fetch_array($result_set)) 
									{
										$sender_name = $message_result['webmail_id_sender'];
										$message = $message_result['message'];
										$time_stamp = $message_result['time_stamp'];
										
										//echo "<div  id =\"edited_comment{$message_result['webmail_id_sender']}\" > ";
											echo "<tr onclick=\"fill_messages('{$sender_name}');\">";
											
											echo "<td  width='100px'>{$sender_name}</td>";
											echo "<td align='right'>{$time_stamp}</td>";
											echo "</tr>";
											
											echo "<tr onclick= fill_messages('{$sender_name}');>";
											echo "<td colspan='2'>{$message}</td>";
											echo "<td></td>";
											echo "</tr>";
											echo "<tr><td colspan='2'>--------------------------------------</td></tr>";
										//echo "</div>";
									}
									
									
							}
						?>
					</table>
				
			</div>

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