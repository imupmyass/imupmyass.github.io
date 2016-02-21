<?php

$root_dir = "../../";

include $root_dir . 'admin/include/functions.inc.php';
include $root_dir . 'admin/include/class_sql_string.php';
include $root_dir . 'admin/include/class_sql_query.php';
include $root_dir . 'admin/include/db_details.php';
include $root_dir . 'admin/include/site_variables.php';
include $root_dir . 'admin/include/site_processing.php';

	if ($bolShowLogin == 0) {
		
		$html_title = "My Puppies";
		$html_extra_body =  "";

include $root_dir . 'admin/include/html_head.php';
include $root_dir . 'admin/include/title_navigation_table.inc.php';

		echo "<h3>$html_title</h3>";
		
		$html_img = get_HTML_file_name("", "", 1);
		
		echo $html_img;

?></body></html>
<?
 	} else {
include $root_dir . 'admin/include/login_form.php';
	}
?>