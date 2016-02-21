<?
	if (!isset($_GET["logout"]) && $bolShowUseSessions == 1) {
		if (isset($_GET[$db_col_name_member_sid]) && $_GET[$db_col_name_member_sid] <> "") {
				$sid = clean_string_for_db($_GET[$db_col_name_member_sid], $db_MAX_sid_len);
				
				$obj = new sql_string($db_tbl_name_sessions);
				$obj->set_db_col_aliases(array($db_col_name_member_sid)); 
				$obj->set_db_where($db_col_name_member_sid . " = '" . $sid . "'");
				$str_SQL = $obj->get_SQL();
				
				$obj = new sql_query($db_hst, $db_un, $db_pw, $db, $str_SQL);
				$ary_data = $obj->get_data();	
					if ($ary_data > 0) {
						//Check how long since last page change/update...
						
						
						
						//Visitor still active
						$qs = $qs . $db_col_name_member_sid . "=" . $sid;	//keep query string
						$bolShowLogin = 0; //By default this is one until someone logs in.
						$dbconn = mysql_connect($db_hst, $db_un, $db_pw) or die($msg_conn_err . " $db_hst, $db_un, $db_pw");
			        	mysql_select_db($db) or die($db_err);
			        	$result = mysql_query("UPDATE $db_tbl_name_sessions SET $db_col_name_sessions_sid_time = UNIX_TIMESTAMP() WHERE $db_col_name_sessions_sid = $sid;");
			        	mysql_close($dbconn);
					}			
		} elseif (isset($_POST[$form_pw])) {
				$pw = clean_string_for_db($_POST[$form_pw], $MAX_PASSWORD_LENGTH);
				
				$obj = new sql_string($db_tbl_name_members);
				$obj->set_db_col_aliases(array($db_col_name_member_pw)); 
				$obj->set_db_where($db_col_name_member_pw . " = '" . $pw . "'");
				$str_SQL = $obj->get_SQL();
				
				$obj = new sql_query($db_hst, $db_un, $db_pw, $db, $str_SQL);
				$ary_data = $obj->get_data();	
					if ($ary_data == 0) {
						print "Invalid Password<br>";
					} else {
						//Delete old entries in tblSessions
						$dbconn = mysql_connect($db_hst, $db_un, $db_pw) or die($msg_conn_err . " $db_hst, $db_un, $db_pw");
			        	mysql_select_db($db) or die($db_err);
			        	$result = mysql_query("DELETE FROM $db_tbl_name_sessions WHERE UNIX_TIMESTAMP() - $db_col_name_sessions_sid_time > $MAX_UPDATE_SESSION_TIME;");
			        		
			        	//Create sid
						$sid = rand(1000, 9999) . date("j") . rand(1000, 9999);
						
						//Insert sid into table				
			        	$result = mysql_query("INSERT INTO $db_tbl_name_sessions SET $db_col_name_sessions_sid = $sid, $db_col_name_sessions_sid_time = UNIX_TIMESTAMP();");
			        		if ($result == 0) {
				        		print "error insert<br>";
			        		} else {
								$qs = $qs . $db_col_name_member_sid . "=" . $sid;	//keep query string
								$bolShowLogin = 0; //Do not show login page
			        		}
			        	mysql_close($dbconn);
					}	
		} 
	}


?>