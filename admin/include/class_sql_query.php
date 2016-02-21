<?
//Bogmoth SQL Query v0.0.3 - 20060504
//-added utf8_decode to line 44
class sql_query{

	//Database login details.
	var $bolDebug = 0;
	var $bolCleanData = 1;				//Dangerous to change this to 0
	var $strDebugNewLine = "<br>\n";
    var $db_hst;						//Server host name.
    var $db_un;							//Valid username for the database on host indicated above.
    var $db_pw;							//Password for username specified above.
    var $db;							//Database name to be connected to.
    var $conn_err = "Connection Error";	//oops.
    var $str_select_SQL;
    var $db_ary;
    var $font_color = "#00ffff";
    var $ary_alias ;//= array();
    
		//Creator function sets up variables for database connection.
        function sql_query($db_hst, $db_un, $db_pw, $db, $str_SQL = ""){//possibly pass db cred data as an array?
          $this->db_hst = $db_hst;
          $this->db_un = $db_un;
          $this->db_pw = $db_pw;
          $this->db = $db;
          	if($str_SQL <> ""){
          		$this->set_sql_string($str_SQL);
          		$this->apply_sql();
          	}
          	if($this->bolDebug == 1){echo "FUNCTION set_sql_string()<br>&nbsp; &nbsp; \$db_hst=$db_hst, \$db_un=$db_un, \$db_pw=$db_pw, \$db=$db \$this->str_select_SQL=" . $this->str_select_SQL . $this->strDebugNewLine;}
        }
        function set_sql_string($str){
        	$this->str_select_SQL = $str;
        		if($this->bolDebug == 1){echo "FUNCTION set_sql_string()<br>&nbsp; &nbsp; \$this->str_select_SQL=" . $this->str_select_SQL . $this->strDebugNewLine;}
        }
        function set_aliases($ary){//aliases can also be set in the sql string class.
        	$this->ary_alias = $ary;
        		if($this->bolDebug == 1){echo "FUNCTION set_aliases()<br>&nbsp; &nbsp; \$this->ary_aliases="; print_r($this->ary_alias); echo $this->strDebugNewLine;}
        }
        function apply_sql(){
        		if($this->bolDebug == 1){echo "FUNCTION apply_sql()<br>&nbsp; &nbsp; \$this->db_hst=$this->db_hst, \$this->db_un=$this->db_un, \$this->db_pw=$this->db_pw, \$this->db=$this->db" . $this->strDebugNewLine;}
            $dbconn = mysql_connect($this->db_hst,$this->db_un,$this->db_pw) or die($this->conn_err . " :cn");
            mysql_select_db($this->db) or die($this->conn_err . " :db");
            $this->str_select_SQL = stripslashes(mysql_real_escape_string(utf8_decode($this->str_select_SQL)));
            $result = mysql_query($this->str_select_SQL) or die($this->conn_err . " :rt " . $this->str_select_SQL);
            $i = 0;
            //print_r($this->ary_alias);
            	//if (is_array($this->ary_alias)) {
            		while($row = mysql_fetch_assoc($result)){
	            		$this->db_ary[] = $row;
	                	$db_ary_keys = array_keys($this->db_ary[$i]);
						$tmpary = array();
	                	$j = 0;
	                		foreach($db_ary_keys as $aryItem){
		                			if($this->bolCleanData == 1){
			                			$tmpdata = $this->clean_string_for_browser($this->db_ary[$i][$aryItem]);
		                			}else{
			                			$tmpdata = $this->db_ary[$i][$aryItem];
		                			}
			                		if (is_array($this->ary_alias)) {
										$tmpkey = $this->ary_alias[$j];
									}else{
										$tmpkey = $db_ary_keys[$j];
									}
								$tmpary = $tmpary + array($tmpkey => $tmpdata);
		                		$j++;
	                		}
	                	$this->db_ary[$i] = $tmpary;
	            		$i++;
            		}
            		
            	//}else{
            	//	while($row = mysql_fetch_assoc($result)){
	        	//		$this->db_ary[] = $row;	
            	//	}
            	//}
            mysql_close();
            	if($this->bolDebug == 1){echo "DB ARRAY: " . $i . " rows retrieved." . $this->strDebugNewLine; print_r($this->db_ary); echo $this->strDebugNewLine;};
        }
        function get_data($bolPrint = 0){
        		if(($bolPrint == 1) || ($this->bolDebug == 1)){echo "<font color=\"$this->font_color\">DB ARY:</font><br>\n "; print_r($this->db_ary); echo $this->strDebugNewLine;}
        		if(is_array($this->db_ary)){
        			return $this->db_ary;		
        		}else{
        			return 0;
        		}
        }  
        function set_bolCleanData($bol = 1){
            $this->bolCleanData = $bol;
        } 
        function set_bolDebug($bol = 1){
            $this->bolDebug = $bol;
        }
        function clean_string_for_browser($str, $len = 0){
			$str = htmlspecialchars(stripslashes(utf8_decode(trim($str))));
			$str = str_replace("?", "&#63;", $str);
			$str = str_replace("*", "&#42;", $str);
				if($len > 0){
					$str = substr($str, 0, $len);
				}
			return $str;
		}
}

?>