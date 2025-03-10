<?php

Yii::import('application.modules.autoparts.models.Statuses');
Yii::import('application.modules.autoparts.models.Crosses');


class OrdersController extends Controller
{
	public $sections=array(
	'archive'=>'Архив заказов'
	);
	
	public $data_shipping;
	
	public function actionIndex()
	{
		$this->pageTitle='История заказов '.$this->prefix_title;
		parent::actionIndex();
		
	}
	
	public function actionShip()
	{
		Yii::import('application.modules.autoparts.models.OrdersSales');
		$this->pageTitle='Продажа товара '.$this->prefix_title;
		$firm=FirmSettings::model()->find();
		
		if(isset($_REQUEST['client_id'])):
		$criteria=new CDbCriteria;
		$criteria->condition='hover=3 AND user_id=:client_id';
		$criteria->params=array(':client_id'=>$_REQUEST['client_id']);
		$orders_status=OrdersStatus::model()->findAll($criteria);
		$orders_status=Finance::applyDiscount($orders_status,$_REQUEST['client_id']);
		$data_shipping=date("Y-m-d H:i:s");

		foreach($orders_status as $order){
			$order->data_modified=$data_shipping;
			$order->save();
		}

		$user=Users::model()->findByPk($_REQUEST['client_id']);

		OrdersArchive::model()->saveOrders($orders_status,$data_shipping);
		$sum=Finance::getOrdersShip($_REQUEST['client_id'],$data_shipping);
		$payment=Finance::addPaymentAfterShip($sum,$data_shipping);
		Finance::Shipping($_REQUEST['client_id'],$data_shipping,$sum);
		$balance=Finance::getBalance($_REQUEST['client_id']);
		
		$command=Yii::app()->db->createCommand();
		$data_sale=array(
		'id'=>null,
		'data_shipping'=>$data_shipping,
		'sum'=>$sum,
		'user_id'=>$_REQUEST['client_id'],
		'balance'=>$balance
		);
		$res=$command->insert('orders_sales',$data_sale);
		$orders_archive=OrdersArchive::model()->findAll('data_shipping=:data',array(':data'=>$data_shipping));
		 if($res)
			$command->delete('orders_status','data_modified=:data AND user_id=:user_id',array(':data'=>$data_shipping,':user_id'=>$_REQUEST['client_id']));
		
		$parameters=array(
		'blank_id'=>Finance::getSaleBlankId($data_shipping),
		'data_shipping'=>$data_shipping,
		'buyer'=>$user->fio,
		'telephone'=>$user->telephone,
		'sum'=>$sum
		);
		
		$this->renderPartial('ship',array('orders'=>$orders_archive,'parameters'=>$parameters,'balance'=>$balance,'firm'=>$firm));
		
		endif;
	}
	
	public function actionStatistic()
	{
	
		$this->pageTitle='Статистика заказов '.$this->prefix_title;

		
	if(isset($_REQUEST['option']))
		$option=$_REQUEST['option'];
	else
		$option='number';
		
		$count_table=OrdersArchive::model()->count();
		$items=Utility::getOrderStatistic($option);
		if(isset($_POST['type'])):
			 ob_start();
			$this->render('statistic',array('items'=>$items,'count_table'=>$count_table,'option'=>$option));

			$response['content']=ob_get_contents();
			$response['title']=$this->pageTitle;
			ob_clean();
			echo CJSON::encode($response);

		else:
			$this->render('statistic',array('items'=>$items,'count_table'=>$count_table,'option'=>$option));
		endif;
	
	}
	
	public function actionStore()
	{
	
		$this->pageTitle='Товары для выдачи '.$this->prefix_title;
		if(isset($_REQUEST['client_id']))
			OrdersStatus::model()->removeSale($_REQUEST['client_id']);

	$clients=Yii::app()->db->createCommand(array(
    	'select'=>'*',
    	'from'=>'users',
		'where'=>'id IN (SELECT user_id FROM orders_status WHERE hover=3)',
		'order'=>'fio'
	))->queryAll();
	
	if(count($clients)>0)
		$sum_clients=Finance::createListForSale($clients);
	
		if($_POST['type']=='ajax'):
		
		 ob_start();
		$this->render('store',array('clients'=>$clients,'sum_clients'=>$sum_clients));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
	
		$this->render('store',array('clients'=>$clients,'sum_clients'=>$sum_clients));

		
	endif;
	}
	
