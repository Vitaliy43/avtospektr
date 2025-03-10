<?php

class OrdersStatus extends Orders
{

	public $filter_params=array(
	'date1'=>'data_waiting',
	'date2'=>'data_waiting',
	'number'=>'number',
	'manufacturer'=>'manufacturer'
	);
	

	public $field_order='data_waiting';

	public function tableName()
	{
		return 'orders_status';
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function relations()
	{
		return array(
		'user'=>array(self::BELONGS_TO,'Users','user_id'),
		'status'=>array(self::BELONGS_TO,'Statuses','status_id'),
		'distributor'=>array(self::BELONGS_TO,'Distributors','distributor_id')	
		);
	}
	
	public function removeSale($client_id)
	{
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:id AND hover=3';
		$criteria->params=array(':id'=>$client_id);
		$items=$this->findAll($criteria);
		
		foreach($items as $item){
			
			$item->hover=2;
			$item->status_id=6;
			$item->save();
		}
		
	}

	/**
	 * @return string the associated database table name
	 */
	
}

?>