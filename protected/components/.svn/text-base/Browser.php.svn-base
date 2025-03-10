<?php

class Browser extends CApplicationComponent{
	
	public static function get_browser(){
		
$brow = $_SERVER['HTTP_USER_AGENT'];
$browsers = array ("MSIE", "Firefox","Presto","Chrome", "Safari");
$browser = '';

for($i = 0; $i < count($browsers); $i++) {
    if(strpos($brow,$browsers[$i])) {
      $browser=$browsers[$i];
      break;
    }
}

if(strstr($brow,'Presto')<>'') {

if(strpos($brow,'2.2.15')) 
$browser='Opera AC';
}
return $browser;
	}
	
}

?>