<?php

Yii::import('application.modules.client.models.Clients');
Yii::import('application.modules.autoparts.models.OrdersArchive');

class StaffController extends Controller
{
	
	
	public $validate_errors=array();
	
	
	public function actionAdd()
	{
		$this->pageTitle='Добавление сотрудников для '.$this->prefix_title;
		$buffer=Users::model()->getUsersByRole(1);
		$buffer_roles=Roles::model()->findAll('id=:manager_id OR id=:admin_id',array(':manager_id'=>3,'admin_id'=>4));
		
		$users=Utility::createForSelect($buffer['list'],'id','fio');
		$roles=Utility::createForSelect($buffer_roles,'id','show_name');
		
		if(isset($_POST['type'])):
		
		 ob_start();
		$this->render('add',array('users'=>$users,'roles'=>$roles));
		$response['content']=ob_get_contents();
		ob_clean();
		echo CJSON::encode($response);
		
	else:
	
		$this->render('add',array('users'=>$users,'roles'=>$roles));

		
	endif;
	}
	
	public function actionEdit()
	{
	
		if(!$this->updated):
		$user_id=$_REQUEST['user_id'];
		$buffer_roles=Roles::model()->findAll('id=:manager_id OR id=:admin_id',array(':manager_id'=>3,'admin_id'=>4));
		$roles=Utility::createForSelect($buffer_roles,'id','show_name');
		$roles[0]='----';
		$criteria=new CDbCriteria;
		$criteria->with=array('user_role');
		$employee=Users::model()->findByPk($user_id,$criteria);
		
		if(isset($_POST['type'])):
		
		 ob_start();
		$this->render('edit',array('employee'=>$employee,'roles'=>$roles));
		$response['content']=ob_get_contents();
		
		ob_clean();
		if(isset($_REQUEST['update']))
			$response['answer']=0;
		echo CJSON::encode($response);
		
	else:
		$this->render('edit',array('employee'=>$employee,'roles'=>$roles));

	endif;
	
	else:
	
		echo $this->StaffList(1);
	
	endif;
		
	}
	
	protected function validateProfile()
	{
		
		$errors=array();
		$user_id=$_REQUEST['user_id'];
	
		if($_REQUEST['employee_password']):
		if(strlen($_REQUEST['employee_password'])<4)
			$errors['password_strlen']='Пароль должен иметь длину не менее 4 символов!';
		
			if($_REQUEST['employee_password']!=$_REQUEST['employee_confirmation_password'])
				$errors['password_no_match']='Пароль и подтверждение не совпадают!';
			
	
		endif;
		
		if(!$_REQUEST['employee_fio'])
			$errors['empty_fio']='Поле "Фамилия" не может быть пустым!';
			
		if($_REQUEST['role_id']==0)
			$errors['empty_role_id']='Не выбрана группа пользователей!';
			
		$res=preg_match('/^[A-Za-z0-9]+(\.\w+)*@([A-Za-z0-9]+\w*)((\.[A-Za-z0-9]+\w*))*\.([A-Za-z0-9]){2,6}$/',$_REQUEST['employee_email']);
		if(!$_REQUEST['employee_email'])
			$errors['email_empty']='Поле "E-mail" не может быть пустым!';
		if(!$res)
			$errors['email_wrong']='В поле "E-mail" введены некорректные значения!';
			
			
			if(Users::model()->exists('email=:email AND id!=:id',array(':email'=>$_REQUEST['employee_email'],':id'=>$user_id)))
			$errors['email_exists']='Пользователь с таким e-mail уже существует!';	
							
			return $errors;
								
	}
	
	private function StaffList($edit=null)
	{
		$staff=Users::model()->getUsersByRole(3,true);
			
		if(isset($_POST['type'])):

		 ob_start();
		$this->render('index',array('staff'=>$staff));
		$response['content']=ob_get_contents();
		ob_clean();
		if(isset($_REQUEST['update']))
			$response['answer']=1;
		return CJSON::encode($response);
		
	else:
	
		return $this->render('index',array('staff'=>$staff),true);

	endif;
	
	}
	
	public function actionIndex()
	{
		$this->pageTitle='Сотрудники '.$this->prefix_title;
		echo $this->StaffList();

	}
	
	protected function beforeAction($action)
	{
		parent::beforeAction($action);
		if(isset($_REQUEST['add'])){
			$res=UserRoles::model()->updateRoleByUserId($_REQUEST['user_id'],$_REQUEST['role_id']);
			if($res)
				$this->added=1;
		}
		elseif(isset($_REQUEST['update'])){
			$this->validate_errors=$this->validateProfile();
			if(count($this->validate_errors)>0){
				
			}
			else{
				$res=Users::model()->updateEmployee($_REQUEST['user_id']);
				if($res){
					$this->updated=1;
					
				}
				else{
					$this->validate_errors['unknown_error']='Неизвестная ощибка';
				
				}
			}
		}
			
		return true;
	}
}

?>