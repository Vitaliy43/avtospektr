<?php

	Yii::import('application.modules.autoparts.models.OrdersStatus');


class OptionController extends OptionsController
{


	public function actionDelete()
	{
		if(isset($_POST['type'])):
		
		$order_id=(int)$_POST['order_id'];
		OrdersStatus::model()->deleteByPk($order_id);
		
		 	
	endif;
	}
	
	public function actionGet()
	{
		$type=$_POST['type_option'];
		
		switch($type){
			
			case 'show_sale':
			$response=$this->showSale($_POST['client_id'],$_POST['sum_client']);
			break;
		}
		
		echo CJSON::encode($response);
	}
	
	public function actionSet()
	{
		
		$type=$_POST['type_option'];
		if(isset($_POST['dist_ord_id']))
			$dist_ord_id=$_POST['dist_ord_id'];
		else
			$dist_ord_id=null;
		 
		
		switch($type){
			
			case 'to_work':
			$response['content']=$this->toWork($_POST['order_id']);
			break;	
			
			case 'start_order':
			Yii::import('application.modules.autoparts.models.Distributors');
			Yii::import('application.modules.autoparts.models.Statuses');
			$response=$this->startOrder($_POST['order_id'],$dist_ord_id);
			break;
			
			case 'change_status':
			$buffer=$this->changeStatus($_POST['order_id'],$_POST['status']);
			if($buffer):
				$response['modified']=CTime::change_show_data($buffer);
				$response['answer']=1;
			else:
				$response['answer']=0;
			endif;
			
			break;
		}
		
		echo CJSON::encode($response);
	}
	

	
	protected function showSale($client_id,$sum_client)
	{
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='hover=3 AND user_id=:user_id';
		$criteria->params=array(':user_id'=>$client_id);
		$orders=OrdersStatus::model()->findAll($criteria);
		$orders=Finance::applyDiscount($orders,$client_id);
		$client=Users::model()->findByPk($client_id);
		
		$buffer['num_items']=count($orders);
		$buffer['content']=$this->render('show_sale',array('orders'=>$orders,'client'=>$client,'sum_client'=>$sum_client),true);
		return $buffer;
		
	}
	
	
	protected function changeStatus($order_id,$status_id)
	{
		$order=OrdersStatus::model()->findByPk($order_id);
		if($status_id==11)
			$order->hover=3;
		$order->status_id=$status_id;
		$order->data_modified=date("Y-m-d H:i:s");
		$res=$order->save();
		if($res)
			return $order->data_modified;
			
		return false;

	}
	
	protected function startOrder($order_id,$dist_ord_id)
	{
			
		$order=OrdersStatus::model()->findByPk($order_id);
		$distributor_id=$order->distributor_id;
		
		$distributor=Distributors::model()->findByPk($distributor_id);
		$statuses=Statuses::model()->findAll();
		$status_groups=Statuses::model()->status_groups;
		
		$order->hover=2;
		$order->status_id=3;
		$order->order_id_by_distributor=$dist_ord_id;
		$date=date("Y-m-d H:i:s");
		$order->data_working=$date;
		
		$order->data_modified=$date;
		$res=$order->save();
		$status=Statuses::model()->findByPk($order->status_id);
		
		if($order->order_id_by_distributor)
			$buffer['order']='A-'.$order->id.'/<b>'.$order->order_id_by_distributor.'</b>';
		else
			$buffer['order']='A-'.$order->id;
		$buffer['color']='#'.$status->color;
		$buffer['modified']=CTime::change_show_data($order->data_modified);
		$buffer['answer']=2;
		
		$buffer['status']=CHtml::dropDownList('statuses',$status->id,Utility::createListStatuses($statuses,$status_groups,$status->id),array('id'=>'status_'.$order->id,'class'=>'list_statuses','onchange'=>"change_status('$order->id','".$this->module->id."','".SITE_PATH."','".$distributor->name."');",'style'=>'background: #'.$status->color));
		
		return $buffer;
	

	}
	
	protected function toWork($order_id)
	{
	
		$order=OrdersStatus::model()->findByPk($order_id);
		
		$data=array(
		'order'=>$order,
		'distributor_name'=>$_POST['distributor']
		);
		
		$content=$this->render('to_work',$data,true);
		return $content;
	}
	
	protected function beforeAction($action)
	{
		parent::beforeAction($action);
		
		return true;
	}
	
}

?>