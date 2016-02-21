<?
//Bogmoth SQL String v0.0.2 20060427
//-added extra if statement (line 45) to allow full name of column as alias.
class sql_string{
	
	//Debug variables
	var $bolDebug = 0;
	var $strDebugNewLine = "<br>\n";
	var $fontErrStartTag = "<font color=\"#00ff00\">";
	var $fontErrEndTag = "</font> \n</br>\n";
	//Initialised SQL default values.
	var $str_All_SQL = " SELECT ";
	var $str_cols = "*";
	var $str_FROM_SQL = " FROM ";
	var $tbl = "tblProducts";
	//Unitialised SQL values
	var $where_criteria;
	var $order_by;
	var $group_by;
	var $limit;
	//Set up aliases. Uselful for 2 or more talbles.
	var $ary_col_aliases;
		function sql_string($tbl = ""){
			if($tbl <> ""){
          		$this->set_db_table($tbl);
          	}
		}
		function set_db_table($tbl){
			$this->tbl = $tbl;
				if($this->bolDebug == 1){echo "<font color=\"$this->debug_font_color\">STR TABLE:</font> " . $tbl . $this->strDebugNewLine;}
		}
		function set_db_col_aliases($alias){
				if (is_array($alias)) {
					$this->ary_col_aliases = $alias;
				}else{
					$this->ary_col_aliases = array($alias);
				}
				if($this->bolDebug == 1){echo "<font color=\"$this->debug_font_color\">STR ALIASES:</font> "; print_r($alias); echo $this->strDebugNewLine;}
		}
		function set_db_cols($cols, $bol = 0, $bolPrint = 0){
			$i = 0;
				if (!is_array($cols)) { 
					 $cols = array($cols);
				}
				foreach ($cols as $ary_Item){
					$str_Alias = "";
						if((!isset($this->ary_col_aliases[$i]) || ($this->ary_col_aliases[$i] == "")) && ($bol == 0)){
							$this->ary_col_aliases[$i] = $ary_Item;
						}elseif((!isset($this->ary_col_aliases[$i]) || ($this->ary_col_aliases[$i] == "")) && ($bol == 1)){
							$str_Alias = " AS '$ary_Item'";
						}else{
							$str_Alias = " AS '" . $this->ary_col_aliases[$i] . "'";
						}
						if ($i == 0) {
							$this->str_cols = $ary_Item . $str_Alias;
						}else{
							$this->str_cols = $this->str_cols . ", " . $ary_Item . $str_Alias;
						}
					$i++;
				}
				if(($bolPrint == 1) || ($this->bolDebug == 1)){print_r($this->str_cols );}
		}
		function set_db_where($criteria){
				/*if ((is_null($criteria)) || ($criteria == "")) {
					$criteria = NULL;
				}elseif (is_string($criteria)){
					$criteria = "'$criteria'";
				}*/
			$this->where_criteria = " WHERE " . $criteria;
		}
		function set_db_order($order){
			$this->order_by = " ORDER BY " . $order;
		}
		function set_db_group($str){
			$this->group_by = " GROUP BY " . $str;
		}
		function set_db_limit($limit = 1){
			$this->limit = " LIMIT " . $limit;
		}
		function get_SQL($bolPrint = 0){
			$this->str_All_SQL = $this->str_All_SQL . $this->str_cols . $this->str_FROM_SQL . $this->tbl . $this->where_criteria . $this->group_by . $this->order_by . $this->limit . ";";
				if(($bolPrint == 1) || ($this->bolDebug == 1)){echo $this->fontErrStartTag . "SQL STR:" . $this->fontErrEndTag . $this->str_All_SQL . $this->strDebugNewLine;}
			return $this->str_All_SQL;
		}
		function get_Aliases($bolPrint = 0){
				if(($bolPrint == 1) || ($this->bolDebug == 1)){echo $this->fontErrStartTag . "ALIAS ARY:" . $this->fontErrEndTag; print_r($this->ary_col_aliases); echo $this->strDebugNewLine;}
			return $this->ary_col_aliases;
		}
		function set_bolDebug($bol = 1){
            $this->bolDebug = $bol;
        }
}
    
?>