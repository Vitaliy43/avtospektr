<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	 
	public static function getProperty($key)
	{
		
		return Yii::app()->user->getState($key);
		
	}
	
	public static function setProperty($key,$value)
	{
		
		Yii::app()->user->setState($key,$value);

	}
	
	public static function Logout(){
		
		Yii::app()->user->logout();
		if(self::getProperty('username'))
			return false;
		return true;
	}
	
	public static function getUser($id)
	{
		$user=Yii::app()->db->createCommand(array(
    	'select'=>'*',
    	'from'=>'users',
		'where'=>'id='.$id
	))->queryRow();
		return $user;
	
	}
	
	public static function updateProfile($update_password=false)
	{
		$user=Users::model()->findByPk(self::getProperty('id'));
		$user->address=$_REQUEST['profile_address'];
		$user->telephone=$_REQUEST['profile_telephone'];
		$user->email=$_REQUEST['profile_email'];
		$user->type_payment_id=$_REQUEST['type_payment'];
		
		if($update_password)
			$user->password=md5($_REQUEST['profile_new_password']);
		return $user->save();
	
	}
	
	public static function remind()
	{
		$user=Users::model()->find('user=:user',array(':user'=>CHttpRequest::getPost('loginmail')));
		if(isset($user->password)){
			$res=Messages::mail_notice($user,'remind_password');
			if($res)
				return true;
			
			
		}
		
		$user=Users::model()->find('email=:email',array(':email'=>CHttpRequest::getPost('loginmail')));
		if(isset($user->password)){
			$res=Messages::remind_password($user);
			if($res)
				return true;
		}
		
		return false;

	}
	
	public static function setPurchasePoint($purchase_point=1,$change=false)
		{

			if(self::getProperty('purchase_point') or isset($_COOKIE['purchase_point'])){

				if($change==true){
					self::setProperty('purchase_point',$purchase_point);
					setcookie('purchase_point','',time()-3600);
					setcookie("purchase_point",$purchase_point,time()+31536000);
					
				}
			}
			else{
				self::setProperty('purchase_point',$purchase_point);
				setcookie("purchase_point",$purchase_point,time()+31536000);
			}
			
		}
		
		public static function getPurchasePoint()
		{
			$sess=self::getProperty('purchase_point');
			if($sess)
				return $sess;
			if(isset($_COOKIE['purchase_point']))
				return $_COOKIE['purchase_point'];
		}
	
	
	public static function banSection($items,$access_rules)
	{
		for($i=0;$i<count($items);$i++){
			
			if(in_array($items[$i]->name,$access_rules)){
				
			}
			else{
				$new_items[$i]=$items[$i];
			}	
			
			
		}
		
		return $new_items;
		
	}
	
	
	

	public static function SetPermissionsItems($items,$type)
	{
	
	if(self::getProperty('role')=='client' or self::getProperty('role')=='user'):
	
		return $items;
	
	else:
		$list_objects=Config::model()->getObjects($type.'_access',self::getProperty('role'));
		

		
		foreach($items as $item){
		
			
			if(in_array($item->name,$list_objects))
				$new_arr[]=$item;
		}
			
			return $new_arr;

	endif;
		
	}
	
	 
	public function authenticate()
	{
	
		$buffer=Users::model()->getLogin($this->username,$this->password);
		//var_dump($buffer);
		//die();
		
		if(isset($buffer['objects']))
			$data=$buffer['objects'];
		else
			$data=null;
		
		$answer=$buffer['answer'];
		 
	
		if($data==null and $answer==1):
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($data==null and $answer==2):
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		elseif($data==null and $answer==100):
			$this->errorCode=self::ERROR_UNKNOWN_IDENTITY;
		else:
			$this->setProperty('email',$data->email);
			$this->setProperty('username',$data->user);
			$this->setProperty('fio',$data->fio);
			$this->setProperty('id',$data->id);
			$this->setProperty('role_id',$data->user_role[0]->role_id);
		
			$role_info=Roles::model()->findByPk($data->user_role[0]->role_id);
			$this->setProperty('role',$role_info->name);
			$this->errorCode=self::ERROR_NONE;

			
		endif;
		//return $this->errorCode;
	}
}