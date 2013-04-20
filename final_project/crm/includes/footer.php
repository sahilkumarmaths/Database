
<?php
//5. Close connection
echo"<footer>
<div class=\"footerlink\">
<center><p class=\"mf\">Copyright &copy; 2013 <a href=\"#\">Course Resource Management</a> - All Rights Reserved</p></center>
</div>
</footer>
<script type=\"text/javascript\"> Cufon.now(); </script>";

	if(isset($connection))
	mysql_close($connection);
?>