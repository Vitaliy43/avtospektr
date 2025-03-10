<?php

Yii::import('application.modules.client.models.Clients');
Yii::import('application.modules.autoparts.models.Balance');
Yii::import('application.modules.autoparts.models.OrdersArchive');
Yii::import('application.modules.autoparts.models.Markups');
Yii::import('application.modules.autoparts.models.Distributors');


class ClientsController extends Controller
{

	public $all_distributors;
	protected $result_pricing=false;

	public function actionEdit()
	{
		$client_id=$_REQUEST['client_id'];
			
		$criteria=new CDbCriteria;
		
		$criteria->with=array('markups'=>array(
		'joinType'=>'INNER JOIN',
		'condition'=>'markups.user_id='.$client_id
		));
		
		$distributors=Distributors::model()->findAll($criteria);

		$buffer=Distributors::model()->getAvailableDistributors($client_id);	
		$missing_distributors=Utility::createForSelect($buffer,'id','name');
		$this->pageTitle='Редактирование клиентов для '.$this->prefix_title;
		$distributors_count=Distributors::model()->count();
		$client=Users::model()->getUsersById($client_id);
		
		if(isset($_POST['type'])):
		
		 ob_start();
		$this->renderPartial('edit',array('client'=>$client,'distributors'=>$distributors,'distributors_count'=>$distributors_count,'missing_distributors'=>$missing_distributors,));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
		$this->render('edit',array('client'=>$client,'distributors'=>$distributors,'distributors_count'=>$distributors_count,'missing_distributors'=>$missing_distributors));

		
	endif;
		
	}
	
	public function actionAdd()
	{
		$this->pageTitle='Добавление клиентов для '.$this->prefix_title;
		$buffer=Users::model()->getUsersByRole(1);
		
		$clients=Utility::createForSelect($buffer['list'],'id','fio');
		$distributors=Distributors::model()->findAll();
		
		if(isset($_POST['type'])):
		
		 ob_start();
		$this->renderPartial('add',array('clients'=>$clients,'distributors'=>$distributors));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
	
		$this->render('add',array('clients'=>$clients,'distributors'=>$distributors));

		
	endif;

	}
	
	public function actionRemoveMarkup()
	{
		$res=Markups::model()->deleteByPk($_REQUEST['markup_id']);
		if($res){
			$response['answer']=1;
		}
		else{
			$response['answer']=0;
		}
		
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:user_id AND distributor_id=:distributor_id AND price_range IS NOT NULL';
		$criteria->params=array(':user_id'=>$_REQUEST['client_id'],':distributor_id'=>$_REQUEST['distributor_id']);
		$criteria->order='price_range';
		$markups=Markups::model()->findAll($criteria);
		$buffer=$this->link_content($markups);
		$response['link_content']=$buffer['link_content'];		
		$response['markups_title']=$buffer['markups_title'];		
		$response['type_change']='';
		
		echo CJSON::encode($response);

		
	}
	
	protected function link_content($markups)
	{
		$pricing_markups='Ценовые диапазоны:';
		foreach($markups as $markup){
			if(isset($markup->price_range)){
				$pricing_markups.=' До '.$markup->price_range.' руб. - '.$markup->markup.'% .';
				}
		}
	
	if($pricing_markups=='Ценовые диапазоны:')
		$pricing_markups='Отсутствует';
				$response['link_content']='<span class="link_info" title="'.$pricing_markups.'">Смотреть</span>
	<span style="margin-left:5px;">
	<a href="#set_price_range" onclick="set_pricing(\''.SITE_PATH.$this->module->id.'/'.$this->id.'/setpricing?distributor_id='.$_REQUEST['distributor_id'].'&edit_markups=1'.'\',\''.$_REQUEST['distributor_id'].'\',\''.$_REQUEST['client_id'].'\');return false;" id="set_pricing_'.$_REQUEST['distributor_id'].'" class="update">Редактировать</a>
	</span>';
		$response['markups_title']=$pricing_markups;
		return $response;
		
	}
	
