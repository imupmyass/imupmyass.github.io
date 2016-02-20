<?php

$root_dir = "../";

include $root_dir . 'admin/include/functions.inc.php';
include $root_dir . 'admin/include/class_sql_string.php';
include $root_dir . 'admin/include/class_sql_query.php';
include $root_dir . 'admin/include/db_details.php';
include $root_dir . 'admin/include/site_variables.php';
include $root_dir . 'admin/include/site_processing.php';

	if ($bolShowLogin == 0) {
		
$html_title = "VIDs IM UP MY ASS";
$html_extra_body = "";

include $root_dir . 'admin/include/html_head.php';
include $root_dir. 'admin/include/title_navigation_table.inc.php';

?>
<table border="0" width="<? echo $site_table_width; ?>"><tr valign="top"><td>
<p>
Here are some of my vids:
</p>
<hr>
<p>
Boxing Day 2006
</p>
<p>
The weather was terrible. Similar to the UK!
</p>
<a href="myboxingday2006/nero.mpg">45 Seconds MPG 16MB</a> - Nero on Beach<br>
<a href="myboxingday2006/ruuskiee.mpg">34 Seconds MPG 12MB</a> - Ruuskii on Beach<br>
<a href="myboxingday2006/pasha_moi.mpg">27 Seconds MPG 9.6MB</a> - Pasha et Moi at JI House<br>
<a href="myboxingday2006/nero_mark.mpg">28 Seconds MPG 10MB</a> - Nero with Admin Assistant on Beach<br>
<hr>
</td></tr></table>
</body></html>
<?
 	} else {
include $root_dir . 'admin/include/login_form.php';
	}
?>