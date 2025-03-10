<?php

class OrdersSales extends Orders
{
	public $filter_params=array(
	'date1'=>'data_shipping',
	'date2'=>'data_shipping',
	
	);
	
	public $field_order='data_shipping';
	

public function tableName()
	{
		return 'orders_sales';
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/**
	 * @return string the associated database table name
	 */
	 
	 
	 public function relations()
	{
		return array(
		'orders'=>array(self::BELONGS_TO,'OrdersArchive','data_shipping'),
		'user'=>array(self::BELONGS_TO,'Users','user_id'),

		);
	}
	
	
	public function getSaleById($id)
	{
		$sale=$this->find(array(
		'select'=>'*',
		'condition'=>'id=:id',
		'params'=>array(':id'=>$id)
		
		));
		
		return $sale;
	}
}

?>