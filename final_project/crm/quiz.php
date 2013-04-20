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
	else
	{
		redirect_to("course_page.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year));

	}	
	$checking_written = get_quiz_entry($webmail_id);
	if($checking_written)
	{
		redirect_to("quiz_attempted.php");
	}

?>


<html lang="en">
<head>
<title>CRM</title>
<meta charset="utf-8">
<style type = "text/css">
.hidden
{
display:none;
}
.unhidden
{
display:block;
}
</style>
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

var mins
var secs;
var total_score=0;
function cd() {
    mins = 1 * m("1"); // change minutes here
    secs = 0 + s(":01"); // change seconds here (always add an additional second to your total)
    redo();
}

function m(obj) {
    for(var i = 0; i < obj.length; i++) {
        if(obj.substring(i, i + 1) == ":")
        break;
    }
    return(obj.substring(0, i));
}

function s(obj) {
    for(var i = 0; i < obj.length; i++) {
        if(obj.substring(i, i + 1) == ":")
        break;
    }
    return(obj.substring(i + 1, obj.length));
}

function dis(mins,secs) {
    var disp;
    if(mins <= 9) {
        disp = " 0";
    } else {
        disp = " ";
    }
    disp += mins + ":";
    if(secs <= 9) {
        disp += "0" + secs;
    } else {
        disp += secs;
    }
    return(disp);
}

function redo() {
    secs--;
    if(secs == -1) {
        secs = 59;
        mins--;
    }
    document.counter.disp.value = dis(mins,secs); // setup additional displays here.
    if((mins == 0) && (secs == 0)) {
		total("");
         window.location = "quiz_attempted.php" // redirects to specified page once timer ends and ok button is pressed
    } else {
        cds = setTimeout("redo()",1000);
    }
}

function init() {
  cd();
return;
}


    function startTime()
    {
    var today=new Date()
    var h=today.getHours()
    var m=today.getMinutes()
    var s=today.getSeconds()
    // add a zero in front of numbers<10
    m=checkTime(m)
    s=checkTime(s)
    document.getElementById('txt').innerHTML=h+":"+m+":"+s
    t=setTimeout('startTime()',500)       //DON'T UNDERSTAND THIS


    }
     
    function checkTime(i)                 //DON'T UNDERSTAND THIS FUNCTION       
    {
    if (i<10) 
      {i="0" + i}
      return i
    }



function startquiz()
{
	init();
	var item = document.getElementById("one");
 if (item) {
 item.className=(item.className=='hidden')?'unhidden':'hidden';
 }

 var item = document.getElementById("zero");
 if (item) {
 item.className=(item.className=='unhidden')?'hidden':'unhidden';
 }
return
}

function firstAnswer(ans)
  {
	  

    for (i=0 ; i<document.first.quiz.length ; i++)
    {
		if (document.first.quiz[i].checked==true)
		{
			
			var t = document.first.quiz[i].value
		}
	}


if (t == ans )
 {
  document.getElementById("txt1").value = "5"
  total_score+=1
  }
else  {
   document.getElementById("txt1").value = "0"
}
 var item = document.getElementById("two");
 if (item) {
 item.className=(item.className=='hidden')?'unhidden':'hidden';
 }

 var item = document.getElementById("one");
 if (item) {
 item.className=(item.className=='unhidden')?'hidden':'unhidden';
 }
return
}




function secondAnswer(ans)
  {

    for (i=0 ; i<document.second.quiz.length ; i++)
         {
              if (document.second.quiz[i].checked==true)
           {
              var t = document.second.quiz[i].value
           }
 }

if (t == ans )
 {
  document.getElementById("txt2").value = "5"
    total_score+=1

  }
else  {
   document.getElementById("txt2").value = "0"
}
 var item = document.getElementById("three");
 if (item) {
 item.className=(item.className=='hidden')?'unhidden':'hidden';
 }

 var item = document.getElementById("two");
 if (item) {
 item.className=(item.className=='unhidden')?'hidden':'unhidden';
 }
return
}


function thirdAnswer(ans)
  {

    for (i=0 ; i<document.third.quiz.length ; i++)
         {
              if (document.third.quiz[i].checked==true)
           {
              var t = document.third.quiz[i].value
           }
 }

if (t == ans )
 {
  document.getElementById("txt3").value = "5"
    total_score+=1

  }
else  {
   document.getElementById("txt3").value = "0"
}
 var item = document.getElementById("four");
 if (item) {
 item.className=(item.className=='hidden')?'unhidden':'hidden';
 }

 var item = document.getElementById("three");
 if (item) {
 item.className=(item.className=='unhidden')?'hidden':'unhidden';
 }
return
}



function fourAnswer(ans)
  {

    for (i=0 ; i<document.four.quiz.length ; i++)
         {
              if (document.four.quiz[i].checked==true)
           {
              var t = document.four.quiz[i].value
           }
 }

if (t == ans )
 {
  document.getElementById("txt4").value = "5"
    total_score+=1

  }
else  {
   document.getElementById("txt4").value = "0"
}
 var item = document.getElementById("five");
 if (item) {
 item.className=(item.className=='hidden')?'unhidden':'hidden';
 }

 var item = document.getElementById("four");
 if (item) {
 item.className=(item.className=='unhidden')?'hidden':'unhidden';
 }
return
}



function fiveAnswer(ans)
  {

    for (i=0 ; i<document.five.quiz.length ; i++)
         {
              if (document.five.quiz[i].checked==true)
           {
              var t = document.five.quiz[i].value
           }
 }

if (t == ans )
 {
  document.getElementById("txt5").value = "5"
    total_score+=1

  }
else  {
   document.getElementById("txt5").value = "0"
}
 var item = document.getElementById("six");
 if (item) {
 item.className=(item.className=='hidden')?'unhidden':'hidden';
 }

 var item = document.getElementById("five");
 if (item) {
 item.className=(item.className=='unhidden')?'hidden':'unhidden';
 }
return
}


function sixAnswer(ans)
  {

    for (i=0 ; i<document.six.quiz.length ; i++)
         {
              if (document.six.quiz[i].checked==true)
           {
              var t = document.six.quiz[i].value
           }
       }

if (t == ans )
 {
  document.getElementById("txt6").value = "5"
    total_score+=1

  }
else  {
   document.getElementById("txt6").value = "0"
}
 var item = document.getElementById("seven");
 if (item) {
 item.className=(item.className=='hidden')?'unhidden':'hidden';
 }

 var item = document.getElementById("six");
 if (item) {
 item.className=(item.className=='unhidden')?'hidden':'unhidden';
 }
return
}

function sevenAnswer(ans)
  {

    for (i=0 ; i<document.seven.quiz.length ; i++)
         {
              if (document.seven.quiz[i].checked==true)
           {
              var t = document.seven.quiz[i].value
           }
       }

if (t == ans )
 {
  document.getElementById("txt7").value = "5"
    total_score+=1

  }
else  {
   document.getElementById("txt7").value = "0"
}
 var item = document.getElementById("eight");
 if (item) {
 item.className=(item.className=='hidden')?'unhidden':'hidden';
 }

 var item = document.getElementById("seven");
 if (item) {
 item.className=(item.className=='unhidden')?'hidden':'unhidden';
 }
return
}


function eightAnswer(ans)
  {

    for (i=0 ; i<document.eight.quiz.length ; i++)
         {
              if (document.eight.quiz[i].checked==true)
           {
              var t = document.eight.quiz[i].value
           }
       }

if (t == ans )
 {
  document.getElementById("txt8").value = "5"
    total_score+=1

  }
else  {
   document.getElementById("txt8").value = "0"
}
 var item = document.getElementById("nine");
 if (item) {
 item.className=(item.className=='hidden')?'unhidden':'hidden';
 }

 var item = document.getElementById("eight");
 if (item) {
 item.className=(item.className=='unhidden')?'hidden':'unhidden';
 }
return
}


function nineAnswer(ans)
  {

    for (i=0 ; i<document.nine.quiz.length ; i++)
         {
              if (document.nine.quiz[i].checked==true)
           {
              var t = document.nine.quiz[i].value
           }
       }

if (t == ans )
 {
  document.getElementById("txt9").value = "5"
    total_score+=1

  }
else  {
   document.getElementById("txt9").value = "0"
}
 var item = document.getElementById("ten");
 if (item) {
 item.className=(item.className=='hidden')?'unhidden':'hidden';
 }

 var item = document.getElementById("nine");
 if (item) {
 item.className=(item.className=='unhidden')?'hidden':'unhidden';
 }
return
}

function tenAnswer(ans)
  {

    for (i=0 ; i<document.ten.quiz.length ; i++)
         {
              if (document.ten.quiz[i].checked==true)
           {
              var t = document.ten.quiz[i].value
           }
       }

if (t == ans )
 {
  document.getElementById("txt10").value = "5"
    total_score+=1

  }
else  {
   document.getElementById("txt10").value = "0"
}
var item = document.getElementById("helo");
item.className=(item.className=='hidden')?'unhidden':'hidden';
return
}

function total(ten_ans)
{
tenAnswer(ten_ans)
var a = parseInt(document.getElementById("txt1").value)
var b = parseInt(document.getElementById("txt2").value)
var c = parseInt(document.getElementById("txt3").value)
var d = parseInt(document.getElementById("txt4").value)
var e = parseInt(document.getElementById("txt5").value)
var f = parseInt(document.getElementById("txt6").value)
var g = parseInt(document.getElementById("txt7").value)
var h = parseInt(document.getElementById("txt8").value)
var i = parseInt(document.getElementById("txt9").value)
var j = parseInt(document.getElementById("txt10").value)
var k = a + b + c + d + e + f + g + h + i + j

var cid = <?php echo "'".$sel_course_id."'" ?>;


var url="quiz_database.php?a="+a.toString()+"&b="+b.toString()+"&"+"&c="+c.toString()+"&"+"&d="+d.toString()+"&"+"&e="+e.toString()+"&"+"&f="+f.toString()+"&"+"&g="+g.toString()+"&"+"&h="+h.toString()+"&"+"&i="+i.toString()+"&"+"&j="+j.toString()+"&"+"&k="+k.toString()+"&cid="+cid.toString();
loadXMLDoc(url,function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  });

document.getElementById("txt").value = k
alert("your score is "+k+" out of 50 ");
         window.location = "quiz_attempted.php" // redirects to specified page once timer ends and ok button is pressed
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
        <li class="last"><span><a href="logout.php">Logout</a></span></li>
      </ul>
	 <div id="myDiv"></div>
      
    </aside>
    <section id="content">
       <div class="inside">


<h2>Quiz</h2>
<form name="counter">
<input id="txt" readonly="true" size=5 type="text" value="" border="" name="disp" disabled>
</form>


	<div id = "zero" class = "unhidden">
<form name = "zero"  >
<br/>
Rules go here<br/><br/>
1) Don't Refresh in the middle of the quiz<br/><br/>
2) Once you submit first question you cant change its answer - This is format<br/><br/>

