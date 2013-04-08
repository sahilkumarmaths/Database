<?php
// This contains all the functions which would be used...

	function confirm_query($result_set)
	{
		if (!$result_set)
		{
			die("Database query failed: " . mysql_error());
		}
	}
	function redirect_to( $location = NULL ) 
	{
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}

	function get_person_entity($table_name, $webmail_id)
	{
		global $connection;
		$query = "SELECT * 
				FROM {$table_name} ";
		$query .= "WHERE webmail_id = '{$webmail_id}' ";
	
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		
		if (mysql_num_rows($result_set) == 1) {
			$found_user = mysql_fetch_array($result_set);
			return $found_user;
		}
		else
		{	
			die("Database query failed: " . mysql_error());
		}
	
	}
	
	function get_courses_for_student($webmail_id)
	{
		global $connection;
		$query = "SELECT co.course_id, co.semester, co.absolute_year, c.course_name, c.syllabus
				FROM course_offerings co, enrolls e, course c
				WHERE co.course_id = e.course_id AND co.course_id = c.course_id
				AND e.stud_webmail_id = '{$webmail_id}' ";
		
	
		$course_set = mysql_query($query, $connection);
		confirm_query($course_set);
		
		return $course_set;
	
	
	}
	
	function get_courses_for_instructor($webmail_id)
	{
		global $connection;
		$query = "SELECT co.course_id, co.semester, co.absolute_year, c.course_name, c.syllabus
				FROM course_offerings co, teaches t, course c
				WHERE co.course_id = t.course_id AND co.course_id = c.course_id
				AND t.instructor_webmail_id = '{$webmail_id}' ";
		
	
		$course_set = mysql_query($query, $connection);
		confirm_query($course_set);
		
		return $course_set;
	
	}
	function get_course_by_key($course_id, $semester, $abs_year)
	{
		global $connection;
		$query = "Select co.course_id, co.semester, co.absolute_year, c.course_name, c.syllabus
					from course c, course_offerings co
					where c.course_id = co.course_id AND co.course_id = '{$course_id}' AND co.semester = {$semester} AND co.absolute_year = {$abs_year} ";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		if (mysql_num_rows($result_set) == 1) {
			$found_course = mysql_fetch_array($result_set);
			return $found_course;
		}
		else
		{	
			die("Database query failed: " . mysql_error());
		}
	}
	//Get the threads information of given courseoffering
	function get_threads_of_course($sel_course_id, $sel_semester, $sel_abs_year)
	{
		global $connection;
		$query = "Select th.thread_id, th.thread_name, th.webmail_id, th.description
					from thread th
					where th.course_id = '{$sel_course_id}' AND th.semester = {$sel_semester} AND th.year = {$sel_abs_year}";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		return $result_set;
	}
	
	function get_thread_comments($sel_thread_id)
	{
		global $connection;
		$query = "Select th.comment_id, th.webmail_id, th.comment_text
					from comments th
					where th.thread_id = '{$sel_thread_id}'";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		return $result_set;
	}
	function get_thread_details($sel_thread_id)
	{
		global $connection;
		$query = "Select th.thread_id, th.thread_name, th.webmail_id, th.description
					from thread th
					where th.thread_id = '{$sel_thread_id}'";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		//print_result_set($result_set); 
		return $result_set;
	
	}
	
	
	function print_result_set($result_set)
	{
		echo "<table>";
		while ($row = mysql_fetch_array($result_set))
		{	
			echo "<tr>";
			foreach($row as $_column) 
			{
					echo "<td>{$_column}</td>";
			}
			echo "</tr><br>";
			
		}
		echo "</table>";
	}
	
	
	function get_file_uploads_of_course($course_id, $semester, $abs_year)
	{
		global $connection;
		$query = "Select * from documents d where d.course_id = '{$course_id}' and d.semester = {$semester} and d.year = {$abs_year} ";
		$result_set = mysql_query($query, $connection);
		if($result_set)
			return $result_set;
		else
			return NULL;
	}
	
	function get_search_files($course_id,$semester,$abs_year,$string,$uploader,$descr)
	{
		global $connection;
		$query = "Select * from documents d where d.course_id = '{$course_id}' and d.semester = {$semester} and d.year = {$abs_year} ";
		
		if ($string<>'') {
		$search_string = " AND (file_name LIKE '%".mysql_real_escape_string($string)."%')";
		$query = $query.$search_string;
		}
	
		if ($uploader<>'') {
		$upload_string = " AND uploader_id='".mysql_real_escape_string($uploader)."' ";
		$query = $query.$upload_string;
		}
		
		if($descr<>''){
		$descr_string = " AND file_description LIKE '%".mysql_real_escape_string($descr)."%' ";
		$query = $query.$descr_string;
		}
		//$descr_string = " AND file_description LIKE '%".mysql_real_escape_string($descr)."%' ";
		
		
		$result_set = mysql_query($query, $connection);
		if($result_set)
			return $result_set;
		else
			return NULL;
	}
	
	function get_uploaders()
	{
		global $connection;
				
		$query = "Select * from documents d GROUP BY uploader_id ORDER BY uploader_id ";
		
		$result_set = mysql_query($query, $connection);
		if($result_set)
			return $result_set;
		else
			return NULL;
	}
	
	function get_file_entity($file_id)
	{
		global $connection;
		$query = "Select * from documents d where d.file_id = {$file_id} LIMIT 1";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		if (mysql_num_rows($result_set) == 1) {
			$found_file = mysql_fetch_array($result_set);
			return $found_file;
		}
		else
		{
			die("Database query failed: " . mysql_error());
		}
	}
	
	function dummy_display_files_in_a_directory()
	{
			
				$path = "upload/{$sel_course_id}/{$sel_semester}_{$sel_abs_year}";
				if(file_exists($path))
				{
					if ($handle = opendir($path)) 
					{
						while (false !== ($entry = readdir($handle))) 
						{
							if ($entry != "." && $entry != "..") {
								echo "<h4><a href=\"{$path}/{$entry}\">{$entry}</a><br /></h4>";
							}
						}
						closedir($handle);	
					}   
				}
				else
				{
				 echo "<p>No files have been uploaded yet for this Course !</p>" ;
				}
				
	
	}
	
	function get_quiz_entry($webmail_id)
	{
		global $connection;
				
		$query = "Select * from quiz where webmail_id='{$webmail_id}' ";
		
		$result_set = mysql_query($query, $connection);
		if($result_set)
		{
			if( mysql_affected_rows() >= 1 )
				return $result_set;
			else
				return NULL;
		}
		else
			return NULL;

	}
	
	
	function get_all_subjects($public = false)
	{
		global $connection;
		$query = "SELECT * 
				FROM subjects ";
		if($public)
		{
		$query .= "WHERE visible = 1 ";
		}
		
		$query .= "ORDER BY position ASC";
		$subject_set = mysql_query($query, $connection);
		confirm_query($subject_set);
		return $subject_set;
	}
		
	function get_pages_for_subject($subject_id,$public = false) {
		global $connection;
		$query = "SELECT * 
				FROM pages 
				WHERE subject_id = {$subject_id} ";
		if($public)
		{
			$query .= 	"AND visible = 1 ";
		}
		$query .=	"ORDER BY position ASC";
		$page_set = mysql_query($query, $connection);
		confirm_query($page_set);
		return $page_set;
	}
	
	function get_subject_by_id($subject_id)
	{
		$query = "SELECT * ";
		$query .= "FROM subjects ";
		$query .= "WHERE id=".$subject_id." ";
		$query .= "LIMIT 1";
		
		$result_set = mysql_query($query);
		confirm_query($result_set);
		
		
		$subject = mysql_fetch_array($result_set);
		if($subject)				// if no rows are returned, fetch_array will return FALSE
		{
			return $subject;
		}
		else
		{
			return NULL;
		}
		
	}
	
	function get_page_by_id($page_id)
	{
		$query = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE id=".$page_id." ";
		$query .= "LIMIT 1";
		
		$result_set = mysql_query($query);
		confirm_query($result_set);
		
		
		$page = mysql_fetch_array($result_set);
		if($page)				// if no rows are returned, fetch_array will return FALSE
		{
			return $page;
		}
		else
		{
			return NULL;
		}
		
	}
	function find_selected_page() {
		global $sel_subject;
		global $sel_page;
		if (isset($_GET['subj'])) {
			$sel_subject = get_subject_by_id($_GET['subj']);
			$sel_page = NULL;
		} elseif (isset($_GET['page'])) {
			$sel_subject = NULL;
			$sel_page = get_page_by_id($_GET['page']);
		} else {
			$sel_subject = NULL;
			$sel_page = NULL;
		}
	}
	
	function navigation($sel_subject, $sel_page, $public = false) {
		$output = "<ul class=\"subjects\">";
		$subject_set = get_all_subjects();
		while ($subject = mysql_fetch_array($subject_set)) {
			$output .= "<li";
			if ($subject["id"] == $sel_subject['id']) { $output .= " class=\"selected\""; }
			$output .= "><a href=\"edit_subject.php?subj=" . urlencode($subject["id"]) . 
				"\">{$subject["menu_name"]}</a></li>";
			$page_set = get_pages_for_subject($subject["id"]);
			$output .= "<ul class=\"pages\">";
			while ($page = mysql_fetch_array($page_set)) {
				$output .= "<li";
				if ($page["id"] == $sel_page['id']) { $output .= " class=\"selected\""; }
				$output .= "><a href=\"edit_page.php?page=" . urlencode($page["id"]) .
					"\">{$page["menu_name"]}</a></li>";
			}
			$output .= "</ul>";
		}
		$output .= "</ul>";
		return $output;
		}
		
		
	function public_navigation($sel_subject, $sel_page, $public = true) {
		$output = "<ul class=\"subjects\">";
		$subject_set = get_all_subjects($public);
		while ($subject = mysql_fetch_array($subject_set)) {
			$output .= "<li";
			if ($subject["id"] == $sel_subject['id']) { $output .= " class=\"selected\""; }
			$output .= "><a href=\"index.php?subj=" . urlencode($subject["id"]) . 
				"\">{$subject["menu_name"]}</a></li>";
			$page_set = get_pages_for_subject($subject["id"],$public);
			$output .= "<ul class=\"pages\">";
			while ($page = mysql_fetch_array($page_set)) {
				$output .= "<li";
				if ($page["id"] == $sel_page['id']) { $output .= " class=\"selected\""; }
				$output .= "><a href=\"index.php?page=" . urlencode($page["id"]) .
					"\">{$page["menu_name"]}</a></li>";
			}
			$output .= "</ul>";
		}
		$output .= "</ul>";
		return $output;
	}
	
	function insert_file_info($file_name, $file_path, $webmail_id,$sel_course_id, $sel_semester, $sel_abs_year, $file_description)
	{
		
		$dtz = new DateTimeZone('Asia/Kolkata') ;
		$date = new DateTime(NULL,$dtz);
		$cur_time_stamp = $date->format('Y-m-d H:i:s');
 	//	$cur_time_stamp = $date->getTimestamp();
		echo $cur_time_stamp;
		$query = "Insert into documents values (NULL, '{$file_name}', '{$file_path}','{$file_description}','{$webmail_id}', '{$sel_course_id}', {$sel_semester}, {$sel_abs_year} , '{$cur_time_stamp}')  ";
		$result_set = mysql_query($query);
		confirm_query($result_set);
	
	}
	
	
	function get_report_of_file($file_id)
	{
		global $connection;
		$query = "Select r.file_id, r.reported_by from reports r where r.file_id = {$file_id}";
		$result_set = mysql_query($query);
		if(!empty($result_set))
		{
			if(mysql_affected_rows() >= 1)
				return $result_set;

		}
		else
		{
			return NULL;
		}
	}
	function file_report_spam($sel_course_id, $sel_semester, $sel_abs_year, $webmail_id)
	{
		global $connection;
		if(isset($_POST['report_spam']))
		{
			if(!isset($_GET['report']))
			{
				redirect_to("course_files.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)."");
			}
			
			$sel_file_id = trim(mysql_prep($_GET['report']));
			$found_file = get_file_entity($sel_file_id);
			$query = "Insert into reports values ('{$webmail_id}', {$sel_file_id})";
			$result_set = mysql_query($query);
			if(!result_set)
			{
				 echo '<script type="text/javascript">', 'report_failed();', '</script>';
			}
			else
			{
				redirect_to("course_files.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)."");
			}
		}
	}
	
	function file_delete($sel_course_id, $sel_semester, $sel_abs_year, $webmail_id)
	{
		global $connection;
		if(isset($_POST['delete_submit']))
		{
			if(!isset($_GET['delete']))
			{
				redirect_to("course_files.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)."");
			}
			
			$sel_file_id = trim(mysql_prep($_GET['delete']));
			$found_file = get_file_entity($sel_file_id);
			if(($found_file['uploader_id'] == $webmail_id) || ( $_SESSION['person_type'] == 'instructor'))
			{
				$path = $found_file['file_data'];
				unlink($path);
				$query = "DELETE FROM documents WHERE file_id = {$sel_file_id} LIMIT 1";
				$result = mysql_query($query, $connection);
				confirm_query($result);
				if (mysql_affected_rows() == 1) {
					echo '<script type="text/javascript">', 'delete_success();', '</script>';
					redirect_to("course_files.php?course_id=".urlencode($sel_course_id)."&semester=".urlencode($sel_semester)."&abs_year=".urlencode($sel_abs_year)."");
					
				} 
				else {
				die("Database query failed: " . mysql_error());
				}
			}
			else
			{
				//echo "<p><b>You do not have permissions to delete this file </b></p>";
				echo '<script type="text/javascript">delete_failed();</script>';
				
			
			}
	
		}
		
	}
	function file_upload($sel_course_id, $sel_semester, $sel_abs_year)
	{
		if (isset($_POST['submit'])) 
		{
			if ($_FILES["file"]["error"] > 0)
			{
				echo "Error: " . $_FILES["file"]["error"] . "<br>";
			}
			else
			{
				echo "<h5>Upload: " . $_FILES["file"]["name"] . "<br></h5>";
				echo "<h5>Type: " . $_FILES["file"]["type"] . "<br></h5>";
				echo "<h5>Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br></h5>";
				//echo "Stored in: " . $_FILES["file"]["tmp_name"];
			}
			
			$allowedExts = array("gif", "jpeg", "jpg", "png","pdf","txt","mp4","flv","mpeg","avi","wma","mp3","doc","xlsx","xls");
			//$extension = end(explode(".", $_FILES["file"]["name"]));
			if ((($_FILES["file"]["type"] == "image/gif")
			|| ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg")|| ($_FILES["file"]["type"] == "image/png") 
			|| ($_FILES["file"]["type"] == "text/plain")
			|| ($_FILES["file"]["type"] == "video/x-flv") || ($_FILES["file"]["type"] == "video/mp4")
			|| ($_FILES["file"]["type"] == "audio/mp4")	|| ($_FILES["file"]["type"] == "audio/mpeg") ||  ($_FILES["file"]["type"] == "audio/mpeg3") || ($_FILES["file"]["type"] == "audio/x-ms-wma") 
			|| ($_FILES["file"]["type"] == "application/file") || ($_FILES["file"]["type"] == "application/msword") || ($_FILES["file"]["type"] == "application/vnd.ms-excel") || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint") || ($_FILES["file"]["type"] == "application/pdf")||($_FILES["file"]["type"] == "application/force-download"))
			&& ($_FILES["file"]["size"] < 3000000000)	// setting a upload size limit of 1Gb presently
			)
			{
				if ($_FILES["file"]["error"] > 0)
				{
					echo "Error: " . $_FILES["file"]["error"] . "<br>";
				}
				else
				{
					//echo "Upload: " . $_FILES["file"]["name"] . "<br>";
					//echo "Type: " . $_FILES["file"]["type"] . "<br>";
					//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
					//echo "Stored in: " . $_FILES["file"]["tmp_name"];
					
					 if (file_exists("upload/{$sel_course_id}/{$sel_semester}_{$sel_abs_year}/" . $_FILES["file"]["name"]))
					{
						//echo "<h5>".$_FILES["file"]["name"] . " already exists </h5>";
						echo "<h5> File already exists with this name ! </h5>";
					}
					else
					{
						if(!file_exists("upload/{$sel_course_id}/{$sel_semester}_{$sel_abs_year}"))
						{
							if(!file_exists("upload"))
							{
								mkdir("upload");
							}
							if(!file_exists("upload/{$sel_course_id}"))
							{
								mkdir("upload/{$sel_course_id}");
							}
							mkdir("upload/{$sel_course_id}/{$sel_semester}_{$sel_abs_year}");
						}
						
						
						if(move_uploaded_file($_FILES["file"]["tmp_name"],"upload/{$sel_course_id}/{$sel_semester}_{$sel_abs_year}/" . $_FILES["file"]["name"]))
						{
							//echo "Stored in: " . "upload/{$sel_course_id}/" . $_FILES["file"]["name"];
							$complete_path = "upload/{$sel_course_id}/{$sel_semester}_{$sel_abs_year}/". $_FILES["file"]["name"] ;
							$file_description = trim(mysql_prep($_POST['description']));
							insert_file_info($_FILES["file"]["name"],$complete_path ,$_SESSION['webmail_id'], $sel_course_id, $sel_semester, $sel_abs_year, $file_description );
							echo "<h5>File Uploaded Successfully ! </h5><br />";
	
						}
						else
						{
							echo "No such file or directory ";
						}
					}
				}
			}
			else
			{
				echo "<h5>File could not be uploaded. Invalid file format<h5><br />";
			}
		}
	
	}
	function mysql_prep( $value ) 
	{
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
		if( $new_enough_php ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysql_real_escape_string( $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}

	function delete_record($comment_id)
	{
		print '<script type="text/javascript">';
		print 'alert("Hello world")';
		print '</script>';  
	}
	
		function get_authors()
	{
		global $connection;
				
		$query = "Select * from thread GROUP BY webmail_id";
		
		$result_set = mysql_query($query, $connection);
		if($result_set)
			return $result_set;
		else
			return NULL;
	}
	
	/* 
	 * Function returns the resultset corresponding to the substring matches
	 * of the thread_name, author_name, description of the current semester and year
	 */
	function get_search_thread($thread_name,$author_name,$description,$course_id, $semester,$abs_year)
	{
		global $connection;
		
		$query = "Select * from thread t where t.course_id = '{$course_id}' and t.semester = {$semester} and t.year = {$abs_year} ";
		
		if ($thread_name<>'') {
		$thread_name_string = " AND (thread_name LIKE '%".mysql_real_escape_string($thread_name)."%')";
		$query = $query.$thread_name_string;
		}
	
		if ($author_name<>'') {
		$author_name_string = " AND webmail_id='".mysql_real_escape_string($author_name)."' ";
		$query = $query.$author_name_string;
		}
		
		if($description<>''){
		$descr_string = " AND description LIKE '%".mysql_real_escape_string($description)."%' ";
		$query = $query.$descr_string;
		}
		
		$result_set = mysql_query($query, $connection);
		if($result_set)
			return $result_set;
		else
			return NULL;
	}
	
	/* 
	 * Function returns the resultset corresponding to the All recent conversations
	 * sorted by the time stamp
	 */
	function get_recent_chat($id_reciever)
	{
		global $connection;
		$query = " select * from ( SELECT * from message where webmail_id_reciever = '{$id_reciever}' order by `time_stamp` desc )X group by X.webmail_id_sender";
		
		$result_set = mysql_query($query, $connection);
		if($result_set)
			return $result_set;
		else
			return NULL;
	}
	
	/* 
	 * Sends the message
	 */
	function send_message1($id_sender,$id_reciever, $message)
	{
		global $connection;
		$query = " INSERT INTO `crm_db`.`message` (`webmail_id_sender`, `webmail_id_reciever`, `message`, `time_stamp`, `reciever_read`) VALUES ('{$id_sender}', '{$id_reciever}', '{$message}', CURRENT_TIMESTAMP, '0');";
		
		$result_set = mysql_query($query, $connection);
	}
	
	
	//sharath sunday 8-04-13
	function get_news_by_course($sel_course_id, $sel_semester, $sel_abs_year)
	{
		global $connection;
		//$query = " select * from ( SELECT * from news_feed where webmail_id_reciever = '{$id_reciever}' order by `time_stamp` desc )X group by X.webmail_id_sender";
		$query = "select * from news_feed
		where nid in 
		(select nid from news_course th where th.course_id = '{$sel_course_id}' AND th.semester = {$sel_semester} AND th.year = {$sel_abs_year})";
//select * from news_feed
//where nid in 
//(select nid from news_course th where th.course_id = 'CS344' AND th.semester = 1 AND th.year = 2013)
		$result_set = mysql_query($query, $connection);
		
		if($result_set)
			return $result_set;
		else
			return NULL;
			
	}
	
?>