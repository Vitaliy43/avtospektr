<?php

Yii::import('application.modules.autoparts.models.Basket');

class UserController extends Controller 
{
	
	private $_identity;
	public $activated;
	private $errors=array(
	1=>'Пользователя с таким логином нет!',
	2=>'Неправильный пароль!',
	3=>'Поле <<Логин>> не может быть пустым!',
	4=>'Поле <<Пароль>> не может быть пустым!',
	100=>'Неизвестная ошибка авторизации!'
	);
	
	
	protected function init_session_timeout(){
		
		$config_timeout=Config::model()->item('session_lifetime');
		$session=new CHttpSession;
		
		$current_timeout=$session->getTimeout();
		if($current_timeout!=$current_timeout)
			$session->setTimeout($config_timeout);
			
	}
	
	public function actionChecklogin()
	{
		if(isset($_POST['type'])):
			if(Users::model()->exists('user=:login',array(':login'=>$_REQUEST['user'])))
				$response['answer']=1;
			else
				$response['answer']=0;
				echo CJSON::encode($response);
				
			else:
				$this->redirect(SITE_PATH);

		endif;
	}
	
	public function actionCheckemail()
	{
		if(isset($_POST['type'])):
			if(Users::model()->exists('email=:email',array(':email'=>$_REQUEST['email'])))
				$response['answer']=1;
			else
				$response['answer']=0;
				echo CJSON::encode($response);
				
			else:
				$this->redirect(SITE_PATH);

		endif;
	}
	
	
	
	public function actionCheckcaptcha()
	{
		if(isset($_POST['type'])):
			if($_SESSION['key']!=$_REQUEST['txtCaptcha'])
				$response['answer']=1;
			else
				$response['answer']=0;
				echo CJSON::encode($response);
				
			else:
				$this->redirect(SITE_PATH);

		endif;
	}
	
	
	public function actionProfile()
	{
		$errors=$this->validateProfile();
		
		if(count($errors)>0){
		if(isset($_POST['type'])):
			 ob_start();
			$this->render('profile',array('errors'=>$errors));

			$response['content']=ob_get_contents();
			ob_clean();
			echo CJSON::encode($response);

		else:
			$this->render('profile',array('errors'=>$errors));
		endif;
		}
		else{
			if($_REQUEST['profile_new_password']!='')
				$res=UserIdentity::updateProfile(true);
			else
				$res=UserIdentity::updateProfile();
				
		if(isset($_POST['type'])):
			 ob_start();
			$this->render('updated_profile',array('res'=>$res));

			$response['content']=ob_get_contents();
			ob_clean();
			echo CJSON::encode($response);

		else:
			$this->render('updated_profile',array('res'=>$res));
		endif;
			
		}
	}
	
	protected function validateProfile()
	{
		
		$errors=array();
	
		if($_REQUEST['profile_old_password']!=''){
			if(!Users::model()->exists('password=:password AND id=:id',array(':password'=>md5($_REQUEST['profile_old_password']),':id'=>UserIdentity::getProperty('id'))))
			$errors['password_wrong']='Неверный пароль!';	
		}
		
		if($_REQUEST['profile_new_password']!=''){
			if(strlen($_REQUEST['profile_new_password'])<4)
				$errors['password_strlen']="Пароль должен содержать не менее 4 символов!";
			if($_REQUEST['profile_new_password']!=$_REQUEST['profile_confirm_password'])
				$errors['password_no_match']='Пароль и подтверждение не совпадают!';
			
		}
			
	
		if(!$_REQUEST['profile_address'] or strlen($_REQUEST['profile_address'])<3)
			$errors['address_empty']='Поле "Адрес" не может быть пустым!';
			
		if(!$_REQUEST['profile_telephone'] or strlen($_REQUEST['profile_telephone'])<1)
			$errors['telephone_empty']='Поле "Телефон" не может быть пустым!';
		$res=preg_match('/^[A-Za-z0-9]+(\.\w+)*@([A-Za-z0-9]+\w*)((\.[A-Za-z0-9]+\w*))*\.([A-Za-z0-9]){2,6}$/',$_REQUEST['profile_email']);
		if(!$_REQUEST['profile_email'])
			$errors['email_empty']='Поле "E-mail" не может быть пустым!';
		if(!$res)
			$errors['email_wrong']='В поле "E-mail" введены некорректные значения!';
			
			
			if(Users::model()->exists('email=:email AND id!=:id',array(':email'=>$_REQUEST['profile_email'],':id'=>UserIdentity::getProperty('id'))))
			$errors['email_exist']='Пользователь с таким e-mail уже зарегистрирован!';	
							
			return $errors;
								
	}
	
