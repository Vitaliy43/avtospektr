<?php

Yii::import('application.modules.autoparts.models.Statuses');


class OrdersController extends Controller
{
	
	public $sections=array(
	'archive'=>'Архив заказов'
	);
	
	
	public $data_shipping;
	
	public function actionIndex()
	{
		parent::actionIndex();
	}
	
	public function actionStatus()
	{
	
	$this->pageTitle='Статус заказов '.$this->prefix_title;
		
		if(isset($_POST['type'])):
		
		ob_start();
		$this->render('status',array('orders'=>$this->items,'pages'=>$this->pages));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
		$this->render('status',array('orders'=>$this->items,'pages'=>$this->pages));
		
	endif;
		
		
	}
	
	
	public function actionArchive()
	{
		 	
		$this->pageTitle='Архив заказов '.$this->prefix_title;
		
		if(isset($_POST['type'])):
		
		ob_start();
		if(isset($_POST['for_sales'])):
			$this->render('list_orders',array('orders'=>$this->items,'data_shipping'=>$this->data_shipping));
			$response['num_items']=count($this->items);

		else:
			$this->render('archive',array('orders'=>$this->items,'pages'=>$this->pages));
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
		$this->render('archive',array('orders'=>$this->items,'pages'=>$this->pages));
		
	endif;
	
		
	}
		public function actionSales()
		{
		
			$this->pageTitle='Архив покупок '.$this->prefix_title;

		if(isset($_POST['type'])):
		
		ob_start();
		$this->render('sales',array('sales'=>$this->items,'pages'=>$this->pages));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
	elseif(isset($is_pdf)):
		
	else:
		$this->render('sales',array('sales'=>$this->items,'pages'=>$this->pages));
		
	endif;
		}
	
		protected function beforeAction($action)
	{
	
		$action=$this->getAction()->getId();
		if($action!='index')
			$this->section_header=ClientItems::model()->getItemName($action,$this->id);
		
			
		if($action=='index'){
			$this->forward($this->id.'/status');
		}
			
		parent::beforeAction($action);
		
		$this->model_name=ucfirst($this->id).ucfirst($action);

		Yii::import('application.modules.autoparts.models.'.$this->model_name);

		if($action=='sales')
			Yii::import('application.modules.autoparts.models.OrdersArchive');

		
		if($action=='index'){
			
		}
		elseif(isset($_POST['for_sales'])){
			Yii::import('application.modules.autoparts.models.OrdersSales');
			$buffer_sale=OrdersSales::model()->getSaleById($_POST['sale_id']);
			$this->data_shipping=$buffer_sale->data_shipping;
			$this->items=OrdersArchive::model()->getOrdersByDataShipping($this->data_shipping,UserIdentity::getProperty('id'));

		}
		else{
			$this->prepareFilter();

		}
		
	
		return true;
	}
	
	
	
	
}

?>