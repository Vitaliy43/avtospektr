<?php

class CFile extends CFileHelper
{
	public static function getLastModifiedFile($file,$unix_time=false)
	{
		if (file_exists($file)) {
			if($unix_time)
   			 	return filemtime($file);
			else
				return date ("Y-m-d H:i:s", filemtime($file));
		}
		else{
			return false;
		}

	}
	
}

?>