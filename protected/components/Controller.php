<?php

session_start();
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	/**
	 * @var string javascript_items - содержит массивы пунктов различных древовидных меню в javascript
	 */
	public $javascript_items;
	public $javascript_client_items;
	public $javascript_admin_items;
	public $javascript_distributors;
	/**
	 * @var array catalog_items,client_items - содержит массивы пунктов различных древовидных меню в javascript
	 */
	public $catalog_items=array();
	public $client_items=array();
	public $admin_items=array();
	/**
	 * @var object current_item - содержит текущий пункт в меню
	 */
	public $current_item;
	/**
	 * @var string css_file_pager - содержит путь к файлу css для пагинатора
	 */
	public $css_file_pager;
	/**
	 * @var int page_size - текущее кол-во выводимых элементов на странице (для пагинации)
	 */
	public $current_sort;
	/**
	 * @var string current_sort - текущая сортировка (применяется в разных фильтрах поиска)
	 */
	public $page_size;
	/**
	 * @var string current_route - текущий маршрут
	 */
	public $current_route;
	/**
	 * @var string redirect_access_denied - текущий маршрут
	 */
	public $redirect_access_denied=SITE_PATH;
	public $model_name;
	public $menu_points='Items';
	public $items=array();
	public $pages;
	public $type_profile;
	public $user_roles=array('user','client');
	public $admin_roles=array('root','admin','manager');
	public $current_role;
	public $current_price_group;
	public $prefix_title='магазина "Автоспектр"';
	public $prefix_title_non_declension='Магазин "Автоспектр"';
	public $clients;
	public $section_header;
	public $message_error;
	public $purchase_point; 
	public $upper_list=array();
	public $basket_num;
	public $updated=0;
	public $added=0;
	public $operation_points=array('addpoint','editpoint','import');
	public $clients_points=array('setpricing','removemarkup','order','delete','preorder');
	public $validate_errors=array();
	
	
	protected function output_pdf($items)
	{
		$data=array(
		'items'=>$items,
		'section'=>$this->sections[$this->getAction()->getId()],
		);
		$this->module->generatePDF($data,$this->id,$this->getAction()->getId());

	}
	
	protected function get_upper_list()
	{
		$menu=UserMenu::model()->findAll();
		$arr=CArray::arrayFromObjects($menu,'name','show_name');
		$arr=CArray::delete_index($arr,array('search'),true);
		$this->upper_list=$arr;
	}
	

		protected function checkAccess()
		{	
		
			if(count($this->accessRules()>0)){
				$bans=$this->accessRules(UserIdentity::getProperty('role'));
				
				if(in_array($this->getAction()->getId(),$bans))
					return false;				
				}
						
			return true;
		}
		
		protected function simple_check_access()
		{
			$access=UserIdentity::getProperty('id');
			if($access!=null)
				return true;
			return false;
		}

		protected function beforeAction($action)
		
		{
			
			UserIdentity::setPurchasePoint();
			mb_internal_encoding("UTF-8");
	
			$this->purchase_point=PurchasePoints::model()->findByPk(UserIdentity::getPurchasePoint());
			
			if(UserIdentity::getProperty('role')=='client' or UserIdentity::getProperty('role')=='manager'){
				$this->basket_num=Basket::model()->count_items();
				$buffer_price_group=Finance::getAmountLastMonth('circulation',UserIdentity::getProperty('id'));
				$this->current_price_group=PriceGroups::model()->getPriceGroupByAmount($buffer_price_group);
			}
			if(!UserIdentity::getProperty('role')){
				$this->basket_num=Basket::model()->count_items_guests();
			}

			$action=$this->getAction()->getId();
			$this->get_upper_list();
			$this->css_file_pager=Yii::app()->request->baseUrl.'/css/'.Yii::app()->theme->name.'/pager.css';

			if(isset($this->module) and $this->module->id=='autoparts')
				return true;
			$buffer_distributors=Distributors::model()->findAll();
			$this->javascript_distributors=$this->get_javascript_distributors(CArray::arrayFromObjects($buffer_distributors,null,'id'));
			$buffer=UserIdentity::getProperty('role');
			if($buffer){
				
			}
			else{
				if(isset($this->module) and $this->module->id=='client' and $this->id=='cart')
					return true;
				if(isset($this->module) and $this->module->id=='client' and $this->id=='finance' && $action == 'categories')
					return true;
			}

			
			if(isset($this->module) and $this->module->id!='catalog'){
				$check=$this->module->checkAccess($this->getAction()->getId());
				if($check)
					$check=$this->checkAccess();
					
					if(!$check){
						$this->redirect($this->redirect_access_denied);
						
				}
					
					
					if($this->module->id=='admin' and $this->id=='catalog' and in_array($action,$this->operation_points))
						return true;
						
					if($this->module->id=='admin' and $this->id=='clients' and in_array($action,$this->clients_points))
						return true;
						
					if($this->module->id=='client' and $this->id=='cart' and in_array($action,$this->clients_points))
						return true;	
						
						if($this->module->id=='client' and $this->id=='finance' and $this->getAction()->getId()=='categories')
						return true;
						
			}

			
			
			 $this->current_role=$this->checkRole($buffer);
		
			$this->catalog_items=Items::model()->allChilds();
			
				$this->client_items=ClientItems::model()->allChilds();
				$this->admin_items=AdminItems::model()->allChilds();
			
				$this->javascript_items=$this->itemChilds('menu',$this->catalog_items);
			
				$this->javascript_client_items=$this->itemChilds('client',$this->client_items);
				$this->javascript_admin_items=$this->itemChilds('admin',$this->admin_items);
				
		
		
			if(isset($this->module) and $this->module->id=='client'){
				$this->current_item=ClientItems::model()->getItemByName($this->id);
			}
			elseif(isset($this->module) and $this->module->id=='admin'){
				$this->current_item=AdminItems::model()->getItemByName($this->id);

			}
				
				$section=SITE_PATH;
				
				if(isset($this->module) and $this->id!='menu'):
					$section.='/'.$this->module->id.'/'.$this->id;

					
				if(isset($this->module) and $this->module->id=='catalog'):
								
				else:
					 $this->breadcrumbs[CActiveRecord::model($this->menuModelName())->getItemName($this->id)]='/'.$this->module->id.'/'.$this->id;
				endif;
								
		
		 if($action=='index' or $action=='edit' or $action=='add' or $action=='ship'){
		 	
			
				if(isset($this->module) and $this->module->id=='catalog'):
					
					Items::model()->getItemsLinkTree($_REQUEST['item_id'],'/'.$this->module->id.'/'.$this->id.'/index?item_id=');
					$this->breadcrumbs=Items::model()->getBreadcrumbFromTree();
				
				endif;
		 }
		  
		 else{
		 	$this->breadcrumbs[CActiveRecord::model($this->menuModelName())->getItemName($action)]=$this->breadcrumbs[CActiveRecord::model($this->menuModelName())->getItemName($this->id)].'/'.$action;
		 }
			
				
				endif;
				
				if(isset($_POST['type']) and $_POST['type']=='ajax'):
					$this->layout='ajax';
				
				else:
			
				
				if($this->id=='orders' or $this->id=='finance'){
					
					$this->layout='//layouts/autoparts';
				}
				
				endif;
				
		
			return true;
	}
	
	
	protected function menuModelName()
	{
		return ucfirst($this->module->id).$this->menu_points;
	}
	
	
	protected function exceptionAccess($items,$parent_item)
	{
		if(isset($this->module) and UserIdentity::getProperty('role')!='root'){
				
					for($i=0;$i<count($items);$i++):
						if(!AccessExceptions::model()->getUrlException(UserIdentity::getProperty('role_id'),null,$this->module->id,$parent_item->name,$items[$i]->name))
							$new_items[$i]=$items[$i];
					endfor;
					if(isset($new_items))
						return $new_items;
					
			}
			
			return $items;
	}
	
	public function actionIndex()
	{
			
		if(isset($this->module)):
			
			if($this->module->id=='client' or $this->module->id=='admin'){
				 
				$item=CActiveRecord::model($this->menuModelName())->getItemByName($this->id);
				if($this->module->id=='admin')
					$items=CActiveRecord::model($this->menuModelName())->getItemsNextLevel($item->id,$item->level,'position');
				else
					$items=CActiveRecord::model($this->menuModelName())->getItemsNextLevel($item->id,$item->level);

				if($this->module->id=='admin'){
					$items=$this->exceptionAccess($items,$item);
				}
		 
	
		if(isset($_POST['type'])):
		
		ob_start();
		$this->render('index',array('items'=>$items));
		$response['content']=ob_get_contents();
		if($this->pageTitle)
			$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
		$this->render('index',array('items'=>$items));
		
	endif;
				
			}
			elseif($this->module->id=='autoparts' and $this->id=='vin'){
				$item=ClientItems::model()->getItemByName($this->id);
				$items=ClientItems::model()->getItemsByParent($item->id);

				if(isset($_POST['type'])):
		
				ob_start();
				$this->render('index',array('items'=>$items));
				$response['content']=ob_get_contents();
				ob_clean();
				echo CJSON::encode($response);
		
			else:
				$this->render('index',array('items'=>$items));
		
			endif;
				
				
			}
			
			
		endif;
		
	}
	
	public function actionDocument()
	{
		
		 switch($this->id){
		 	
			case 'finance':
			Yii::import('application.modules.autoparts.models.Payments');
			if(isset($_REQUEST['payment_id'])){
				$payment=Payments::model()->findByPk($_REQUEST['payment_id']);
				echo Documentator::createPayment($payment);
			}
				
			break;
			
			
		 }
		
	}
	
	protected function setPageSize($pages,$user_id)
	{
		$config_page_size=Config::model()->item('page_size',$user_id,CActiveRecord::model($this->model_name)->tableName());
		if(empty($config_page_size))
			$config_page_size=Config::model()->item('page_size',1,CActiveRecord::model($this->model_name)->tableName());
			
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
	
	protected function prepareFilter($type='client')
	{
		$user_id=UserIdentity::getProperty('id');
		$action=$this->getAction()->getId();
		
		$criteria=new CDbCriteria;
		$criteria->select='*';
		
		if(isset($_REQUEST['add_payment']) and $action=='reports'):
		
	
		else:
		
		if($type=='client'){
			$criteria->condition='user_id=:user_id';
			$criteria->params=array(':user_id'=>$user_id);
		}
		else{
		
			if($action=='status'){
				$criteria->condition='hover!=:hover';
				$criteria->params[':hover']=3;

			}
			elseif($action=='store'){
				$criteria->condition='hover=:hover';
				$criteria->params[':hover']=3;
			}
			
		
			if(isset($_REQUEST['client_id']) and $_REQUEST['client_id']>0){
			 	
			if($action=='status')
				$add=' AND ';
			else
				$add='';
			
			$criteria->condition.=$add.'user_id=:user_id';
			$criteria->params[':user_id']=$_REQUEST['client_id'];
		
			}
			elseif(isset($_REQUEST['client']) and $_REQUEST['client']!=''){
				
				$user_id=Users::model()->getIdByFio($_REQUEST['client']);

				if($action=='status')
				$add=' AND ';
			else
				$add='';
			
			$criteria->condition.=$add.'user_id=:user_id';
			$criteria->params[':user_id']=$user_id;
			}
		
		}
		
				
	
		if(isset($_REQUEST['flag_filter'])){
				
		$condition=SearchFilter::create_condition(CActiveRecord::model($this->model_name)->filter_params,CActiveRecord::model($this->model_name)->empty_values);
		$params=SearchFilter::create_params(CActiveRecord::model($this->model_name)->filter_params,CActiveRecord::model($this->model_name)->empty_values);
		
		
		
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
		
		
		if(isset($_REQUEST['description']) and $_REQUEST['description']!='' and $action!='sales'){
			$description=$_REQUEST['description'];
			$criteria->addSearchCondition('info',$description);
		}
		
		}
		
		
		if(isset($_REQUEST['distributor_id']) and $_REQUEST['distributor_id'] and $action!='sales'){
			$distributor_id=(int)$_REQUEST['distributor_id'];
			$criteria->addSearchCondition('distributor_id',$distributor_id);
		
		}
		
		
		if(isset($_REQUEST['status_id'])):
			$status_id=(int)$_REQUEST['status_id'];
			if($status_id!='all'){
				$criteria->addSearchCondition('status_id',$status_id);
		
			}
		
		endif;
		
		
		if(isset($_REQUEST['hover'])):
			 $hover=$_REQUEST['hover'];
			$criteria->addSearchCondition('hover',$hover);
		endif;
		
		
		
		if(isset($_REQUEST['type_payments']) and $_REQUEST['type_payments']!='all' and $this->id=='finance'){
			$type_payments=$_REQUEST['type_payments'];
			$type_payment_id=TypePayments::model()->getIdByType($type_payments);
			$criteria->addSearchCondition('type_payment_id',$type_payment_id);
		
		}
				
		if(isset($_REQUEST['type_operation']) and $_REQUEST['type_operation']!='all' and $this->id=='finance'){
			$type_operation=$_REQUEST['type_operation'];
			$criteria->addSearchCondition('type_operation',$type_operation);
		
		}
		
		
		if($this->id=='Finance'){
			$criteria->with=array('type_payment');

		}
		
		if($type=='admin' and UserIdentity::getProperty('role')=='manager'){
			$criteria->with=array('user');
			
		}
		elseif($type=='admin' and UserIdentity::getProperty('role')!='manager'){
			if($action=='sales' or $action=='reports')
				$criteria->with=array('user');
			else
				$criteria->with=array('user','distributor');
				
		}
		
		endif;
		
		if($action=='status'){
		    
			$criteria->with[]='status';
		}
		
		$criteria->order=CActiveRecord::model($this->model_name)->field_order.' DESC';
		if(empty($_REQUEST['export'])):
		$pages=new CPagination(CActiveRecord::model($this->model_name)->count($criteria));
		$this->setPageSize($pages,$user_id);
		
		$pages->applyLimit($criteria);
		$this->pages=$pages;
		endif;
	
		$this->items=CActiveRecord::model($this->model_name)->findAll($criteria);
		
		
	}
	
	protected function itemChilds($type='menu',$items)
	
	{
		
		$script='<script type="text/javascript">';
		if($type=='menu')
			$script.='var items=new Array();';
		else
			$script.='var '.$type.'_items=new Array();';
 
		foreach($items as $key=>$value){
		
			if($type=='menu')
				$prefix='';
			else
				$prefix=$type.'_';
			
			if(count($value)>0):
				$item=implode(',',$value);
				$script.=$prefix.'items['.$key.']=new Array('.$item.');';
				
			endif;
				
			
		}
		

		$script.='</script>';
		
		return $script;
		
	}
	
	
	protected function get_javascript_distributors($items)
	{
	
		
		$script='<script type="text/javascript">';
		$script.='var distributors=new Array();';
 
		foreach($items as $key=>$value){
		
			$script.='distributors['.$key.']='.$value.';';
				
		}
		

		$script.='</script>';
		
		return $script;
		
	}
	

	
	protected function checkRole($buffer)
	{
		 if(in_array($buffer,$this->user_roles))
		 	return 'client';
		
		if(in_array($buffer,$this->admin_roles))
		 	return 'admin';
			
		return 'guest';
	}
	
	protected function beforeRender($view)
	{
		$buffer=UserIdentity::getProperty('role');
		$this->current_role=$this->checkRole($buffer);
		$this->type_profile=$this->current_role;
		return true;
	}
	

}