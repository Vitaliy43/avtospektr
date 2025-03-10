<?php

class Orders extends Model
{

	
	public $filter_params=array();
	
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	

	public function __construct(){
		
	}
}

?>