	protected function validateRegistration()
	{
		if(isset($_REQUEST['submit'])){
		
		$errors=array();
		
		if(!$_REQUEST['user'])
			$errors['login_empty']='Поле "Логин" не может быть пустым!';
		
		$res=preg_match('/[а-яА-Я]+$/',$_REQUEST['user'],$matches);
		if($res)
			$errors['login_russian']='Поле "Логин" содержит русские буквы!';
			
		if(Users::model()->exists('user=:login',array(':login'=>$_REQUEST['user'])))
			$errors['login_exist']='Данный логин уже занят другим пользователем!';
						
		if(!$_REQUEST['passwd'])
			$errors['password_empty']='Поле "Пароль" не может быть пустым!';
		if(strlen($_REQUEST['passwd'])<4)
			$errors['password_strlen']="Пароль должен содержать не менее 4 символов!";
			
			
		if(!$_REQUEST['address'] or strlen($_REQUEST['address'])<3)
			$errors['address_empty']='Поле "Адрес" не может быть пустым!';
			
		if(!$_REQUEST['telephone'] or strlen($_REQUEST['telephone'])<1)
			$errors['telephone_empty']='Поле "Телефон" не может быть пустым!';
		$res=preg_match('/^[A-Za-z0-9]+(\.\w+)*@([A-Za-z0-9]+\w*)((\.[A-Za-z0-9]+\w*))*\.([A-Za-z0-9]){2,6}$/',$_REQUEST['email']);
		if(!$_REQUEST['email'])
			$errors['email_empty']='Поле "E-mail" не может быть пустым!';
		if(!$res)
			$errors['email_wrong']='В поле "E-mail" введены некорректные значения!';
			
			if(Users::model()->exists('email=:email',array(':email'=>$_REQUEST['email'])))
			$errors['email_exist']='Пользователь с таким e-mail уже зврегистрирован!';	
			
			if($_SESSION['key']!=$_REQUEST['txtCaptcha'])
			$errors['captcha']='Цифры,введенные вами не совпадают с кодом!';
			
				
			return $errors;
					
		}
				
		
	}
	
	public function actionRemind()
	{
		if(isset($_POST['type'])):
				
			if(isset($_REQUEST['remind_first'])){
				
			if(UserIdentity::remind()){
				$response['answer']=0;
				$response['content']='На почтовый ящик, указанный вами при регистрации выслано письмо с дальнейшими инструкциями по восстановлению пароля';
			}
			else{
				$response['answer']=1;
				$response['content']='Пользователя с таким логином или email нет в базе данных!';
			}
			}
			
			
			
			else{
				ob_start();
				$this->render('remind');

				$response['content']=ob_get_contents();
				ob_clean();
			}
		
			
			
			
			echo CJSON::encode($response);
				

		else:
		
		if(isset($_REQUEST['code_restore'])){			
				
			if($_REQUEST['code_restore']==$_SESSION['code_restore'] ){
				$user=Users::model()->find('user=:user',array(':user'=>$_SESSION['temp_user']));
				UserIdentity::setProperty('id',$user->id);
				UserIdentity::setProperty('username',$user->user);
				UserIdentity::setProperty('fio',$user->user);
				$role_info=Roles::model()->findByPk($user->user_role[0]->role_id);
				UserIdentity::setProperty('role',$role_info->name);
				$this->redirect(SITE_PATH.'client/profile?type=ajax');
			}
			}
		
			$this->render('remind');
							
		
		endif;
	}
	
	
	public function actionRegistration()
	{
		$errors=false;
		$saved=false;
		
		if(isset($_REQUEST['submit'])):

		$errors=$this->validateRegistration();
		$this->activated=true;
		if(count($errors)<1){
			$res=Users::model()->saveUser();
			if($res)
				$saved=true;
			else
				$saved=false;
		}
		else{
			$saved=false;
		}
		
		
		
		endif;
		 
		if(isset($_POST['type'])):
			 ob_start();
			$this->render('registration',array('errors'=>$errors,'saved'=>$saved));

			$response['content']=ob_get_contents();
			ob_clean();
			echo CJSON::encode($response);

		else:
			$this->render('registration',array('errors'=>$errors,'saved'=>$saved));
		endif;
		 
		
	}
	
	


	public function actionLogout()
	{
		
		if(isset($_POST['type'])):
			if(UserIdentity::Logout()){
		
				$response['answer']=1;
				$response['content']=$this->render('login',array('type'=>'logout'),true);
		
			}
			else{
				$response['answer']=0;

			}
		
			echo CJSON::encode($response);
		else:
		
		UserIdentity::Logout();
		$this->redirect(SITE_PATH);
		
		endif;
	
	}
	
	public function actionLogin()
	{
		
		if($_POST['login']==''){
			$this->render('login',array('answer'=>$this->errors[3],'code_error'=>3));
			return true;

		}
		
		if($_POST['password']==''){
			$this->render('password',array('answer'=>$this->errors[4],'code_error'=>4));
			return true;

		}
		
		$this->_identity=new UserIdentity($_POST['login'],$_POST['password']);
		
		$this->_identity->authenticate();
		
		if(isset($_POST['type'])):
		$response['answer']=$this->_identity->errorCode;	
			
		if($this->_identity->errorCode==0):
		
		$response['content']=$this->render('login',array('type'=>'login'),true);
		endif;
		
		echo CJSON::encode($response);
		
		else:

		if($this->_identity->errorCode==0){
			Yii::import('application.modules.autoparts.models.WebService');
			Basket::model()->transfer_orders();
			$this->redirect(SITE_PATH);

		}
		else{
			$this->render('login',array('answer'=>$this->errors[$this->_identity->errorCode],'code_error'=>$this->_identity->errorCode));

		}
		
		endif;
		
	}
	
	
	protected function beforeAction($action)
	{
		parent::beforeAction($action);
		return true;
	
	}
	
	
	
}

?>