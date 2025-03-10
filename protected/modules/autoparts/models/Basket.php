<?php

class Basket extends Model
{
	public static $type_payments=array('card'=>'Банковская карта');
	public static $type_delivery=array('self'=>'Самовывоз');
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'basket';
	}
	
	public function Add($id)
	{

		$command = Yii::app()->db->createCommand();

		if(UserIdentity::getProperty('role')){
			$result=SearchResult::model()->findByPk($id);
			$fields=array(
			'id'=>null,
			'product_code'=>$result->uniq_id,
			'manufacturer'=>$result->manufacturer,
			'number'=>$result->number,
			'info'=>$result->info,
			'price'=>$result->price,
			'price_client'=>$result->price_client,
			'sum'=>$result->price,
			'sum_client'=>$result->price_client,
			'quantity'=>1,
			'quantity_on_store'=>$result->quantity,
			'period_min'=>$result->period_min,
			'period_max'=>$result->period_max,
			'distributor_id'=>$result->distributor_id,
			'user_id'=>$result->user_id
			);
		
		 	$res=$command->insert($this->tableName(),$fields);
		}
		else{
			$sql="SELECT * FROM search_result_guests WHERE id = $id";
			$result=Yii::app()->db->createCommand($sql)->queryRow();	
			$fields=array(
			'id'=>null,
			'product_code'=>$result['uniq_id'],
			'manufacturer'=>$result['manufacturer'],
			'number'=>$result['number'],
			'info'=>$result['info'],
			'price'=>$result['price'],
			'price_client'=>$result['price_client'],
			'sum'=>$result['price'],
			'sum_client'=>$result['price_client'],
			'quantity'=>1,
			'quantity_on_store'=>$result['quantity'],
			'period_min'=>$result['period_min'],
			'period_max'=>$result['period_max'],
			'distributor_id'=>$result['distributor_id'],
			'ip'=>$_SERVER['REMOTE_ADDR']
			);
		
		 	$res=$command->insert('basket_guests',$fields);
		}
		
		 return $res;

	}
	
	public function Order($arr)
	{
		$command=Yii::app()->db->createCommand();
		$connection=$command->getConnection();
		
		foreach($arr as $key=>$value){
			
			$basket=$this->findByPk($key);
			$buffer_comment='comment_'.$key;

			if(isset($_SESSION['order_info'][$buffer_comment]))
				$comment=$_SESSION['order_info'][$buffer_comment];
			else
				$comment='';	
			
			$data=array(
			'id'=>null,
			'old_id'=>null,
			'data_waiting'=>date("Y-m-d H:i:s"),
			'data_working'=>'0000-00-00 00:00:00',
			'data_modified'=>'0000-00-00 00:00:00',
			'product_code'=>$basket->product_code,
			'manufacturer'=>$basket->manufacturer,
			'number'=>$basket->number,
			'info'=>$basket->info,
			'price'=>$basket->price,
			'sum'=>round(($basket->price*$value),2),
			'price_client'=>$basket->price_client,
			'sum_client'=>round(($basket->price_client*$value),2),
			'quantity'=>$basket->quantity,
			'quantity_on_store'=>$basket->quantity_on_store,
			'period_min'=>$basket->period_min,
			'period_max'=>$basket->period_max,
			'distributor_id'=>$basket->distributor_id,
			'user_id'=>$basket->user_id,
			'hover'=>1,
			'status_id'=>1,
			'order_id_by_distributor'=>null,
			'comment'=>$comment
			);
			
			$res=$command->insert(OrdersStatus::model()->tableName(),$data);
			$last_id=$connection->getLastInsertID();
			if($last_id)
				$_SESSION['order_id']=$last_id;
			if($res)
				$this->deleteByPk($key);
			unset($basket);

			
		}

		return $res;

	}
	
	function deleteGuestsByPk($id)
	{
		$command = Yii::app()->db->createCommand();
		$result=$command->delete('basket_guests','id=:id',array(':id'=>$id));
		return $result;
	}
	
	function getGuestsByPk($id)
	{
		$sql="SELECT * FROM basket_guests WHERE id = $id";
		$order=Yii::app()->db->createCommand($sql)->queryRow();
		return $order;
	}
	
