<?php

class FinanceController extends Controller
{
	public $sections=array(
	'payments'=>'Финансовые отчеты'
	);
	
	public function actionIndex()
	{
		parent::actionIndex();

	}
	
	public function actionPayments()
	{
		
		$this->pageTitle='Платежи и списания '.$this->prefix_title;
		$drop_lists['type_payments']=TypePayments::model()->getAllForFilter();
		
		if(isset($_POST['type'])):
		
		ob_start();
		$this->render('payments',array('items'=>$this->items,'pages'=>$this->pages,'drop_lists'=>$drop_lists));
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
		$this->render('payments',array('items'=>$this->items,'pages'=>$this->pages,'drop_lists'=>$drop_lists));
	endif;

	}
	
	public function actionTypePayments()
	{
		$this->pageTitle='Способы оплаты';
		if(isset($_POST['type'])):
		ob_start();
		$this->render('type_payments');
		$response['content']=ob_get_contents();
		if($this->pageTitle)
			$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
		$this->render('type_payments');
		
	endif;
	}
	
	public function actionCategories()
	{
	
		Yii::import('application.modules.autoparts.models.PriceGroups');
		$this->pageTitle='Ценовые категории '.$this->prefix_title;
		$this->items=PriceGroups::model()->getAll();
		
		if(isset($_POST['type'])):
		$this->layout='ajax';
		ob_start();
		$this->render('categories',array('items'=>$this->items));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
		$this->render('categories',array('items'=>$this->items));
	endif;
		
	}
	
	public function actionStatistic()
	{
		if(isset($_REQUEST['choise_year'])):
			Yii::import('application.modules.autoparts.components.Finance');
			$amounts=Finance::getAmountMonth($_REQUEST['choise_year'],'circulation',UserIdentity::getProperty('id'));
		
		foreach($amounts as $key=>$value){			
			$price_group_info[$key]=PriceGroups::model()->getPriceGroupByAmount($value);
		}
		
		$time=new CTime;
		$months_names=$time->months_names;
		if(isset($_POST['type'])):
			ob_start();
			$this->render('table_price_groups',array('amounts'=>$amounts,'price_group_info'=>$price_group_info,'months_names'=>$months_names));
			$response['content']=ob_get_contents();
			ob_clean();
			echo CJSON::encode($response);
		
		else:
			$this->render('table_price_groups',array('amounts'=>$amounts,'price_group_info'=>$price_group_info,'months_names'=>$months_names));	
		endif;
		
		endif;
	}
	
	public function actionBalance()
	{
		$this->pageTitle='Финансовая информация '.$this->prefix_title;
		if(UserIdentity::getProperty('role_id')==1){
			
		if(isset($_POST['type'])):
			ob_start();
			$this->render('denied');
			$response['content']=ob_get_contents();
			ob_clean();
			echo CJSON::encode($response);
		
		else:
			$this->render('denied');
	
		endif;
		return true;
		}
		$items=$this->module->getClient();
		
		if(isset($_REQUEST['current_year']))
			$amounts=Finance::getAmountMonth($_REQUEST['current_year'],'circulation',UserIdentity::getProperty('id'));
		else
			$amounts=Finance::getAmountMonth(date('Y'),'circulation',UserIdentity::getProperty('id'));

		$price_group_info=array();
		foreach($amounts as $key=>$value){
			
			$price_group_info[$key]=PriceGroups::model()->getPriceGroupByAmount($value);
		}
		
		$time=new CTime;
		$months_names=$time->months_names;
		if(isset($_POST['type'])):
			ob_start();
			$this->render('balance',array('items'=>$items,'amounts'=>$amounts,'price_group_info'=>$price_group_info,'months_names'=>$months_names));
			$response['content']=ob_get_contents();
			$response['title']=$this->pageTitle;
			ob_clean();
			echo CJSON::encode($response);
		
		else:
			$this->render('balance',array('items'=>$items,'amounts'=>$amounts,'price_group_info'=>$price_group_info,'months_names'=>$months_names));		
		endif;
	}
	
	public function actionInfo()
	{
	
		$this->pageTitle='Финансовая информация '.$this->prefix_title;
		$items=$this->module->getClient();
		
		if(isset($_POST['type'])):
		ob_start();
		$this->render('info',array('items'=>$items));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
		$this->render('info',array('items'=>$items));
	endif;
	}
	
	protected function beforeAction($action)
	{
			
		if($this->getAction()->getId()=='index'){
			$this->forward($this->id.'/balance');
		}
		$action=$this->getAction()->getId();
		$this->model_name=ucfirst($action);
		if($action=='index' or $action=='statistic' or $action=='categories'){
			
		}
		else{
			$this->section_header=ClientItems::model()->getItemName($action,$this->id);

		}
		if($action!='statistic'){
			parent::beforeAction($action);
			
		}
		else{
			$this->layout='ajax';
			if(!UserIdentity::getProperty('id'))
				return false;
		}
		
		if($this->model_name=='Payments'):
			Yii::import('application.modules.autoparts.models.'.$this->model_name);
			Yii::import('application.modules.autoparts.models.TypePayments');

			$this->prepareFilter();
		
		endif;
		
		
		return true;

	}
}

?>