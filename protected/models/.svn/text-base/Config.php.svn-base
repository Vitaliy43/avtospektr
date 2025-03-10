<?php

class Config extends CActiveRecord
{

	protected $default=array(
	'session_lifetime'=>3600,
	'cookie_lifetime'=>3600,
	'enable_cookie'=>'true'

	);

public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'config';
	}
	
	
	public function getObjects($key,$value,$user_id=1)
	{
		$res=$this->find(array(
		'select'=>'list_objects',
		'condition'=>'item_key=:key AND user_id=:id AND item_value=:item_value',
		'params'=>array(':key'=>$key,':id'=>$user_id,':item_value'=>$value)
		));
		
		$arr=explode(',',$res->list_objects);
		return $arr;
		
	}
	
	public function item($key,$user_id=1,$object=null)
	{
		
		
		$res=$this->find(array(
		'select'=>'*',
		'condition'=>'item_key=:key and user_id=:id',
		'params'=>array(':key'=>$key,':id'=>$user_id)
		));
		
		if(isset($res->list_objects) and isset($object)){
			
			$buffer=explode(',',$res->list_objects);
			
			foreach($buffer as $elem){
				
				if($elem==$object)
					return $res->item_value;
			}
			return false;
		}
		
		if($res)
			return $res->item_value;
		return false;
				
		
	}
	
	public function itemAndGroup($key,$user_id=1,$group,$controller)
	{
		
		$res=$this->find(array(
		'select'=>'*',
		'condition'=>'item_key=:key AND user_id=:id AND group=:group AND item_value=:item_value',
		'params'=>array(':key'=>$key,':id'=>$user_id,':group'=>$group,':item_value'=>$controller)
		));
		
		if($res):
		 $buffer=explode(',',$res->list_objects);
		 $counter=0;
		 if(count($buffer)>0){
			return $buffer;
			
		 }
		 
		 endif;
		 
		return false;
				
		
	}
	
}

?>