	public function actionSetPricing()
	{
		$distributor=Distributors::model()->findByPk($_REQUEST['distributor_id']);
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:user_id AND distributor_id=:distributor_id AND price_range IS NOT NULL';
		$criteria->params=array(':user_id'=>$_REQUEST['client_id'],':distributor_id'=>$_REQUEST['distributor_id']);
		$criteria->order='price_range';
		$response['link_content']='';
		$response['type_change']='';
		if(isset($_REQUEST['pricing_insert']) and $this->result_pricing){
				$markups=Markups::model()->findAll($criteria);
				$response['type_change']='insert';
				$buffer=$this->link_content($markups);
				$response['link_content']=$buffer['link_content'];
				$response['markups_title']=$buffer['markups_title'];
				
			}
			elseif(isset($_REQUEST['pricing_update']) or isset($_REQUEST['edit_markups'])){
				$markups=Markups::model()->findAll($criteria);
				$response['type_change']='update';
				$buffer=$this->link_content($markups);
				$response['link_content']=$buffer['link_content'];
				$response['markups_title']=$buffer['markups_title'];

			}
			else{
				$markups=array();
			}
		
		
		
		if(isset($_POST['type'])):
			
			if(isset($this->validate_errors['repeated_values'])){
				$response['error']=$this->validate_errors['repeated_values'];
			}
			else{
				$response['error']='';
			}
			if($this->result_pricing){
				$response['answer']=1;
				
			}	
			else{
				$response['answer']=0;
				
			}
					
			ob_start();
			$this->render('pricing',array('distributor'=>$distributor,'markups'=>$markups));
			$response['content']=ob_get_contents();
			ob_clean();
			echo CJSON::encode($response);
		
		else:
	
			$this->render('pricing',array('distributor'=>$distributor,'markups'=>$markups));
		
		endif;
	}
	
	public function actionIndex()
	{
		$this->pageTitle='Клиенты '.$this->prefix_title;

		if(isset($_REQUEST['role_id'])){
			$role_id=$_REQUEST['role_id'];

		}
		else{
			
			if(UserIdentity::getProperty('role')=='admin' or UserIdentity::getProperty('role')=='root'):
				$role_id=2;
				$view='admin';
			else:
				$role_id=1;
				$view='manager';

			endif;
		}
			
		$buffer=Users::model()->getUsersByRole($role_id);
		$clients=$buffer['list'];
		$criteria=$buffer['criteria'];

		$pages=new CPagination(Users::model()->getUsersByRoleCount($role_id));
		$this->setPageSize($pages,UserIdentity::getProperty('id'));
		$pages->applyLimit($criteria);
		
		if(isset($_POST['type'])):
		
		 ob_start();
		$this->render($view,array('clients'=>$clients,'pages'=>$pages));
		$response['content']=ob_get_contents();
		$response['title']=$this->pageTitle;
		ob_clean();
		echo CJSON::encode($response);
		
	else:
	
		$this->render($view,array('clients'=>$clients,'pages'=>$pages));

		
	endif;
	}
	
	protected function setPricing()
	{
		$buffer=$_POST;
		$buffer=CArray::delete_index($buffer,array('type','distributor_id','pricing_insert'),true);
		$errors=$this->validateSetPricing($buffer);
		if(count($errors)>0){
			$this->validate_errors=$errors;
			
		}
		else{
			$res=Markups::model()->addComplexMarkups($buffer,$_REQUEST['distributor_id'],$_REQUEST['client_id']);
			if($res)
				$this->result_pricing=true;
		}
	}
	
