<?php



class Finance extends CApplicationComponent
{

	public static function getAverageAmount($user_id=null,$curr_data=null,$prev_data=null,$type='circulation')
	{
	
	if($user_id==null)
		$user_id=UserIdentity::getProperty('id');

	if($curr_data==null){
		 $curr_data=date("Y-m-d H:i:s");
         $curr_month=date('n');
         $curr_day=date('j');
         $curr_year=date('Y');

	}
		
		if($prev_data==null){
			$prev_month=$curr_month-1;

         if($prev_month<1) {$prev_month=12;
          $prev_year=$curr_year-1;
         }
         else{
         $prev_year=$curr_year;
         }

         $prev_data=$prev_year.'-'.$prev_month.'-'.$curr_day.' 00:00:00';
		}
         
		if($type=='circulation')
			$extract='sum(sum_client)';
		else
			$extract='sum(sum_client)-sum(sum)';
		 
		if($user_id!=1) :
		 	 
		$res=Yii::app()->db->createCommand(array(
    	'select'=>$extract.' as amount',
    	'from'=>'orders_archive',
		'where'=>'user_id=:user_id AND data_shipping BETWEEN :prev_data AND :curr_data',
		'params'=>array(':user_id'=>$user_id,':prev_data'=>$prev_data,':curr_data'=>$curr_data)
			
		))->queryAll();
		
		else:
		$res=Yii::app()->db->createCommand(array(
    	'select'=>$extract.' as amount',
    	'from'=>'orders_archive',
		'where'=>'data_shipping BETWEEN :prev_data AND :curr_data',
		'params'=>array(':prev_data'=>$prev_data,':curr_data'=>$curr_data)
			
		))->queryAll();
		
		endif;
	
		return $res[0]['amount'];
		 
	}
	
	public static function avgAmountMonth($user_id)
	{
		$year1=CTime::get_from_date(CTime::min_data(),'year');
		$year2=CTime::get_from_date(CTime::max_data(),'year');
		if($year2>$year1){
			
			for($i=$year1;$i<$year2+1;$i++){
				$amounts[$i]=self::getAmountMonth($i,'circulation',$user_id);
			}
		}
		CArray::$array_sum=0;
		CArray::get_array_sum($amounts,true);
		
		
		return round((CArray::$array_sum/count($amounts,1)),2);
	}
	
	public static function getAmountMonth($year,$type='circulation',$user_id=1)
	{
		if($year==date('Y')){
			$curr_month=date('n');
		}
		else{
			$curr_month=13;
		}
		
		$amounts=array();
			
				if($curr_month==1){
					$prev_data=($year-1).'-'.CTime::add_zero(12).'-01 00:00:00';
					$curr_data=$year.'-'.CTime::add_zero(1).'-01 00:00:00';
					$amounts[1]=self::getAverageAmount(1,$curr_data,$prev_data,$type);
				}
				else{
					for($i=1;$i<$curr_month;$i++):
				
					if($i==1)
						$prev_data=($year-1).'-'.CTime::add_zero(12).'-01 00:00:00';
					else
						$prev_data=$year.'-'.CTime::add_zero($i-1).'-01 00:00:00';
					
					$curr_data=$year.'-'.CTime::add_zero($i).'-01 00:00:00';
					$average_amount=self::getAverageAmount($user_id,$curr_data,$prev_data,$type);
					if($average_amount)
						$amounts[$i]=CPrice::getMoneyFormat($average_amount);
				endfor;
				}
		return 	$amounts;
			
		
	}
	
	public static function getAmountLastMonth($type='circulation',$user_id=1)
	{
		$amounts=self::getAmountMonth(date('Y'),'circulation',$user_id);
		if(count($amounts)==0)
			return 0;
		$arr=array_keys($amounts);
		return $amounts[max($arr)];
	}
	
	public static function addPaymentAfterShip($sum,$data_shipping)
	{
		Yii::import('application.modules.autoparts.models.Balance');
		Yii::import('application.modules.autoparts.models.Payments');

		$payment=new Payments;
		$balance=Balance::model()->find('user_id=:user_id',array(':user_id'=>$_REQUEST['client_id']));
		$payment->user_id=$_REQUEST['client_id'];
		$payment->type_operation=2;
		$payment->type_payment_id=1;
		$payment->sum=$sum;
		$payment->annotation='Продажа';
		$payment->data=CTime::data_to_db($data_shipping,true);
		$payment->balance=$balance->score-$payment->sum;

		$res=$payment->save();
				
		if($res){
			return $payment;
		}
			
		return false;
	}
	
