<?php

Yii::import('application.modules.autoparts.models.VinRequest');
Yii::import('application.modules.client.models.ClientItems');

class VinController extends Controller
{
	protected $action;

	public $tables=array('type_engine','gear','car_bodies','transmission');
	
	public function actionIndex()
	{
		$this->pageTitle='Запросы по Vin коду '.$this->prefix_title;
		if(UserIdentity::getProperty('role')=='admin' or UserIdentity::getProperty('role')=='root' or UserIdentity::getProperty('role')=='manager'){
			$this->actionList();
		}
		else{
			parent::actionIndex();

		}
		
	}
	
	public function actionList($ajax=null)
	{
		$this->pageTitle='Список запросов по Vin коду '.$this->prefix_title;
		$this->prepareFilter();
		$brands=Vin::get_brands();
		if($ajax)
			$this->action='list';
			if(isset($_POST['type']) && $_POST['type']=='ajax' or $ajax):
				if(isset($_POST['type'])){
					ob_start();
					$this->render('list',array('items'=>$this->items,'brands'=>$brands));
					$response['content']=ob_get_contents();
					ob_clean();
					echo CJSON::encode($response);
				}
				else{
					$this->render('list',array('items'=>$this->items,'brands'=>$brands));
	
				}
				
			else:
				$this->render('list',array('items'=>$this->items,'brands'=>$brands));

			endif;
	}
	
	protected function validateVinRequest()
	{
		
		$errors=array();
		
		if(!$_REQUEST['numberVin'])
			$errors['numberVin']='Не заполнено поле "Номер VIN или номер кузова!';
						
		if(!$_REQUEST['year'])
			$errors['year']='Не указан год!';
		if(!$_REQUEST['brands'])
			$errors['brands']='Не указана марка автомобиля!';
		if(!$_REQUEST['model'])
			$errors['model']='Не указана модель автомобиля!';
		if(!$_REQUEST['necessary_parts'])
			$errors['necessary_parts']='Не указаны небходимые запчасти!';
							
			return $errors;			
				
	}
	
	public function actionRequest()
	{
		$this->pageTitle='Новый запрос по Vin коду '.$this->prefix_title;
		if(isset($_REQUEST['submit']))
			$errors = $this->validateVinRequest();
		else
			$errors = array();
		
		if(isset($_REQUEST['submit']) and count($errors)==0):
		
			$res=VinRequest::model()->insertVin();
		if($res){
			$this->actionList(1);
		}
		else{
			
			if($_POST['type']=='ajax'):
			ob_start();
			$this->render('error');
			$response['content']=ob_get_contents();
			ob_clean();
			echo CJSON::encode($response);

		else:
			$this->render('error');
		endif;
			
		}
			
		else:
		$data['years']=Vin::years_output();
		$data['brands']=Vin::get_brands();
		foreach($this->tables as $table){
			$data[$table]=Vin::get_vin($table);
		}
		
		if($_POST['type']=='ajax'):
			ob_start();
			$this->render('request',$data);
			$response['content']=ob_get_contents();
			ob_clean();
			echo CJSON::encode($response);

		else:
			$this->render('request',$data);
		endif;
			
		endif;
	}
	
	protected function prepareFilter($type='client')
	{
		$user_id=UserIdentity::getProperty('id');
		$action=$this->getAction()->getId();
		$current_role=UserIdentity::getProperty('role');
		
		$criteria=new CDbCriteria;
		$criteria->select='*';
		if($current_role=='client'){
			$criteria->condition='user_id=:user_id';
			$criteria->params=array(':user_id'=>UserIdentity::getProperty('id'));
		}
		elseif(isset($_REQUEST['client_id']) and $_REQUEST['client_id']){
			$criteria->condition='user_id=:user_id';
			$criteria->params=array(':user_id'=>$_REQUEST['client_id']);
		}
		
		if($current_role=='admin' or $current_role=='root' or $current_role=='manager')
			$criteria->with=array('user');
		
		$criteria->order='data_requested DESC';
		if(isset($_REQUEST['flag_filter']) and $_REQUEST['flag_filter']==1):
		
		$condition=SearchFilter::create_condition(VinRequest::model()->filter_params,VinRequest::model()->empty_values);
		$params=SearchFilter::create_params(VinRequest::model()->filter_params,VinRequest::model()->empty_values);
		
		if(strlen($condition)>0):
		
			if($criteria->condition){
				$criteria->condition=$condition.' AND '.$criteria->condition;
				$criteria->params=array_merge($criteria->params,$params);
			}
			else{
				$criteria->condition=$condition;
				$criteria->params=$params;
			}
			

		endif;
		
		if(isset($_REQUEST['necessary_parts']) and $_REQUEST['necessary_parts']){
			$criteria->addSearchCondition('necessary_parts',$_REQUEST['necessary_parts'].' ');

		}
		
		
		endif;

		
		$pages=new CPagination(VinRequest::model()->count($criteria));
		
		$this->setPageSize($pages,$user_id);
		
		$pages->applyLimit($criteria);
		$this->pages=$pages;
		$this->items=VinRequest::model()->findAll($criteria);;
	
	}
	
	
	protected function setPageSize($pages,$user_id)
	{
		$config_page_size=Config::model()->item('page_size',$user_id,VinRequest::model()->tableName());
		if(empty($config_page_size))
			$config_page_size=Config::model()->item('page_size',1,VinRequest::model()->tableName());
			
		if(isset($_SESSION['page_size'])){
			$pages->setPageSize($_SESSION['page_size']);
			$this->page_size=$_SESSION['page_size'];
			$this->current_route=$this->getRoute().'/'.$this->page_size;
		}
		else{
			$pages->setPageSize($config_page_size);
			$this->page_size=$config_page_size;
			$this->current_route=$this->getRoute();
		}	
			
	}
	
	protected function beforeRender($view)
	{
		parent::beforeRender($view);
		if($this->action!='index'){
			$item=ClientItems::model()->find('name=:name',array(':name'=>$this->action));
			$this->breadcrumbs[$item->show_name]=SITE_PATH.$this->module->id.'/vin/'.$this->action;
		}
		return true;
	}
	
	protected function beforeAction($action)
	{	
		$role=UserIdentity::getProperty('role');
		parent::beforeAction($action);
		$this->breadcrumbs['Запрос по Vin коду']=SITE_PATH.$this->module->id.'/vin';
		$this->action=$this->getAction()->getId();
		if($role=='admin' or $role=='root' or $role=='manager')
			$this->clients=Utility::getClientsList();

		if(isset($_POST['type'])):
		$this->layout='ajax';
		else:
		$this->layout='//layouts/autoparts';
		endif;

		return true;
	}
}

?>