//	function countGuestsByPk
	
	function changeQuantityGuests(){
		$command = Yii::app()->db->createCommand();
		if(isset($_REQUEST["quantity"]) and isset($_REQUEST['order_id'])){
			$sql="SELECT * FROM basket_guests WHERE id = '".$_REQUEST['order_id']."'";
			$order=Yii::app()->db->createCommand($sql)->queryRow();
			$curr_quantity=$order['quantity'];
			$price=$order['price'];
			$price_client=$order['price_client'];
			if($_REQUEST['sign']=='plus'){
				$data['sum']=$price*($curr_quantity+1);
				$data['sum_client']=$price_client*($curr_quantity+1);
				$data['quantity']=$curr_quantity+1;
			}
			elseif($_REQUEST['sign']=='none'){
				$data['sum']=$price*$_REQUEST["quantity"];
				$data['sum_client']=$price_client*$_REQUEST["quantity"];
				$data['quantity']=$_REQUEST["quantity"];
			}
			else{
				$data['sum']=$price*($curr_quantity-1);
				$data['sum_client']=$price_client*($curr_quantity-1);
				$data['quantity']=$curr_quantity-1;
			}
			$buffer['quantity']=$data['quantity'];
			$buffer['sum']=$data['sum_client'];
//			$res=$order->save();
			$res=$command->update('basket_guests',$data,'id=:id',array(':id'=>$_REQUEST['order_id']));
			if($res)
				$buffer['answer']=1;
			else
				$buffer['answer']=0;
			return $buffer;
		}
		else{
			return false;
		}

	}
	
	public function changeQuantity()
	{
		if(isset($_REQUEST["quantity"]) and isset($_REQUEST['order_id'])){
			$order=$this->findByPk($_REQUEST['order_id']);
			$curr_quantity=$order->quantity;
			$price=$order->price;
			$price_client=$order->price_client;

			if($_REQUEST['sign']=='plus'){
				$order->sum=$price*($curr_quantity+1);
				$order->sum_client=$price_client*($curr_quantity+1);
				$order->quantity=$curr_quantity+1;
			}
			elseif($_REQUEST['sign']=='none'){
				$order->sum=$price*$_REQUEST["quantity"];
				$order->sum_client=$price_client*$_REQUEST["quantity"];
				$order->quantity=$_REQUEST["quantity"];
			}
			else{
				$order->sum=$price*($curr_quantity-1);
				$order->sum_client=$price_client*($curr_quantity-1);
				$order->quantity=$curr_quantity-1;
			}
			$buffer['quantity']=$order->quantity;
			$buffer['sum']=$order->sum_client;
			$res=$order->save();
			if($res)
				$buffer['answer']=1;
			else
				$buffer['answer']=0;
			return $buffer;
		}
		else{
			return false;
		}
	}
	
	
	
	public function count_items($user_id=null)
	{
		if($user_id==null)
			$user_id=UserIdentity::getProperty('id');
		return $this->count('user_id=:user_id',array(':user_id'=>$user_id));
	}
	
	public function count_items_guests()
	{
		$sql="SELECT COUNT(*) AS 'num' FROM basket_guests WHERE ip = '".$_SERVER['REMOTE_ADDR']."'";
		$result=Yii::app()->db->createCommand($sql)->queryRow();
		return $result['num'];
	}
	
	protected function get_client_by_id($user_id)
	{
		$sql="SELECT COUNT(*) AS 'num' FROM clients WHERE user_id = $user_id";
		$result=Yii::app()->db->createCommand($sql)->queryRow();
		if(!$result['num'])
			return false;
		return true;
	}
	
	public function transfer_orders(){
		$parts=$this->orders_guests();
		$user_id = UserIdentity::getProperty('id');
		$web_service = new WebService;
	
		if(count($parts) > 0 && $user_id){
			foreach($parts as $part){
				if($this->get_client_by_id($user_id))
					$complex_markups=$web_service->getComplexMarkups($part['distributor_id'],$user_id);
				else
					$complex_markups=$web_service->getComplexMarkups($part['distributor_id'],$web_service->authorized_id);
				 $complex_add_price=$web_service->getMarkup($complex_markups,$part['price']);

				$basket=new Basket;
				$basket->id=null;
				$basket->product_code=$part['product_code'];
				$basket->manufacturer=$part['manufacturer'];
				$basket->number=$part['number'];
				$basket->info=$part['info'];
				$basket->price=$part['price'];
				$basket->price_client=round($part['price']*$complex_add_price,1);
				$basket->sum=$part['sum'];
				$basket->sum_client=round($basket->price_client*$part['quantity'],1);
				$basket->quantity=$part['quantity'];
				$basket->quantity_on_store=$part['quantity_on_store'];
				$basket->period_min=$part['period_min'];
				$basket->period_max=$part['period_max'];
				$basket->distributor_id=$part['distributor_id'];
				$basket->user_id=$user_id;
				$basket->comment=null;
				$basket->save();
			}
			
			$this->delete_orders_guests();
		}
	}
	
	public function orders_guests()
	{

		$sql="SELECT * FROM basket_guests WHERE ip = '".$_SERVER['REMOTE_ADDR']."'";
		$result=Yii::app()->db->createCommand($sql)->queryAll();
		return $result;	
	}
	
	public function delete_orders_guests(){
		$command = Yii::app()->db->createCommand();
		$result=$command->delete('basket_guests','ip=:ip',array(':ip'=>$_SERVER['REMOTE_ADDR']));

	}
	
	public function OrderWithoutAjax()
	{
		$ids=explode(',',$_REQUEST['ids']);
		foreach($ids as $elem){
			if(isset($_REQUEST["check"][$elem]))
				$arr[$elem]=$_REQUEST["quantity"][$elem];
		}
		
		return $this->Order($arr);
		
	}

}
	


?>