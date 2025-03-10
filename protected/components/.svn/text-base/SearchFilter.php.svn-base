<?php

class SearchFilter extends CApplicationComponent
{
	
	protected static function get_requests($params,$empty_values)
	{
	
	 
		$arr=array();
		foreach($params as $key=>$value){
			
			if(isset($_REQUEST[$key]))
				$request=$_REQUEST[$key];
			
			
			if(empty($request) or $request=='' or in_array($request,$empty_values) or $request=='all'){
				
			}
			else{
				$arr["$key-$value"]=$request;
			}

		}
		
		return $arr;
	}
	
	
	public static function create_condition($params,$empty_values)
	{
		
		$arr=self::get_requests($params,$empty_values);
		
		$condition='';
		$counter=0;
		
	
		if(count($arr)>0):
		
		foreach($arr as $key=>$value){
		
		list($key1,$key2)=explode('-',$key);
			
			if($counter==0){
			
				$condition.=$key2;
				
				if(strpos($key,'1')){
					$condition.=' BETWEEN :'.$key1;
					
				}
				else{
					$condition.='=:'.$key1;
				}
					
				
			}
			else{
			
			if(strpos($key,'2'))
				$condition.=' AND ';
			else
				$condition.=' AND '.$key1;

				
				if(strpos($key,'1')){
					$condition.=' BETWEEN :'.$key1;
					
				}
				else{
					if(strpos($key,'2'))
						$condition.=':'.$key1;

					else
						$condition.='=:'.$key1;
				}
				
				
			}
			
			
			$counter++;
		}
		
		endif;
		
		
		return $condition;
		
	}
	
	public static function create_params($params,$empty_values)
	{
	
	$arr=self::get_requests($params,$empty_values);
	
	$new_arr=array();
	
	foreach($arr as $key=>$value){
	
		list($key1,$key2)=explode('-',$key);
		
		if(strstr($key1,'date')!='')
			$new_arr[":$key1"]=CTime::data_to_db($value);
		else
			$new_arr[":$key1"]=$value;
	}
		
		
		return $new_arr;
	}
	
	
}

?>