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
	
	$checking_written = get_quiz_entry($webmail_id);
	if($checking_written)
	{
		redirect_to("quiz_attempted.php");
	}

?>


<html lang="en">
<head>
<title>Student's Site | Articles</title>
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
    document.cd.disp.value = dis(mins,secs); // setup additional displays here.
    if((mins == 0) && (secs == 0)) {
        window.alert("Time is up. Press OK to continue."); // change timeout message as required
        // window.location = "yourpage.htm" // redirects to specified page once timer ends and ok button is pressed
    } else {
        cd = setTimeout("redo()",1000);
    }
}

function init() {
  cd();
return;
}
window.onload = init;


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

function firstAnswer()

  {

    for (i=0 ; i<document.first.quiz.length ; i++)
         {
              if (document.first.quiz[i].checked==true)
           {
              var t = document.first.quiz[i].value
           }
 }

if (t == "1" )
 {
  document.getElementById("txt1").value = "5"
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




function secondAnswer()
  {

    for (i=0 ; i<document.second.quiz.length ; i++)
         {
              if (document.second.quiz[i].checked==true)
           {
              var t = document.second.quiz[i].value
           }
 }

if (t == "2" )
 {
  document.getElementById("txt2").value = "5"
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


function thirdAnswer()
  {

    for (i=0 ; i<document.third.quiz.length ; i++)
         {
              if (document.third.quiz[i].checked==true)
           {
              var t = document.third.quiz[i].value
           }
 }

if (t == "1" )
 {
  document.getElementById("txt3").value = "5"
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



function fourAnswer()
  {

    for (i=0 ; i<document.four.quiz.length ; i++)
         {
              if (document.four.quiz[i].checked==true)
           {
              var t = document.four.quiz[i].value
           }
 }

if (t == "3" )
 {
  document.getElementById("txt4").value = "5"
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



function fiveAnswer()
  {

    for (i=0 ; i<document.five.quiz.length ; i++)
         {
              if (document.five.quiz[i].checked==true)
           {
              var t = document.five.quiz[i].value
           }
 }

if (t == "2" )
 {
  document.getElementById("txt5").value = "5"
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


function sixAnswer()
  {

    for (i=0 ; i<document.six.quiz.length ; i++)
         {
              if (document.six.quiz[i].checked==true)
           {
              var t = document.six.quiz[i].value
           }
       }

if (t == "1" )
 {
  document.getElementById("txt6").value = "5"
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

function sevenAnswer()
  {

    for (i=0 ; i<document.seven.quiz.length ; i++)
         {
              if (document.seven.quiz[i].checked==true)
           {
              var t = document.seven.quiz[i].value
           }
       }

if (t == "2" )
 {
  document.getElementById("txt7").value = "5"
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


function eightAnswer()
  {

    for (i=0 ; i<document.eight.quiz.length ; i++)
         {
              if (document.eight.quiz[i].checked==true)
           {
              var t = document.eight.quiz[i].value
           }
       }

if (t == "1" )
 {
  document.getElementById("txt8").value = "5"
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


function nineAnswer()
  {

    for (i=0 ; i<document.nine.quiz.length ; i++)
         {
              if (document.nine.quiz[i].checked==true)
           {
              var t = document.nine.quiz[i].value
           }
       }

if (t == "3" )
 {
  document.getElementById("txt9").value = "5"
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

function tenAnswer()
  {

    for (i=0 ; i<document.ten.quiz.length ; i++)
         {
              if (document.ten.quiz[i].checked==true)
           {
              var t = document.ten.quiz[i].value
           }
       }

if (t == "1" )
 {
  document.getElementById("txt10").value = "5"
  }
else  {
   document.getElementById("txt10").value = "0"
}
var item = document.getElementById("helo");
item.className=(item.className=='hidden')?'unhidden':'hidden';
return
}

function total()
{
tenAnswer()
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


var url="quiz_database.php?a="+a.toString()+"&b="+b.toString()+"&"+"&c="+c.toString()+"&"+"&d="+d.toString()+"&"+"&e="+e.toString()+"&"+"&f="+f.toString()+"&"+"&g="+g.toString()+"&"+"&h="+h.toString()+"&"+"&i="+i.toString()+"&"+"&j="+j.toString()+"&"+"&k="+k.toString();
loadXMLDoc(url,function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  });

document.getElementById("txt").value = k
alert("your score is "+k+" out of 50");
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
	 <div id="myDiv"></div>
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


<h2>Quiz</h2>
<input id="txt" readonly="true" size=3 type="text" value="" border="" name="disp" disabled>
</form>
	<div id = "zero" class = "unhidden">
<form name = "zero"  >
<br/>
Rules go here<br/>
1) Don't Refresh in the middle of the quiz<br/>
2) Once you submit first question you cant change its answer - This is format<br/>
bla<br/>
bla<br/>
bla<br/>
<input type = "button" value = "next" onclick = "startquiz()">
<input type = "hidden" id = "txt0">

</form>
</div>


<div id = "one" class = "hidden">
<form name = "first"  >
1) ans is option 1 ?</br></br>
<label for="radio"><input type = "radio" id = "a" value = "1" name = "quiz" >sathia</label><br></br>
<input type = "radio" id = "a" value = "2" name = "quiz">Ramesh<br></br>
<input type = "radio" id = "a" value = "3" name = "quiz">Gokul<br></br>
<input type = "button" value = "next" onclick = "firstAnswer()">
<input type = "hidden" id = "txt1">
</form>
</div>

<div  class = "hidden" id = "two">
<form name = "second" >
2) which is full form of HTML ?</br></br>
<input type = "radio" id = "a" value = "1" name = "quiz" >Hyprer Text Makeup language<br></br>
<input type = "radio" id = "a" value = "2" name = "quiz">HyperText MarhUp Language<br></br>
<input type = "radio" id = "a" value = "3" name = "quiz">Heavy Text Manmade Language<br></br>
<input type = "button" value = "next" onclick = "secondAnswer()">
<input type = "hidden" id = "txt2">
</form>
</div>

<div class = "hidden" id = "three">
<form name = "third" >
3) which is capital of tamil nadu ?</br></br>
<input type = "radio" id = "a" value = "1" name = "quiz" >chennai<br></br>
<input type = "radio" id = "a" value = "2" name = "quiz">delhi<br></br>
<input type = "radio" id = "a" value = "3" name = "quiz">coimbatore<br></br>
<input type = "button" value = "next" onclick = "thirdAnswer()">
<input type = "hidden" id = "txt3">
</form>
</div>

<div class = "hidden" id = "four">
<form name = "four" >
4) which wonder is symbol of love ?</br></br>
<input type = "radio" id = "a" value = "1" name = "quiz" >chennai central<br></br>
<input type = "radio" id = "a" value = "2" name = "quiz">nile river<br></br>
<input type = "radio" id = "a" value = "3" name = "quiz">Taj mahal<br></br>
<input type = "button" value = "next" onclick = "fourAnswer()">
<input type = "hidden" id = "txt4">
</form>
</div>

<div class = "hidden" id = "five">
<form name = "five" >
5) who is founder of LINUX ?</br></br>
<input type = "radio" id = "a" value = "1" name = "quiz" >Abdul Kalam<br></br>
<input type = "radio" id = "a" value = "2" name = "quiz">Linus<br></br>
<input type = "radio" id = "a" value = "3" name = "quiz">Abraham Linchon<br></br>
<input type = "button" value = "next" onclick = "fiveAnswer()">
<input type = "hidden" id = "txt5">
</form>
</div>

<div class = "hidden" id = "six">
<form name = "six" >
6) what is our national Language ?</br></br>
<input type = "radio" id = "a" value = "1" name = "quiz" >Hindi<br></br>
<input type = "radio" id = "a" value = "2" name = "quiz">English<br></br>
<input type = "radio" id = "a" value = "3" name = "quiz">Tamil<br></br>
<input type = "button" value = "next" onclick = "sixAnswer()">
<input type = "hidden" id = "txt6">
</form>
</div>

<div class = "hidden" id = "seven">
<form name = "seven" >
7) which is longest river in the world ?</br></br>
<input type = "radio" id = "a" value = "1" name = "quiz" >Koovam<br></br>
<input type = "radio" id = "a" value = "2" name = "quiz">Nile<br></br>
<input type = "radio" id = "a" value = "3" name = "quiz">niagra<br></br>
<input type = "button" value = "next" onclick = "sevenAnswer()">
<input type = "hidden" id = "txt7">
</form>
</div>

<div class = "hidden" id = "eight">
<form name = "eight" >
8) who is creator of james Bond?</br></br>
<input type = "radio" id = "a" value = "1" name = "quiz" >Ian Fleming<br></br>
<input type = "radio" id = "a" value = "2" name = "quiz">James cameroon<br></br>
<input type = "radio" id = "a" value = "3" name = "quiz">Shankar<br></br>
<input type = "button" value = "next" onclick = "eightAnswer()">
<input type = "hidden" id = "txt8">
</form>
</div>

<div class = "hidden" id = "nine">
<form name = "nine" >
9) who is father of computor ?</br></br>
<input type = "radio" id = "a" value = "1" name = "quiz" >Leonanrd paris<br></br>
<input type = "radio" id = "a" value = "2" name = "quiz">ken thomas<br></br>
<input type = "radio" id = "a" value = "3" name = "quiz">charles babbage<br></br>
<input type = "button" value = "next" onclick = "nineAnswer()">
<input type = "hidden" id = "txt9">
</form>
</div>

<div class = "hidden" id = "ten">
<form name = "ten" >
10) who developed world wide web (www) ?</br></br>
<input type = "radio" id = "a" value = "1" name = "quiz" >Tim Bernes Lee<br></br>
<input type = "radio" id = "a" value = "2" name = "quiz">charles babbage<br></br>
<input type = "radio" id = "a" value = "3" name = "quiz">Robert bosch<br></br>
<input type = "button" value = "next" onclick = "tenAnswer()" id = "helo" class = "heloo">
<input type = "hidden" id = "txt10">
</form>
<input type = "hidden" id = "txt">
<input type = "button" value = "score"  onclick = "total()">
</div>

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
<div align=center>This template  downloaded form <a href='http://all-free-download.com/free-website-templates/'>free website templates</a></div></
body>


</html>
<?php include("includes/footer.php"); ?>