	public static function addPayment()
	{
		Yii::import('application.modules.autoparts.models.Balance');

		$payment=new Payments;
		$balance=Balance::model()->find('user_id=:user_id',array(':user_id'=>$_POST['client_id']));
		$payment->user_id=$_POST['client_id'];
		if($_POST['type_operation']=='add')
			$payment->type_operation=3;
		else
			$payment->type_operation=2;
		$payment->type_payment_id=$_POST['type_payment'];
		$payment->sum=$_POST['sum'];
		$payment->annotation=$_POST['annotation'];
		$payment->data=CTime::data_to_db($_POST['date'],true);
		if($payment->type_operation==3){
			$payment->balance=$balance->score+$payment->sum;
			$balance->score=$payment->balance;
		}
		else{
			$payment->balance=$balance->score-$payment->sum;
			$balance->score=$payment->balance;

		}
		$res=$payment->save();
		$res=$balance->save();
		
		
		if($res){
			return $payment;
		}
			
		return false;
		
	}
	
	public static function getAmount($curr_amount,$user_id=null)
	{
	
		if($user_id==null)
		$user_id=UserIdentity::getProperty('id');
	
		$items=PriceGroups::model()->getAll('DESC');
		

         foreach($items as $item):

             $amount=$item->amount;

          if($curr_amount<$amount){          
           $need_amount=$amount;
      
          }

      	 endforeach;
          			 
			 $res=Yii::app()->db->createCommand(array(
    	'select'=>'max(amount) as max_amount',
    	'from'=>'price_groups',
			
	))->queryAll();
	
             $max_amount=$res[0]['max_amount'];

             if($curr_amount>=$max_amount) $need_amount=$max_amount;


             return $need_amount;

	}
	
	public static function getBalance($user_id=null,$admin=null)
	{
		Yii::import('application.modules.autoparts.models.Balance');
		
		if($admin)
			return Balance::model()->getScore(null,1);

		if($user_id!=null){
			return Balance::model()->getScore($user_id);
		}
		
		return Balance::model()->getScore(UserIdentity::getProperty('id'));
	}
	
	public static function getAllOutput($user_id=null,$admin=null)
	{
	
	if($admin){
		$res=Yii::app()->db->createCommand(array(
    	'select'=>'sum(sum_client) as amount',
    	'from'=>'orders_archive',
			
	))->queryAll();
	
		return $res[0]['amount'];
	}
	
	if($user_id==null)
		$user_id=UserIdentity::getProperty('id');
		 
		$res=Yii::app()->db->createCommand(array(
    	'select'=>'sum(sum_client) as amount',
    	'from'=>'orders_archive',
		'where'=>'user_id=:user_id',
		'params'=>array(':user_id'=>$user_id)
			
	))->queryAll();
	
		return $res[0]['amount'];
	}
	
	
	public static function getOrdersWork($user_id=null,$admin=null)
	{
	
	if($admin){
		$res=Yii::app()->db->createCommand(array(
    	'select'=>'sum(sum_client) as amount',
    	'from'=>'orders_status',
		'where'=>'hover=:hover',
		'params'=>array(':hover'=>2)
			
	))->queryAll();
	
	return $res[0]['amount'];
	}
	
	if($user_id==null)
		$user_id=UserIdentity::getProperty('id');
		 
		$res=Yii::app()->db->createCommand(array(
    	'select'=>'sum(sum_client) as amount',
    	'from'=>'orders_status',
		'where'=>'user_id=:user_id AND hover=:hover',
		'params'=>array(':user_id'=>$user_id,':hover'=>2)
			
	))->queryAll();
	
		return $res[0]['amount'];
	}
	
	public static function getOrdersShip($user_id,$data_shipping)
	{
		
		$res=Yii::app()->db->createCommand(array(
    	'select'=>'sum(sum_client) as amount',
    	'from'=>'orders_archive',
		'where'=>'user_id=:user_id AND data_shipping=:data_shipping',
		'params'=>array(':user_id'=>$user_id,':data_shipping'=>$data_shipping)
			
	))->queryAll();
	
		return $res[0]['amount'];
	
	
	}
	
	public static function getSaleBlankId($data_shipping)
	{
		
		$buffer=OrdersSales::model()->find('data_shipping=:data',array(':data'=>$data_shipping));
		if($buffer)
			return $buffer->id;
		
	}
	
	protected static function isDisableDiscount()
	{
		$distributors=Distributors::model()->findAll('enable_discount=:enable_discount',array(':enable_discount'=>0));
		return CArray::arrayFromObjects($distributors,null,'id');
	}
	
