<?php

class TypePayments extends CActiveRecord
{
	public function tableName()
	{
		return 'type_payments';
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function relations()
	{
		return array(
		'type_payment'=>array(self::HAS_MANY,'Payments','type_payment_id'),
		'type_payment'=>array(self::HAS_MANY,'Users','type_payment_id')
		);
	}
	
	public function getIdByType($type)
	{
	
		
		$item=$this->find(array(
		'select'=>'id',
		'condition'=>'type=:type',
		'params'=>array(':type'=>$type)
		)
		);
		
		return $item->id;
		
	}
	
	public function getAllForFilter($sort=''){
	
			$items=$this->findAll(array(
			'select'=>'*',
			'order'=>'show_type '.$sort
			
			)
			);
			
			foreach($items as $item){
				
				$new_arr[$item->id]=$item->show_type;
			}
			
			$new_arr[0]='Все';
			
			return $new_arr;
			
	}
}

?>