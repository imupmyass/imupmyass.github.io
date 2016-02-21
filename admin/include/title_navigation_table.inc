<?
$this_month = date("n");
$this_day = date("j");
$this_day_3_chr = date("D");
$this_year = date("Y");	//e.g 2006
$this_hour = date("G");
$mod_day_of_year = date("z") % 2;
$title_picture_1 = "small_ass-ass.jpg";
$title_picture_2 = $title_picture_1;
$title = "Welcome to Astrid's Website!";
$site_table_width = "625";
$site_table_image_alt = "Astrid";
$boldebugimg = 0;
	if($this_month == 12){
		if($this_day <= 10){
			$title_picture_1 = "xmas_tree_cartoon.png";
			$title_picture_2 = $title_picture_1;
			$title = "Christmas is Coming!";		
			$index_image = "rozel_astrid_car_snow.jpg"; //front page main image.
			$index_image_alt = "Astrid in Rozel";
		}elseif($this_day > 10 && $this_day <= 20){
			$title_picture_1 = "angel.jpg";
			$title_picture_2 = $title_picture_1;
			$title = "Merry Christmas from Astrid!!";		
			$index_image = "rozel_astrid_car_snow.jpg"; //front page main image.
			$index_image_alt = "Astrid in Rozel";
		}elseif($this_day > 20 && $this_day <= 27){
			$title_picture_1 = "christmas_leprechaun.gif";
			$title_picture_2 = $title_picture_1;
			$title = "Christmas is Now Upon Us!!!";		
			$index_image = "nero_river_santa.jpg"; //front page main image.
			$index_image_alt = "Nero!!";
		}
	}elseif($this_month == 6 && $this_day > 1 && $this_day < 20){
		$title = "Astrid's birthday = 20/06/$this_year";
	}elseif($this_month == 6 && $this_day == 20){
		$title_picture_1 = "happy_birthday_bear.jpg";
		$title_picture_2 = $title_picture_1;
		$title = "TODAY is Astrid's birthday!!";
	}elseif($this_day_3_chr == "Sun"){
		if($mod_day_of_year == 0){
			$title_picture_1 = "sm_nero_tyre.jpg";
			$title_picture_2 = "ruski_head.jpg";
		}else{
			$title_picture_1 = "ruuski_beach.jpg";
			$title_picture_2 = "nero_beach.jpg";
		}
	}elseif($this_day_3_chr == "Thu"){
			if($this_hour >= 18){	
				$title_picture_2 = "eve.jpg";
				$title_picture_1 = "joseph.jpg";
			}else{
				if($mod_day_of_year == 1){
					$title_picture_1 = "white_lab_1.jpg";
					$title_picture_2 = "white_lab_2.jpg";
				}else{		
					$title_picture_2 = "white_lab_1.jpg";
					$title_picture_1 = "white_lab_2.jpg";
				}
			}
	}elseif($mod_day_of_year == 1){
		$mod_day_of_year = date("z") % 4;
			if($mod_day_of_year == 1){
				$title_picture_1 = "sm_ass.jpg";
				$title_picture_2 = $title_picture_1;
			}else{				
				$title_picture_1 = "fcub.jpg";
				$title_picture_2 = $title_picture_1;
			}
	}else{
		if($this_day_3_chr == "Mon" && $this_hour == 12){
			$title_picture_1 = "johnathon.jpg";
			$title_picture_2 = $title_picture_1;
		}else{		
			$title_picture_1 = "arab.jpg";
			$title_picture_2 = $title_picture_1;
		}
	}
if($boldebugimg == 1){
	echo "year:" . $this_year . " month:" . $this_month . " day:" . $this_day . " " . $this_day_3_chr . " . hour:" . $this_hour . " mod_day_of_year:" . $mod_day_of_year . "<p>";
}
?>
		<table border="0" width="<? echo $site_table_width; ?>" style="border: 0px solid #999999;"><tr>
		<td style="width:120;" rowspan="2">
			<img src="<? print $root_dir; ?>imgs/<? print $title_picture_1; ?>" width="100" height="100" alt="<? print $site_table_image_alt; ?>">
		</td>		
		<td align="center" valign="bottom">
			<p style="font-size: large"><b><? print $title; ?></b></p>
		</td><td style="width:120;" align="right" rowspan="2">
			<img src="<? print $root_dir; ?>imgs/<? print $title_picture_2; ?>" width="100" height="100" alt="<? print $site_table_image_alt; ?>">
		</td></tr>		
		<tr><td align="center">			
		<table><tr><td style="border: 0px solid #999999; font-size: 75%;">
				&nbsp;<a href="<? print $root_dir; ?>" style="text-decoration: none;">Home</a>
				 | <a href="<? print $root_dir; ?>imgs/" style="text-decoration: none;">Photos</a>
				 | <a href="<? print $root_dir; ?>thoughts/" style="text-decoration: none;">Thoughts</a>
				 | <a href="<? print $root_dir; ?>thoughts/tips.php" style="text-decoration: none;">Tips</a>
				 | <a href="<? print $root_dir; ?>blog/" style="text-decoration: none;">Blog</a>&nbsp;
				 | <a href="<? print $root_dir; ?>contact/" style="text-decoration: none;">Contact</a>&nbsp;
			</td></tr></table>
		</td></tr></table>