	public static function applyDiscount($orders=null,$user_id,$return='array')
	{
		$disable_distributors=self::isDisableDiscount();

		$first_year=Utility::getFirstYearOrders();
		for($i=date('Y');$i>$first_year;$i--){
			$amounts=self::getAmountMonth($i,'circulation',$user_id);
			if(count($amounts)>0){
				$last_key=CArray::get_last_key($amounts);
				$amount_last_month=$amounts[$last_key];
				$price_group_info=PriceGroups::model()->getPriceGroupByAmount($amount_last_month);
				$q_reduce=((100-$price_group_info['percent'])/100);
				if($return=='array'):
				foreach($orders as $order){
					if(in_array($order->distributor_id,$disable_distributors)):

					else:
					$markup=$order->sum_client-$order->sum;
					$new_markup=$q_reduce*$markup;
					$new_markup=round($new_markup,2);
					$order->sum_client=round(($order->sum_client*$q_reduce),1);
					$markup_price=$order->price_client-$order->price;
					$new_markup_price=$q_reduce*$markup_price;
					$new_markup_price=round($new_markup_price,2);
					$order->price_client=round(($order->price_client*$q_reduce),1);
					endif;
				}
				else:
					return $q_reduce;
				
				endif;
				break;
			}
		}
		
		return $orders;

	}
	
	public static function createListForSale($clients)	
	{
		$buffer=self::isDisableDiscount();
		$disable_discount_distributors=implode(',',$buffer);
		
		foreach($clients as $client){
			
		$sum=Yii::app()->db->createCommand(array(
    	'select'=>'sum(sum_client) `sum_client`, sum(sum) `sum`',
    	'from'=>'orders_status',
		'where'=>'hover=3 AND user_id='.$client['id']." AND distributor_id NOT IN ($disable_discount_distributors)"
	))->queryAll();
		if(count($sum)>0){
			$q_reduce=self::applyDiscount(null,$client['id'],'sum');
			$arr[$client['id']]=round($sum[0]['sum']*$q_reduce,2);
		}
		else{
			$arr[$client['id']]=0;
		}
		
		
		$sum_without_discount=Yii::app()->db->createCommand(array(
    	'select'=>'sum(sum_client) `sum_client`, sum(sum) `sum`',
    	'from'=>'orders_status',
		'where'=>'hover=3 AND user_id='.$client['id']." AND distributor_id IN ($disable_discount_distributors)"
	))->queryAll();
	if(count($sum_without_discount)>0){
			$arr[$client['id']].=round($sum_without_discount[0]['sum_client'],2);
	}
		
			
		}
		return $arr;
	}
	
	public static function Shipping($client_id,$data_shipping,$sum_orders)
	{
	
		Yii::import('application.modules.autoparts.models.Balance');

		$balance=Balance::model()->find('user_id=:user_id',array(':user_id'=>$client_id));
		
		$balance->score-=$sum_orders;
		$balance->all_output+=$sum_orders;
		$res=$balance->save();
		if($res)
			return true;
		return false;
	}
	
	public static function getOrdersStore($user_id=null,$admin=null)
	{
	
	if($admin){
		$res=Yii::app()->db->createCommand(array(
    	'select'=>'sum(sum_client) as amount',
    	'from'=>'orders_status',
		'where'=>'hover=:hover',
		'params'=>array(':hover'=>3)
			
	))->queryAll();
	
		return $res[0]['amount'];
	}
	
	if($user_id==null)
		$user_id=UserIdentity::getProperty('id');
		 
		$res=Yii::app()->db->createCommand(array(
    	'select'=>'sum(sum_client) as amount',
    	'from'=>'orders_status',
		'where'=>'user_id=:user_id AND hover=:hover',
		'params'=>array(':user_id'=>$user_id,':hover'=>3)
			
	))->queryAll();
	
		return $res[0]['amount'];
	}
	
	public static function getPriceGroup($average_amount,$user_id=null)
	{
		if($user_id==null)
			$user_id=UserIdentity::getProperty('id');
		
		
		return PriceGroups::model()->getPriceGroupName(self::getAmount($average_amount,$user_id));
			
	}
	
	public static function getLimitCredit($user_id=null)
	{
	
		Yii::import('application.modules.client.models.Clients');

		if($user_id==null)
			$user_id=UserIdentity::getProperty('id');
		
		$balance=self::getBalance($user_id);
		$sum_orders=self::getOrdersWork($user_id);
		$sum_store=self::getOrdersStore($user_id);
		
		$limit_credit=Clients::model()->getLimitCredit($user_id);
		$credit=($limit_credit-($sum_orders+$sum_store))+$balance;
		
		return $credit;
			
			
	}
	
	public static function checkBalance($sum,$user_id)
	{
		$credit=self::getLimitCredit($user_id);
		if($credit<$sum)
			return false;
		return true;
	}
	
}

?>