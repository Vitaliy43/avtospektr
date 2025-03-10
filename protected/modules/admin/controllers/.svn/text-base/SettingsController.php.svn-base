<?php



class SettingsController extends Controller
{
	public function actionIndex()
	{
		$this->pageTitle='Настройки '.$this->prefix_title;
		parent::actionIndex();
		
	}
	
	public function actionContent()
	{
		$this->pageTitle='Текстовые материалы '.$this->prefix_title;

		if(isset($_REQUEST['do']) and $_REQUEST['do']=='add')	{
			$content=$this->add_content();
		}
		elseif(isset($_GET['update'])){
			$content=$this->update_content($_REQUEST['update']);
		}
		
		elseif(isset($_REQUEST['article'])){
			$content=$this->show_article($_REQUEST['article']);
		}
		else{
			$content=$this->list_content();
		}
		
		echo $content;
	}
	
	
	protected function validatePurchasePoint()
	{
		$errors=array();
	
		if(!$_REQUEST['purchase_point_name'])
			$errors['empty_name']='Поле "Наименование" не может быть пустым!';
			
		if($_REQUEST['manager_id']==0)
			$errors['empty_manager_id']='Не выбран менеджер торговой точки!';
				
		if(!$_REQUEST['purchase_point_address'])
			$errors['empty_address']='Поле "Адрес" не может быть пустым!';
			
		if(!$_REQUEST['purchase_point_telephone'])
			$errors['empty_telephone']='Поле "Телефон" не может быть пустым!';
			
		if($_REQUEST['purchase_point_markup']<0)
			$errors['wrong_markup']='Наценка торговой точки не может быть отрицательной!';
		
		if($_REQUEST['purchase_point_delivery_time']<0)
			$errors['wrong_delivery_time']='Время доставки торговой точки не может быть отрицательной!';
							
			return $errors;
	}
	
	protected function addPurchasePoints($errors=null)
	{
			$buffer_managers=Users::model()->getUsersByRole(3,false,false);
			$managers=Utility::createForSelect($buffer_managers,'id','fio','array');
		
		if(isset($_POST['type'])):
		
			ob_start();
			$this->render('add_purchase_points',array('managers'=>$managers,'errors'=>$errors));
			$response['content']=ob_get_contents();
			$response['title']=$this->pageTitle;
			ob_clean();
			return CJSON::encode($response);
		else:
			return $this->render('add_purchase_points',array('managers'=>$managers,'errors'=>$errors),true);

		endif;
	}
	
	
	protected function editPurchasePoints($errors=null)
	{
			$purchase_point_id=$_REQUEST['update'];
			$buffer_managers=Users::model()->getUsersByRole(3,false,false);
			$managers=Utility::createForSelect($buffer_managers,'id','fio','array');
			$point=PurchasePoints::model()->findByPk($purchase_point_id);
		
		if(isset($_POST['type'])):
		
			ob_start();
			$this->render('edit_purchase_points',array('managers'=>$managers,'errors'=>$errors,'point'=>$point));
			$response['content']=ob_get_contents();
			$response['title']=$this->pageTitle;
			ob_clean();
			return CJSON::encode($response);
		else:
			return $this->render('edit_purchase_points',array('managers'=>$managers,'errors'=>$errors,'point'=>$point),true);

		endif;
	}
	
	protected function deactivatePuchasePoints()
	{
			$purchase_point_id=$_REQUEST['deactivate'];
			$point=PurchasePoints::model()->findByPk($purchase_point_id);
		
			$point->deactivated=1;
			$res=$point->save();
			if($res)
				$response['answer']=1;
			else
				$response['answer']=0;
			
		if(isset($_POST['type'])):
		
			
			$response['content']='Торговая точка успешно деактивирована';
			return CJSON::encode($response);
		else:
			return 'Торговая точка успешно деактивирована';

		endif;
	}
	
