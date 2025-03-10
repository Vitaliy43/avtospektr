<?php

class CArray
{

	public static $array_sum;
	public static function get_array_sum($array,$recursive=false)
	{
		foreach($array as $elem){
			if(is_array($elem) and $recursive)
				self::get_array_sum($elem,$recursive);
		}
		self::$array_sum+=array_sum($array);
		
	}
	
	public static function arrayFromObjects($arr_objects,$key=null,$value)
	{
		$arr=array();
		$counter=0;
		
		foreach($arr_objects as $object){
		
			if($key==null)
				$arr[$counter]=$object->$value;
			else
				$arr[$object->$key]=$object->$value;

			$counter++;
		}
			
		return $arr;
		
	}
	
	public static function complexUnique($array,$key)
	{
		$arr=array();
		foreach($array as $elem){
			$arr[]=$elem[$key];
		}
		return array_unique($arr);
		
	}
	
	public static function get_last_key($array)
	{
		foreach($array as $key=>$value){
			$buffer=$key;
		}
		return $buffer;
	}
	
	public static function delete_index($array,$indexes,$assoc=false){
	
		$new_arr=array();
		foreach($array as $key=>$value){
			if(in_array($key,$indexes)){
				
			}
			else{
			if($assoc)
				$new_arr[$key]=$value;
			else
				$new_arr[]=$value;
			}
		}
		
		return $new_arr;
	}
	
	public static function delete_value($array,$value,$assoc=false){
	
		$new_arr=array();
		foreach($array as $k=>$v){
			if($v==$value){
				
			}
			else{
			if($assoc)
				$new_arr[$k]=$v;
			else
				$new_arr[]=$v;
			}
		}
		
		return $new_arr;
	}
	
	public static function string_in_array($value,$array)
	{
		foreach($array as $elem){
			
			if(stristr($value,$elem)!='')
				return true;
		}
		
		return false;
	}
	
	public static function create_javascript_array($name,$items)
	{
		$script='<script type="text/javascript">';
		$script.='var '.$name.'=new Array(';
		
		for($i=0;$i<count($items);$i++){
			$script.=$items[$i];
			if($i!=(count($items)-1))
				$script.=',';
		}
		
		$script.=');';
		
		$script.='</script>';
		return $script;
	}
	
	
	
	
}

?>