	public function actionSales()
		{
		
			$this->pageTitle='История продаж '.$this->prefix_title;

		
		if(isset($_POST['type'])):
		
		ob_start();
		$this->render('sales',array('sales'=>$this->items,'pages'=>$this->pages));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
	
	else:
		$this->render('sales',array('sales'=>$this->items,'pages'=>$this->pages));
		
	endif;
		}
	
	public function actionStatus()
	{
	
		$this->pageTitle='Статус заказов '.$this->prefix_title;

		$statuses=Statuses::model()->findAll();
		
		if(isset($_POST['type'])):
		
		ob_start();
		$this->render('status',array('orders'=>$this->items,'pages'=>$this->pages,'statuses'=>$statuses,'status_groups'=>Statuses::model()->status_groups));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
		$this->render('status',array('orders'=>$this->items,'pages'=>$this->pages,'statuses'=>$statuses,'status_groups'=>Statuses::model()->status_groups));
		
	endif;
	}
	
	public function actionArchive()
	{
		
		$this->pageTitle='Архив заказов '.$this->prefix_title;

		
		if(isset($_POST['type'])):
		
		ob_start();
		if(isset($_POST['for_sales'])):
			$this->render('list_orders',array('orders'=>$this->items,'data_shipping'=>$this->data_shipping,));
			$response['num_items']=count($this->items);

		else:
			$this->render('archive',array('orders'=>$this->items,'pages'=>$this->pages,'clients'=>$this->clients));
		endif;
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
	elseif(isset($_REQUEST['export']) and $_REQUEST['export']=='pdf'):
		$this->output_pdf($this->items);
	elseif(isset($_REQUEST['export']) and $_REQUEST['export']=='xls'):
		$this->module->generateXLS($this->items,$this->id,$this->getAction()->getId());
	elseif(isset($_REQUEST['export']) and $_REQUEST['export']=='doc'):
		$this->module->generateDOC($this->items,$this->id,$this->getAction()->getId());
	else:
		$this->render('archive',array('orders'=>$this->items,'pages'=>$this->pages,'clients'=>$this->clients));
		
	endif;
	}
	
	protected function beforeAction($action)
	{
		parent::beforeAction($action);
		$action=$this->getAction()->getId();
		$this->clients=Utility::getClientsList();
		if($action=='index' or $action=='ship'){
			
		}
		else{
			$this->section_header=AdminItems::model()->getItemName($action,$this->id);

		}
		
		if($action=='store' or $action=='ship'){
			$this->model_name='OrdersStatus';

		}
		elseif($action=='statistic'){
			$this->model_name='OrdersArchive';
		}
		
		else{
			$this->model_name=ucfirst($this->id).ucfirst($this->getAction()->getId());

		}
		
		
		Yii::import('application.modules.autoparts.models.'.$this->model_name);

		if($action=='sales' or $action=='ship')
			Yii::import('application.modules.autoparts.models.OrdersArchive');

		
		if($action=='index' or $action=='store' or $action=='statistic' or $action=='ship'){
			
		}
		elseif(isset($_POST['for_sales'])){
			Yii::import('application.modules.autoparts.models.OrdersSales');
			$buffer_sale=OrdersSales::model()->getSaleById($_POST['sale_id']);
			$this->data_shipping=$buffer_sale->data_shipping;
			if($this->current_role=='admin'){
				$this->items=OrdersArchive::model()->getOrdersByDataShipping($this->data_shipping);
			}
			else{
				$this->items=OrdersArchive::model()->getOrdersByDataShipping($this->data_shipping,UserIdentity::getProperty('id'));
			}
			
				

		}
		else{
			$this->prepareFilter('admin');

		}
		
	
		
		return true;
	}
}

?>