	public function actionPurchasePoints()
	{
		$this->pageTitle='Торговые точки '.$this->prefix_title;
	
		if(isset($_GET['add'])){
		
			echo $this->addPurchasePoints();
		
			
		}
		elseif(isset($_GET['update'])){
			
			echo $this->editPurchasePoints();
		}
		elseif(isset($_GET['deactivate'])){
			
			echo $this->deactivatePuchasePoints();
		}
		else{
		
		if(isset($_POST['add'])){
			
			$errors=$this->validatePurchasePoint();
			if(count($errors)==0){
				$res=PurchasePoints::model()->addPoint();
				if($res)
					$response['answer']=1;
				else
					$response['answer']=0;
			}
		}
		elseif(isset($_POST['update'])){
			
			$errors=$this->validatePurchasePoint();
			if(count($errors)==0){
				$res=PurchasePoints::model()->updatePoint($_POST['purchase_point_id']);
				if($res)
					$response['answer']=1;
				else
					$response['answer']=0;
			}
		}
		
		if(empty($errors) or count($errors)==0):
		
		$criteria=new CDbCriteria;
		$criteria->condition='deactivated=:act';
		$criteria->params=array(':act'=>0);
		$criteria->with=array('user');
		$criteria->order='show_name';

		$purchase_points=PurchasePoints::model()->findAll($criteria);
		$buffer_purchase_points=PurchasePoints::model()->findAll();
		$purchase_points_deactivated=array();

		if(count($purchase_points)!=count($buffer_purchase_points)){
			
			$criteria=new CDbCriteria;
			$criteria->condition='deactivated=:act';
			$criteria->params=array(':act'=>1);
			$criteria->with=array('user');
			$criteria->order='show_name';
			$purchase_points_deactivated=PurchasePoints::model()->findAll($criteria);
		}
		
	
		if(isset($_POST['type'])):
		
		ob_start();
		$this->render('purchase_points',array('items'=>$purchase_points,'deactivated_items'=>$purchase_points_deactivated));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
	else:
		$this->render('purchase_points',array('items'=>$purchase_points,'deactivated_items'=>$purchase_points_deactivated));

	endif;
	
	else:
	
		echo $this->addPurchasePoints($errors);
	
	endif;
	
	}
		
	}
	
	protected function show_article($id)
	{
		$article=Content::model()->findByPk($id);
		if(isset($_POST['type'])):
			$response['content']=$this->render('show_article',array('article'=>$article),true);
			return 	CJSON::encode($response);
		else:
			return $this->render('show_article',array('article'=>$article),true);
		endif;
	}
	
	protected function add_content()
	{
		
		if(isset($_POST['type'])):
			$response['content']=$this->render('add',array(),true);
			return 	CJSON::encode($response);
		else:
			return $this->render('add',array(),true);
		endif;
	}
	
	protected function update_content($id)
	{
		$article=Content::model()->findByPk($id);
		return $this->render('add',array('article'=>$article),true);
			
	}
	
	public function actionSetCars()
	{
		$this->layout='ajax';
		$article=Content::model()->findByPk($_REQUEST['article_id']);
		$buffer=UserMenu::model()->find('name=:name',array(':name'=>'auto'));
		$article->user_menu_id=$buffer->id;
		$article->auto_car_id=$_REQUEST['item_id'];
		$res=$article->save();	
		if($res){
			$response['answer']=1;
			$response['content']=$this->list_content(true);
		}
		else{
			$response['answer']=0;
		}
		
		echo CJSON::encode($response);

		
	}
	
	
	public function actionMenu()
	{
		$this->layout='ajax';
		$buffer=UserMenu::model()->findByPk($_REQUEST['point_menu']);
		if($_REQUEST['point_menu']==0)
			$buffer->name='none';
		
		if($buffer->name!='auto'):
		$article=Content::model()->findByPk($_REQUEST['article_id']);
		$article->user_menu_id=$_REQUEST['point_menu'];
		$res=$article->save();
		
		$criteria=new CDbCriteria;
		$criteria->order='header';
		$items=Content::model()->findAll($criteria);
		unset($criteria);
		$criteria=new CDbCriteria;
		$criteria->order='show_name';
		$criteria->condition='name!=:name';
		$criteria->params=array(':name'=>'search');
		$menu_items=CArray::arrayFromObjects(UserMenu::model()->findAll($criteria),'id','show_name');
		$menu_items[0]='Нет в меню';
		$response['title']=$this->pageTitle;

		if($res){
			$response['content']=$this->render('content',array('items'=>$items,'menu_items'=>$menu_items,'update'=>$res),true);
			$response['answer']=1;
			$response['auto']=0;
		}
		else{
			$response['answer']=0;
		}
		
		else:
			
			$criteria=new CDbCriteria;
			$criteria->order='name';
			$cars=Cars::model()->findAll($criteria);
			$response['answer']=1;
			$response['auto']=1;
			$response['content']=$this->render('list_cars',array('cars'=>$cars,'article_id'=>$_REQUEST['article_id']),true);		
		endif;
		
		echo CJSON::encode($response);
			

	}
	
