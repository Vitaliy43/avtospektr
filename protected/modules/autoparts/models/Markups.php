<?php

class Markups extends Model
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'markups';
	}
	
	public function relations()
	{
	
		return array(
		'user'=>array(self::BELONGS_TO,'Users','user_id'),
		'distributor'=>array(self::BELONGS_TO,'Distributors','distributor_id')
				
		);
		
	}
	
	public function updateListMarkups($user_id)
	{
		$buffer_data_markups=explode(',',$_REQUEST['markups']);
		 
		foreach($buffer_data_markups as $elem){
			if($elem!=''):
			list($key,$value)=explode(':',$elem);
			$data_markups[$key]=$value;
			endif;
		}
		$markups=$this->getByUserId($user_id);
		$markups_arr=CArray::arrayFromObjects($markups,'distributor_id','markup');
		$keys_markups_arr=array_keys($markups_arr);
		$keys_data_markups=array_keys($data_markups);
		 
		$differ=array_diff($keys_data_markups,$keys_markups_arr);
		
		foreach($markups as $markup){
			$markup->markup=$data_markups[$markup->distributor_id];
			$markup->save();
		}
		
	
	
		
		if(count($differ)>0){
			foreach($differ as $elem):
			$markup=new Markups;
			$markup->user_id=$user_id;
			$markup->distributor_id=$elem;
			$markup->markup=$data_markups[$elem];
			$markup->save();
			
			endforeach;
		}
		
		
	}
	
	public function addListMarkups()
	{
		$buffer_data_markups=explode(',',$_REQUEST['markups']);
		 
		foreach($buffer_data_markups as $elem){
			if($elem!=''):
			list($key,$value)=explode(':',$elem);
			$data_markups[$key]=$value;
			endif;
		}
		foreach($data_markups as $key=>$value):
			$markup=new Markups;
			$markup->user_id=$_REQUEST['client_id'];
			$markup->distributor_id=$key;
			$markup->markup=$data_markups[$key];
			$markup->save();
		endforeach;
		
	}
	
	public function updateComplexMarkups($array,$distributor_id,$client_id)
	{

		foreach($array as $key=>$value){
		
		$buffer=explode('_',$key);
		$id=$buffer[count($buffer)-1];
		if(count($buffer)==4 and $buffer[0]=='price'):
			
			$markup=$array['markup_name_edit_'.$buffer[3]];
			$item=$this->findByPk($id);
			$item->markup=$markup;
			$item->price_range=$value;
			$res=$item->save();
			if(!$res)
				return false;
		endif;

		}
		
		return true;
	}
	
	public function addComplexMarkups($array,$distributor_id,$client_id)
	{
	
		foreach($array as $key=>$value){
		
		$buffer=explode('_',$key);
		if(count($buffer)==3 and $buffer[0]=='price'):
			
			$markup=$array['markup_name_'.$buffer[2]];
			$item=new Markups;
			$item->user_id=$client_id;
			$item->distributor_id=$distributor_id;
			$item->markup=$markup;
			$item->price_range=$value;
			$res=$item->save();
			if(!$res)
				return false;
		endif;

		}
		
		return true;
	}
	
	public function getByUserId($user_id,$distributor_id=null)
	{
		
		$criteria=new CDbCriteria;
		if(!$distributor_id){
			$criteria->condition='user_id=:id AND price_range IS NULL';
			$criteria->params=array(':id'=>$user_id);
		}
		else{
			$criteria->condition='user_id=:id AND distributor_id=:distributor_id AND price_range IS NULL';
			$criteria->params=array(':id'=>$user_id,':distributor_id'=>$distributor_id);
		}
		
		$criteria->with=array('distributor');
		$criteria->order='distributor_id';
		return $this->findAll($criteria);
			 
	}
	
	public function getArrayByKey($objects,$key,$value,$add_key)
	{
	
		$arr=array();
		foreach($objects as $object){
			
			if($object->$key==$value)
				$arr[$object->$add_key]=$object->markup;
		}
		
			return $arr;
		 
		
	}
	
	
}

?>