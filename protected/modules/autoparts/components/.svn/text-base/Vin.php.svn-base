<?php

class Vin extends CApplicationComponent
{
	
	
	
	public static function years_output()
	{
		$arr['']='';
		for($year=date('Y');$year>1939;--$year){
			$arr[$year]=$year;
		}
		
		return $arr;
	}
	
	public static function get_brands()
	{
		$items=Yii::app()->db->createCommand(array(
    	'select'=>'*',
    	'from'=>'catalog_brands',
		'order'=>'name'
		))->queryAll();
		
		$arr[0]='Любая фирма';
		foreach($items as $item){
			$arr[$item['id']]=$item['name'];
		}
		
		
		
		return $arr;
	}
	
	public static function get_vin($name,$id=null)
	{
		$items=Yii::app()->db->createCommand(array(
    	'select'=>'*',
    	'from'=>"vin_$name",
		'order'=>$name
		))->queryAll();
		
		$arr['--']='';
		foreach($items as $item){
			$arr[$item['id']]=$item[$name];
		}
		
		if($id==null or $id==0)
			return $arr;
		else
			return $arr[$id];
	}
	
	public static function list_vins()
	{
		$vins=VinController::$tables;
		
	
	}
	
}

?>