	protected function list_content($no_json_encode=false)
	{
		if($this->pageTitle)
			$response['title']=$this->pageTitle;
		if(isset($_POST['add'])){
			Content::model()->addContent();
		}
		elseif(isset($_POST['update'])){
			Content::model()->updateContent($_REQUEST['update']);
		}
		elseif(isset($_GET['delete'])){
			Content::model()->deleteByPk($_GET['delete']);
			$response['answer']=1;
		}
		
		$criteria=new CDbCriteria;
		$criteria->order='header';
		$items=Content::model()->findAll($criteria);
		unset($criteria);
		$criteria=new CDbCriteria;
		$criteria->order='show_name';
		$criteria->condition='name!=:name';
		$criteria->params=array(':name'=>'search');
		$user_menu_auto=UserMenu::model()->find('name=:name',array(':name'=>'auto'));
		$catalog_auto=CArray::arrayFromObjects(Cars::model()->findAll(),'id','name');
		
		$menu_items=CArray::arrayFromObjects(UserMenu::model()->findAll($criteria),'id','show_name');
		$menu_items[0]='Нет в меню';
		if(isset($_POST['type'])):
			$response['content']=$this->render('content',array('items'=>$items,'menu_items'=>$menu_items,'user_menu_auto'=>$user_menu_auto,'catalog_auto'=>$catalog_auto),true);
			if($no_json_encode)
				return $response['content'];
			else
				return 	CJSON::encode($response);
		else:
			return $response['content']=$this->render('content',array('items'=>$items,'menu_items'=>$menu_items,'user_menu_auto'=>$user_menu_auto,'catalog_auto'=>$catalog_auto),true);
		endif;
	}
	
	protected function validateEditFirm()
	{
		$errors=array();
	
		if(!$_REQUEST['firm_name'])
			$errors['empty_firm_name']='Поле "Наименование организации" не может быть пустым!';
			
		if(!$_REQUEST['inn'])
			$errors['empty_inn']='Поле "ИНН" не может быть пустым!';
				
			return $errors;
	}
	
	public function actionFirm()
	{
		$this->pageTitle='Реквизиты организации ';
	
		if(isset($_POST['update'])){
			$errors=$this->validateEditFirm();
			if(count($errors)==0)
				FirmSettings::model()->updateFirm();
				
		}
		else{
			$errors=array();
		}
		
		$firm=FirmSettings::model()->find();
	
		if($_POST['type']=='ajax'):
			$response['content']=$this->render('firm',array('firm'=>$firm,'errors'=>$errors),true);
			$response['title']=$this->pageTitle;
		
				echo CJSON::encode($response);
		else:
			$this->render('firm',array('firm'=>$firm,'errors'=>$errors));
			
		endif;
	}

	protected function beforeAction($action)
	{
		$action=$this->getAction()->getId();
		if($action=='menu' or $action=='setcars'){
			
			if(UserIdentity::getProperty('role')=='root')
				return true;
			else
				return false;
		}
		else{
			parent::beforeAction($action);

		}
		

		return true;
	}

}

?>