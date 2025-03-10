<?php

class OrdersArchive extends Orders
{

	public $filter_params=array(
	'date1'=>'data_shipping',
	'date2'=>'data_shipping',
	'number'=>'number',
	'manufacturer'=>'manufacturer'
	);
	
	public $field_order='data_shipping';
	

public function tableName()
	{
		return 'orders_archive';
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
		'user'=>array(self::BELONGS_TO,'Users','user_id'),
		'distributor'=>array(self::BELONGS_TO,'Distributors','distributor_id')
				
		);
	}
	
	
	
	public function saveOrders($orders_status,$date)
	{
		
		$command = Yii::app()->db->createCommand();

	
		foreach($orders_status as $order){
			
			$data['id']=null;
			$data['old_id']=$order->old_id;
			$data['data_waiting']=$order->data_waiting;
			$data['data_working']=$order->data_working;
			$data['data_shipping']=$date;
			$data['product_code']=$order->product_code;
			$data['manufacturer']=$order->manufacturer;
			$data['number']=$order->number;
			$data['info']=$order->info;
			$data['price']=$order->price;
			$data['price_client']=$order->price_client;
			$data['sum_client']=$order->sum_client;
			$data['sum']=$order->sum;
			$data['quantity']=$order->quantity;
			$data['quantity_on_store']=$order->quantity_on_store;
			$data['period_min']=$order->period_min;
			$data['period_max']=$order->period_max;
			$data['distributor_id']=$order->distributor_id;
			$data['user_id']=$order->user_id;
			if($order->comment)
				$data['comment']=$order->comment;
			
			$command->insert('orders_archive',$data);
			
		}
	}

	public function getOrdersById($id)
	{
	
		$orders=$this->findAll(array(
		'select'=>'*',
		'condition'=>'user_id=:id',
		'params'=>array(':id'=>$id),
		'order'=>'data_shipping DESC'
		
		));
		
		return $orders;
	
	}

public function getOrdersByDataShipping($data,$user_id=null)
{

	if($user_id):
	$orders=$this->findAll(array(
		'select'=>'*',
		'condition'=>'user_id=:user_id AND data_shipping=:data_shipping',
		'params'=>array(':user_id'=>$user_id,':data_shipping'=>$data),
		'order'=>'id'
		
		));
	else:
	$orders=$this->findAll(array(
		'select'=>'*',
		'condition'=>'data_shipping=:data_shipping',
		'params'=>array(':data_shipping'=>$data),
		'order'=>'id'
		
		));
	
	endif;
		
		return $orders;
}
	
}

?>