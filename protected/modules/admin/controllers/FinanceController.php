<?php

Yii::import('application.modules.autoparts.models.TypePayments');


class FinanceController extends Controller
{

	public $payment;
	public $sections=array(
	'reports'=>'Финансовые отчеты'
	);
	
	public function actionIndex()
	{
		$this->pageTitle='Финансы '.$this->prefix_title;

		parent::actionIndex();

		
	}
	
	public function accessRules($role=null)
	{
	
		$denied['admin']=array('statistic');
		if($role==null) 
			return $denied;
		if(isset($denied[$role]))
			return $denied[$role];
		return array();
	
		
	}
	
	public function actionStatistic()
	{
		$this->pageTitle='Финансовая статистика '.$this->prefix_title;
		if(isset($_REQUEST['type_statistic']))
			$type=$_REQUEST['type_statistic'];
		else
			$type='profit';
			
		if(isset($_REQUEST['year']))
			$year=$_REQUEST['year'];
		else
			$year=date('Y');
		$amounts=Finance::getAmountMonth($year,$type);
		if(isset($_POST['type']) && $_POST['type']=='ajax'):
		
		ob_start();
		$this->render('statistic',array('amounts'=>$amounts,'type'=>$type,'year'=>$year));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
	
		$this->render('statistic',array('amounts'=>$amounts,'type'=>$type,'year'=>$year));

		
	endif;
			

	}
	
	public function actionPriceGroups()
	{
		$this->pageTitle='Ценовые группы '.$this->prefix_title;
		Yii::import('application.modules.autoparts.models.PriceGroups');
		
		if(isset($_REQUEST['do']) and $_REQUEST['do']=='edit'){	
			echo($this->Edit());
		}
		elseif(isset($_REQUEST['do']) and $_REQUEST['do']=='add'){	
			echo($this->Add());
				
		}
		else{
			
		$this->items=PriceGroups::model()->getAll();
		if(isset($_POST['type'])):
		
		ob_start();
		$this->render('pricegroups',array('items'=>$this->items));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
	
		$this->render('pricegroups',array('items'=>$this->items));

	endif;
	}
	
	
	}
	
	protected function Add()
	{
		$this->pageTitle='Добавление ценовой  группы для '.$this->prefix_title;
		
		if(isset($_REQUEST['flag_insert'])){
			$response['title']=$this->pageTitle;

		if(PriceGroups::model()->validatePriceGroup()==0){
				$response['answer']=1;
			}
			elseif(PriceGroups::model()->validatePriceGroup()==1){
				$response['error']='Оборот редактируемой группы превышает оборот следующей за ней!';
				$response['answer']=0;
				return CJSON::encode($response);
			}
			elseif(PriceGroups::model()->validatePriceGroup()==2){
				$response['error']='Оборот редактируемой группы меньше оборота предшествующей группы!';
				$response['answer']=0;
				return CJSON::encode($response);
			}
			
			$res=PriceGroups::model()->insertPriceGroup();
			if(!$res){
				$response['answer']=0;
				$response['error']='Неизвестная ошибка!';
				return CJSON::encode($response);
			}
			
				
		$this->items=PriceGroups::model()->getAll();
		
		if(isset($_POST['type'])):
		
		ob_start();
		$this->render('pricegroups',array('items'=>$this->items));
		$response['content']=ob_get_contents();
		ob_clean();
		return CJSON::encode($response);		
		
	else:
	
		return $this->render('pricegroups',array('items'=>$this->items));

	endif;
	
		
		}
		if(isset($_POST['type'])):
		
		 ob_start();
		$this->renderPartial('add_price_group');
		$response['content']=ob_get_contents();
		ob_clean();
		$response['before_insert']=1;
		return CJSON::encode($response);
		return $response;
		
	else:
		return $this->render('add_price_group',array(),true);

	endif;
	}
	
