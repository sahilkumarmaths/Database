<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
	
	
		$name	=	$_SESSION['name'] ;
		$webmail_id = $_SESSION['webmail_id'];
		
	
?>

<html lang="en">
<head>
<title>CRM</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
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

<!-- This fills the message on click in the right side -->
function fill_messages(webmail_id)
{
	reply_to = webmail_id;
	var url="get_messages.php?id="+webmail_id;
	loadXMLDoc(url,function()
	{
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		document.getElementById("message_right").innerHTML=xmlhttp.responseText;
		var objDiv = document.getElementById("message_right");
			objDiv.scrollTop = objDiv.scrollHeight;
    }
  });
}

<!-- Sends the reply message by writing in the box -->
function send_message(sender_id)
{
	var message = document.getElementById("myTextarea").value;
	message = message.replace(/^\s+|\s+$/g,'');
	if(message.length == 0 || message ==="" || message=="" )
	{
		alert("Please write something");
		return;
	}
	var url="reply_messages.php?sender="+sender_id+"&reciever="+reply_to+"&text="+message;
	loadXMLDoc(url,function()
	{
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		
		fill_messages(reply_to);
    }
  });
}

<!-- Sends the new message by clicking on the new message button-->
function new_message(sender)
{
	var reciever = document.getElementById("id_reciever").value;
	var message =  document.getElementById("myTextmessage").value;
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
	if(sender == reciever)
	{
		alert("Please don't write your email address.");
		return;
	}
	
	var url="reply_messages.php?sender="+sender+"&reciever="+reciever+"&text="+message;
	loadXMLDoc(url,function(data)
	{
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		var success_status = xmlhttp.responseText;
		if(success_status.match("success"))
		{
			alert("Message sent successfully");
			window.location = "list_message.php";
			return;
		}else
		{
			alert("Check Email Address");
			return;
		}
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
          <li><a href="courses.php" class="m1">Home Page</a></li>
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
        <li><span><a href="list_message.php">Messages</a></span></li>
        <li class="last"><span><a href="logout.php">Logout</a></span></li>
      </ul>
     
    </aside>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;
		<a href="#compose_message_modal" role="button" class="btn" data-toggle="modal">New Message</a>
				
				 <div id='compose_message_modal' class='modal hide fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
								<div class='modal-body'>
									<table border='0'>
									<tr><td > To </td><td><input id='id_reciever' style="width:400px;" type="text"></input></td></tr>
									<tr><td > Message  </td><td><textarea id='myTextmessage'  style="width:400px; height:100px;" ></textarea></td></tr>
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
			
			<!-- Left side of message box-->
			<div  style="height:500px;width:42%;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;" >
				<div  id="message" >
						<?php
							$result_set = get_recent_chat($webmail_id);
							if($result_set<>NULL)
							{
								while ($message_result = mysql_fetch_array($result_set)) 
									{
										$sender_name = $message_result['webmail_id_sender'];
										$message = $message_result['message'];
										$time_stamp = $message_result['time_stamp'];
										
											echo"<div class='high'>";
												echo "<div onclick=\"fill_messages('{$sender_name}');\"  > ";
											
												echo "<div  width='100px' class='sender_name'>{$sender_name}</div>";
												echo "<div  class='time_stamp'>{$time_stamp}</div>";
												echo "</div>";
											
												echo "<div onclick= fill_messages('{$sender_name}');  >";
												echo "<div >{$message}</div>";
												echo "<div></div>";
												echo "</div>";
											echo "</div>";
											echo "<div >------------------------------------------------</div>";

									}	
							}
						?>

					</div>
				
			</div>

      </div>
    </section>
  </div>
</div>

<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->

</html>
<?php include("includes/footer.php"); ?>