<input type = "button" value = "next" onclick = "startquiz()">
<input type = "hidden" id = "txt0">

</form>
</div>


<div id = "one" class = "hidden">
<form name = "first"  >
	
<?php
fetch_question(1);
	 
$retun = get_answer(1);

?>



<input type = "button" value = "next" onclick = "firstAnswer( <?php echo "'".$retun."'" ?>)">
<input type = "hidden" id = "txt1">
</form>
</div>

<div  class = "hidden" id = "two">
<form name = "second" >
	<?php
fetch_question(2);
$retun = get_answer(1);
?>
<input type = "button" value = "next" onclick = "secondAnswer(<?php echo "'".$retun."'" ?>)">
<input type = "hidden" id = "txt2">
</form>
</div>

<div class = "hidden" id = "three">
<form name = "third" >
<?php
fetch_question(3);
$retun = get_answer(1);
?>
<input type = "button" value = "next" onclick = "thirdAnswer(<?php echo "'".$retun."'" ?>)">
<input type = "hidden" id = "txt3">
</form>
</div>

<div class = "hidden" id = "four">
<form name = "four" >
<?php
fetch_question(4);
$retun = get_answer(1);
?>
<input type = "button" value = "next" onclick = "fourAnswer(<?php echo "'".$retun."'" ?>)">
<input type = "hidden" id = "txt4">
</form>
</div>

