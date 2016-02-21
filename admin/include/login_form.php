<?php
	if (isset($_GET["logout"]) && $bolShowUseSessions == 1) {
		$msg_logout = "<p>You have been logged out.</p>";
		$sid = clean_string_for_db($_GET[$db_col_name_member_sid], $db_MAX_sid_len);
		$dbconn = mysql_connect($db_hst, $db_un, $db_pw) or die($msg_conn_err . " $db_hst, $db_un, $db_pw");
    	mysql_select_db($db) or die($db_err);
    	$result = mysql_query("DELETE FROM $db_tbl_name_sessions WHERE $sid = $db_col_name_sessions_sid;");
	}
?>
<html><head><title>:-)</title><body>
		<table border="0" width="<? echo $site_table_width; ?>" style="border: 0px solid #999999;"><tr>
		<td style="width:120;" rowspan="2">
			<img src="/front/ass1.jpg" width="100" height="100" alt="">
		</td>		
		<td align="center" valign="bottom">
			<p style="font-size: large"><b>I Like Me</b></p><br>&nbsp;
		</td><td style="width:120;" align="right" rowspan="2">
			<img src="/front/fox2.jpg" width="100" height="100" alt="">
		</td></tr></table>
		<table border="0" width="<? echo $site_table_width; ?>" style="border: 0px solid #999999;"><tr>
		<td style="width:220;">&nbsp;</td><td>
		<p>
		&nbsp;
		</p>
<? echo $msg_logout; ?>
<p>
Where was Ruuskii born?
</p>
<form action="./" name="MyForm" method="post">
<input type="password" size="<? echo $MAX_PASSWORD_LENGTH ?>" maxlength="<? echo $MAX_PASSWORD_LENGTH ?>" value="" name="<? echo $form_pw; ?>">
<br>
<input type="submit" name="Submit" value="Submit">
</form>
</td></tr></table>
</body</html>