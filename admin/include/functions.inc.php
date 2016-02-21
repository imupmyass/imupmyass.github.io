<?php
//BogMoth Functions v0.0.9 - 20060615
//-added get_HTML_file_name function to line 69
	function clean_string($mystr){
		$mystr = str_replace("<", "&lt;", $mystr);
		$mystr = str_replace(">", "&gt;", $mystr);
		$mystr = str_replace("\"", "&quot;", $mystr);
		return $mystr;
	}
	function get_file_extension($fn){
		$dotpos = strrpos($fn, ".");
	       	if ($dotpos > 0){
           		$fLen = strlen($fn);
           		$fExt = substr($fn, $dotpos + 1, $fLen);
	   		}else{
		   		$fExt = "";
		   	}
	   	return $fExt;
	}
	function get_3_chars($iNum){
      	  if($iNum < 100){
                   if($iNum < 10){
                      $iNum = "0$iNum";
                   }
              $iNum = "0$iNum";
          }
      return $iNum;
  	}
  	function get_order_id($mystr){
      	$len = strlen($mystr);
		$ordid = "M" . date("m") . rand(1000, 9999) . substr($mystr, $len - 4, $len);		
      	return $ordid;
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
	function clean_string_for_db($str, $len = 0){
		$str = utf8_decode(trim($str));
			if($len > 0){
				$str = substr($str, 0, $len);
			}
		return $str;
	}
	function clean_pw_for_db($str, $len = 0){
		$str = utf8_decode($str);
			if($len > 0){
				$str = substr($str, 0, $len);
			}
		return $str;
	}
	function clean_string_for_db_price($str, $len = 0){
		$str = str_replace("£", "", $str);
		$str = str_replace("&pound;", "", $str);
		$str = str_replace("#", "", $str);
		$str = str_replace("$", "", $str);
		$str = str_replace("&#36;", "", $str);//dollar sign
		$str = str_replace(",", "", $str);
		$str = str_replace("&#44;", "", $str);//comma
		$str = utf8_decode($str);
			if($len > 0){
				$str = substr($str, 0, $len);
			}
		$str = floatval($str);	
		return $str;
	}
	function clean_post_file_string($fn){
		$fn = str_replace("../", "", $fn);
		$fn = str_replace("..", "", $fn);
		return $fn;
	}
	function bol_email_address($str, $len = 0){
		$str = trim($str);
			if($len > 0){
				$str = substr($str, 0, $len);
			}
		$bolEmailOk = preg_match('/^[\D\d]+\@[\D\d]+\.[\D\d]+$/', $str); 	//This regular expression is really slack, it will let through emails that are invalid but won't stop them if they are valid... Which is more important? 2006-03-20			
		$i = substr_count($str, "@");										//Should include this in the regular expression. 2006-04-13
			if(($bolEmailOk == 0) || ($i > 1)){
				return 0;
			}else{
				return 1;
			}
	}
	function get_html_members_no_login($rdir, $q, $scss = ""){
		return " - <a href=\"" . $rdir . "login/$q\" class=\"horizontal_navtab\"" . $scss . "\">login</a>&nbsp";
	}
	function get_html_members_login($rdir, $q, $s, $du){
		return " <span style=\"background-color: #ffffff; border: solid 1px #666666;\">&nbsp; Signed in as <font color=\"red\"><b>$du</b></font> &nbsp;</span> - <a href=\"" . $rdir . "login/$q&$s=1\"><b>logout</b></a>";
	}
	function get_ary_file_name($dir_name, $ary_ext = "", $str_first_val = 0, $bolFileNameAsKey = false, $bolExcludeDot = true){
  		 if($handle = opendir($dir_name)) {
  		 		if($str_first_val !== 0){//means a "0" would have to be used. | A. if you need to put a header onto a column. see bolFileNameAsKey
              		$ary_fn[] = array($str_first_val => $str_first_val);
              	}
			    while (false !== ($file = readdir($handle))) {
			         if ($file != "." && $file != "..") {//ok, $bolExcludeDot not used, to be rectified.
			             $file_extension = get_file_extension($file);
					           if ($file_extension != ""){
						            foreach ($ary_ext as $aryItem){
							            if($file_extension == $aryItem){
						            		if ($bolFileNameAsKey == true){
						            			$ary_fn[] = array($file => $file);
						            		}else{
						            			$ary_fn[] = $file;
						            		}
	                   		  			}
						            }
					           }//yes this needs work as well...else{
					           //}
			         }
	        	}
              closedir($handle);
            	if(is_array($ary_fn)){
            		
            	}else{
            		$ary_fn[] = "no files available";
            	}
              return $ary_fn;
          }else{
              $ary_fn[] = "no search directory available";
              return $ary_fn;
          }
  }
  function get_HTML_file_name($dir_name = "", $ary_ext = "", $bolImg = 0){
  		 if ($dir_name == "") {
	  		$dir_name = getcwd();
  		 }
  		 if (($ary_ext <> "") && (!is_array($ary_ext))) {
  		 	$ary_ext = array($ary_ext);
  		 }
  		 if($handle = opendir($dir_name)) {
			    while (false !== ($file = readdir($handle))) {
			    	$bolAddFile = 0;
			    	$str = "";
			         if ($file != "." && $file != "..") {
			             $file_extension = get_file_extension($file);
					           if ($ary_ext != ""){
						            foreach ($ary_ext as $aryItem){
							            if($file_extension == $aryItem){
						            		$bolAddFile = 1;
	                   		  			}
						            }
					           }else{
				            		$bolAddFile = 1;
					           }
					           if ($bolAddFile == 1) {
					           		if (strpos($file, "__") !== 0) {//this removes any file names with __ at the start.
										if ($bolImg == 1) {
											if (list($width, $height, $type, $attr) = getimagesize($dir_name. "/" . $file)) {
												$ary_fn[] = $file;
												//echo $file . "<br>";
											}
										}else{
											$html_str .= $file;
										}
					           		}
					           }
			         }
	        	}
              closedir($handle);
            	if(($html_str <> "") || (count($ary_fn) > 0)){
            		if (count($ary_fn) > 0) {
	            		sort($ary_fn);
	            		foreach ($ary_fn as $val) {
		            		//$html_str .= "\n<img src=\"$val\" $attr style=\"border: solid 1px #666666;\"><br>&nbsp;<br>";
		            		$html_str .= "\n<img src=\"$val\" style=\"border: solid 1px #666666;\"><br>&nbsp;<br>";
						}
            		}
            		if (file_exists("info.txt")) {
	            		$html_str .=  str_replace("\n", "\n<br>", file_get_contents("info.txt"));
            		}
            	}else{
            		$html_str = "no files available";
            	}
          }else{
              $html_str = "no search directory available";
          }
      return $html_str . "\n";
  }
  	function del_files_by_criteria($dir_name, $ary_ext = "", $elapse_seconds = 0, $bolOppositeExtentions = 0,  $bolOppositeElapseTime = 0){//thought about incorporating this into get_ary_file_name...but decided against.
  		//Design brief: be able to delete certain files in a directory [owned by a user,(for future!)] with a certain file ext and/or of a certain age.
  		//$ary_ext = 0, means do not check by extention.
  		//$elapse_creation_seconds = 0, means do not check file creation time.
  		//del_files_by_criteria("mydir") - By default this function will delete all files in a folder.
  		//del_files_by_criteria("mydir", "jpg") - Delete files with a jpg extenstion.
  		//del_files_by_criteria("mydir", "jpg", 3600) - Delete files with a jpg extenstion that are over an hour old.
  		//del_files_by_criteria("mydir", "jpg", 3600, 1) - Delete files that do not have a jpg extenstion that are over an hour old.	
  		//del_files_by_criteria("mydir", "jpg", 3600, 1, 1) - Delete files that do not have a jpg extenstion and are under an hour old.
  		//del_files_by_criteria("mydir", 0, 3600) - Delete files with _any_ extension that are over an hour old.
  		//del_files_by_criteria("mydir", 0, 3600, 0, 1) - Delete files that are under an hour old.
  		//del_files_by_criteria("mydir", 0, 0) - Do not do anything.
  		if($oDir = opendir($dir_name)){
		        while (false !== ($file = readdir($oDir))) {
				        if ($file != "." && $file != "..") {
		        			$fp = $dir_name . $file;
		        				if(($ary_ext <> 0) && ($elapse_seconds > 0)){
		        					$file_extension = get_file_extension($file);
		        					$ft = filectime($fp);
					         			if (((in_array($file_extension, $ary_ext)) && ((time() - $ft) > $elapse_seconds)) && ($bolOppositeExtentions == 0) && ($bolOppositeElapseTime == 0)){ //does this work with a string as the array?
								 			if(!is_dir($fp))unlink($fp);
					         			}elseif (((!in_array($file_extension, $ary_ext)) && ((time() - $ft) > $elapse_seconds)) && ($bolOppositeExtentions == 1) && ($bolOppositeElapseTime == 0)){
								 			if(!is_dir($fp))unlink($fp);
								 		}elseif (((in_array($file_extension, $ary_ext)) && ((time() - $ft) < $elapse_seconds)) && ($bolOppositeExtentions == 0) && ($bolOppositeElapseTime == 1)){
								 			if(!is_dir($fp))unlink($fp);
								 		}elseif (((!in_array($file_extension, $ary_ext)) && ((time() - $ft) < $elapse_seconds)) && ($bolOppositeExtentions == 1) && ($bolOppositeElapseTime == 1)){
								 			if(!is_dir($fp))unlink($fp);
								 		}
					         			
		        				}elseif($ary_ext <> 0){
		        					$file_extension = get_file_extension($file);
					         			if (in_array($file_extension, $ary_ext) && ($bolOppositeExtentions == 0)){
					         				if(!is_dir($fp))unlink($fp);
					         			}elseif(!in_array($file_extension, $ary_ext) && ($bolOppositeExtentions == 1)){
					         				if(!is_dir($fp))unlink($fp);
					         			}
		        				}elseif($elapse_seconds > 0){
		        					$ft = filectime($fp);
					         			if (((time() - $ft) > $elapse_seconds) && ($bolOppositeElapseTime == 0)){ //&& ($bolOppositeExtentions == 0)) {//does this work with a string as the array?
								 			if(!is_dir($fp))unlink($fp);
					         			}elseif (((time() - $ft) < $elapse_seconds) && ($bolOppositeElapseTime == 1)){
					         				if(!is_dir($fp))unlink($fp);
					         			}
		        				}else{
		        					if(!is_dir($fp))unlink($fp);
		        				}
						}
		        }
		    closedir($oDir);
		    return true;
  		}else{
  			return false;
  		}
  	}
  function get_html_select($name, $start = 1, $max = 31, $withNA = 1, $with0s = 0, $withname = 0){
	$slct = "<select name=\"$name\" id=\"$name\">\n";
	$zeroval = "";
		if ($withname == 0) {
			$name = "";
		}
		if ($with0s > 0) {
			for ($i = 1; $i < $with0s; $i++) {
				$zeroval .= "0";
			}
		}
		if($withNA == 1){
			$slct  .= "<option value=\"" . $name . $zeroval . "0\" selected>NA</option>\n";
		}
		for($j = $start; $j <= $max; $j++){
			$zeroval = "";	
					for ($i = 0; $i < $with0s; $i++) {
							if((strlen($j) + strlen($zeroval)) < $with0s){
								$zeroval .= "0";
							}
					}
				
			$slct  .= "<option value=\"" . $name . $zeroval . "$j\">$j</option>\n";
		}
	$slct  .= "</select>";
	return $slct;
  }
  function css_format_span($txt, $color = "", $size = 0){
  	$css = "";
  		if ($color <> "") {
  			$css = "color:$color;";
  		}
  		if ($size <> 0) {
  			$css .= "font-size:$size;";
  		}
  		if ($css <> "") {
  			return "<span style=\"$css\">$txt</span>";
  		}else{
  			return $txt;
  		}
  }
  function get_db_col_size($db_hst, $db_un, $db_pw, $db, $tbl, $col){
  		mysql_connect($db_hst, $db_un, $db_pw);
  		mysql_select_db($db) or die("db error");
  		$result = mysql_query("SELECT $col FROM $tbl LIMIT 0;");
  			if (!$result) {
  				return 0;
  			}
  		$col_len = mysql_field_len($result, 0);
  		return $col_len;
  }
?>