	protected function Edit()
	{
		$price_group_id=$_REQUEST['price_group_id'];
		
		if(isset($_REQUEST['flag_change'])){
			if(PriceGroups::model()->validatePriceGroup($price_group_id)==0){
				PriceGroups::model()->updatePriceGroup($price_group_id);
				$response['answer']=1;
			}
			elseif(PriceGroups::model()->validatePriceGroup($price_group_id)==1){
				$response['error']='Оборот редактируемой группы превышает оборот следующей за ней!';
				$response['answer']=0;
			}
			elseif(PriceGroups::model()->validatePriceGroup($price_group_id)==2){
				$response['error']='Оборот редактируемой группы меньше оборота предшествующей группы!';
				$response['answer']=0;
			}
			
		}
			
		$this->pageTitle='Редактирование ценовых групп для '.$this->prefix_title;
		$group=PriceGroups::model()->findByPk($price_group_id);
		if($_POST['type']=='ajax'):
		
		 ob_start();
		$this->renderPartial('edit_price_group',array('group'=>$group));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		$response['row']='<td>'.$group->name.'</td>';
		$response['row'].='<td>'.$group->amount.'</td>';
		$response['row'].='<td>'.$group->percent.'</td>';
		if($group->limit_for_order==1)
			$response['row'].='<td>Есть</td>';
		else
			$response['row'].='<td>Нет</td>';
		if($group->limit_for_store==1)
			$response['row'].='<td>Есть</td>';
		else
			$response['row'].='<td>Нет</td>';

		return CJSON::encode($response);
		
	else:
		return $this->render('edit_price_group',array('group'=>$group),true);

	endif;
		
	}

	
	public function actionReports()
	{
	
		if(isset($this->payment)){
			$response['address']=SITE_PATH.$this->module->id.'/'.$this->id.'/document?payment_id='.$this->payment->id;
			$response['payment_id']=$this->payment->id;
		}
			
		$this->pageTitle='Финансовые отчеты '.$this->prefix_title;

		$drop_lists['type_payments']=TypePayments::model()->getAllForFilter();
		if(isset($_POST['type'])):
		
		ob_start();
		$this->render('reports',array('items'=>$this->items,'drop_lists'=>$drop_lists,'pages'=>$this->pages));
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
	
		$this->render('reports',array('items'=>$this->items,'drop_lists'=>$drop_lists,'pages'=>$this->pages));

		
	endif;
	}
	
	public function actionPayments()
	{
	
		$this->pageTitle='Добавить платеж или списание -  '.$this->prefix_title;

		$type_payments=TypePayments::model()->getAllForFilter();
		unset($type_payments['0']);
		
		if(isset($_POST['type'])):
		
		 ob_start();
		$this->render('payments',array('clients'=>$this->clients,'type_payments'=>$type_payments));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
	
		$this->render('payments',array('clients'=>$this->clients,'type_payments'=>$type_payments));

		
	endif;
		 
		
	}
	
	
	public function actionBalance()
	{
			$this->pageTitle='Баланс '.$this->prefix_title;

		 	
		if(isset($_POST['client_id']))
			$balance=round(Finance::getBalance($_POST['client_id']),2);
		else
			$balance=round(Finance::getBalance(null,1),2);
			
		if(isset($_POST['client_id']))	
			$orders_in_work=round(Finance::getOrdersWork($_POST['client_id']),2);
		else
			$orders_in_work=round(Finance::getOrdersWork(null,1),2);

		if(isset($_POST['client_id']))	
			$orders_in_store=round(Finance::getOrdersStore($_POST['client_id']),2);
		else
			$orders_in_store=round(Finance::getOrdersStore(null,1),2);
			
			if(isset($_POST['client_id']))	
			$orders_archive=round(Finance::getAllOutput($_POST['client_id']),2);
		else
			$orders_archive=round(Finance::getAllOutput(null,1),2);
		
		if(isset($_POST['type'])):
		
		 ob_start();
		$this->render('balance',array('clients'=>$this->clients,'balance'=>$balance,'orders_in_work'=>$orders_in_work,'orders_in_store'=>$orders_in_store,'orders_archive'=>$orders_archive));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
	
		$this->render('balance',array('clients'=>$this->clients,'balance'=>$balance,'orders_in_work'=>$orders_in_work,'orders_in_store'=>$orders_in_store,'orders_archive'=>$orders_archive));

		
	endif;
	}
	
	public function actionDocument()
	{
		parent::actionDocument();
	}
	
	protected function beforeAction($action)
	{
	
		$action=$this->getAction()->getId();
		if($action=='document')
			return true;
	
		parent::beforeAction($action);
		
		
		if($action=='reports')
			$this->model_name='Payments';
		Yii::import('application.modules.autoparts.models.'.$this->model_name);

		if(isset($_POST['add_payment']) and $action=='reports'){
			$this->payment=Finance::addPayment();	
				
		}
		
		if($action!='index')
			$this->section_header=AdminItems::model()->getItemName($action,$this->id);
			
		
		$this->clients=Utility::getClientsList();
		if($action=='reports')
			$this->prepareFilter('admin');
		
		
		return true;
		
	}
	
}

?>