	protected function updatePricing()
	{

		$buffer=$_POST;
		$buffer=CArray::delete_index($buffer,array('type','distributor_id','pricing_update'),true);
		$errors=$this->validateSetPricing($buffer);
		if(count($errors)>0){
			$this->validate_errors=$errors;
			
		}
		else{
			$buffer_update=array();
			$buffer_insert=array();
			
			foreach($buffer as $key=>$value){
				if(strpos($key,'edit')){
					$buffer_update[$key]=$buffer[$key];
				}
				else{
					$buffer_insert[$key]=$buffer[$key];
				}
			}
			
			if(count($buffer_update)>0){
				$res=Markups::model()->updateComplexMarkups($buffer_update,$_REQUEST['distributor_id'],$_REQUEST['client_id']);
			}
			
			if(count($buffer_insert)>0){
				$res=Markups::model()->addComplexMarkups($buffer_insert,$_REQUEST['distributor_id'],$_REQUEST['client_id']);
			}
			if($res)
				$this->result_pricing=true;
		}
	}
	
	protected function validateSetPricing($array)
	{
		$errors=array();
	
		foreach($array as $key=>$value){
			
		$buffer=explode('_',$key);
		
			if($value==''){
				$errors['empty_fields']='Одно из полей является пустым!';
			}
			
			if($value<0){
				$errors['zero']='В одном из полей имеется значение меньше 0!';
			}
			
			if(count($buffer)>=3  and $buffer[0]=='price'):
				
				$price_arr[$key]=$value;
								
			endif;
		}
		
		$price_arr_unique=array_unique($price_arr);
		if(count($price_arr)!=count($price_arr_unique))
			$errors['repeated_values']='В полях ценовых пределов не может быть повторяющихся значений!';
		
		return $errors;
	}
	
	public function actionDelete()
	{
		$res=$this->deleteClient($_REQUEST['client_id']);
		if($res)
			$response['answer'] = 1;
		else
			$response['answer'] = 0;
		echo CJSON::encode($response);
	}
	
	protected function deleteClient($user_id)
	{
		Balance::model()->delete('user_id=:user_id',array(':user_id'=>$user_id));
		Markups::model()->deleteAll('user_id=:user_id',array(':user_id'=>$user_id));
		Clients::model()->deleteAll('user_id=:user_id',array(':user_id'=>$user_id));
		return UserRoles::model()->updateRoleByUserId($user_id,1);
	}
	
	protected function addClient($user_id)
	{
		$res=UserRoles::model()->updateRoleByUserId($user_id,2);
		$res=Clients::model()->addLimitCredit();
		$res=Markups::model()->addListMarkups();
		$res=Balance::model()->addBalance($user_id);
		return $res;
	}
	
	
	protected function beforeAction($action)
	{
		$action=$this->getAction()->getId();
		$this->model_name='Clients';
		$this->all_distributors=Distributors::model()->findAll();

		parent::beforeAction($action);
			if(isset($_REQUEST['update'])){
				Clients::model()->updateLimitCredit($_REQUEST['client_id']);
				Markups::model()->updateListMarkups($_REQUEST['client_id']);
				$client=Users::model()->findByPk($_REQUEST['client_id']);
				if(isset($_POST['type'])):
			
				else:
					$this->breadcrumbs[$_REQUEST['client_id']]=$client->fio;
				endif;
				 
			}
			elseif(isset($_REQUEST['add'])){
			
				$res=$this->addClient($_REQUEST['client_id']);
				if(!$res)
					return false;
			}
			elseif(isset($_REQUEST['pricing_insert'])){
				$this->setPricing();
			}
			elseif(isset($_REQUEST['pricing_update'])){
				$this->updatePricing();
			}
			
		if($action=='edit' and isset($_REQUEST['client_id'])){
			$client=Users::model()->findByPk($_REQUEST['client_id']);
			$this->breadcrumbs[$client->fio]=SITE_PATH.$this->module->id.'/'.$this->id.'/'.$action.'?client_id='.$_REQUEST['client_id'];
		}
		
		if(isset($_POST['type']))
			$this->layout='ajax';
		
		$this->javascript_distributors=$this->renderPartial('index',array(),true);
		
		return true;
	}
	

}

?>