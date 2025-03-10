<?php

class Payments extends Model
{

	public $filter_params=array(
	'date1'=>'data',
	'date2'=>'data',
	'type_payment'=>'type_payment_id',
	'type_operation'=>'type_operation'
	);
	
	public $field_order='data';


	public function tableName()
	{
		return 'payments';
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function relations()
	{
		return array(
		'user'=>array(self::BELONGS_TO,'Users','user_id'),
		'type_payment'=>array(self::BELONGS_TO,'TypePayments','type_payment_id')
		
		);
	}
}

?>