<div class = "hidden" id = "five">
<form name = "five" >
<?php
fetch_question(5);
$retun = get_answer(1);
?>
<input type = "button" value = "next" onclick = "fiveAnswer(<?php echo "'".$retun."'" ?>)">
<input type = "hidden" id = "txt5">
</form>
</div>

<div class = "hidden" id = "six">
<form name = "six" >
<?php
fetch_question(6);
$retun = get_answer(1);
?>
<input type = "button" value = "next" onclick = "sixAnswer(<?php echo "'".$retun."'" ?>)">
<input type = "hidden" id = "txt6">
</form>
</div>

<div class = "hidden" id = "seven">
<form name = "seven" >
<?php
fetch_question(7);
$retun = get_answer(1);
?>
<input type = "button" value = "next" onclick = "sevenAnswer(<?php echo "'".$retun."'" ?>)">
<input type = "hidden" id = "txt7">
</form>
</div>

<div class = "hidden" id = "eight">
<form name = "eight" >
<?php
fetch_question(8);
$retun = get_answer(1);
?>
<input type = "button" value = "next" onclick = "eightAnswer(<?php echo "'".$retun."'" ?>)">
<input type = "hidden" id = "txt8">
</form>
</div>

<div class = "hidden" id = "nine">
<form name = "nine" >
<?php
fetch_question(9);
$retun = get_answer(1);
?>
<input type = "button" value = "next" onclick = "nineAnswer(<?php echo "'".$retun."'" ?>)">
<input type = "hidden" id = "txt9">
</form>
</div>

<div class = "hidden" id = "ten">
<form name = "ten" >
<?php
fetch_question(10);
$retun = get_answer(1);
?>
<input type = "hidden" value = "next" onclick = "tenAnswer(<?php echo "'".$retun."'" ?>)" id = "helo" class = "heloo">
<input type = "hidden" id = "txt10">
</form>
<input type = "hidden" id = "txt">
<input type = "button" value = "score"  onclick = "total(<?php echo "'".$retun."'" ?>)">
</div>

          </table>
        </ul>
      </div>
    </section>
  </div>
</div>
<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->
</body>


</html>
<?php include("includes/footer.php"); ?>
