<?php

class Users extends CActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 * 
	 */
	 
	 public function getAll($sort=''){
			
			$criteria=new CdbCriteria;
			$criteria->select='*';
			$criteria->order='fio'.$sort;
			$criteria->with=array('user_role');
			
			$items=$this->findAll($criteria);
			
			return $items;
			
	}
	
	public function saveUser()
	{
		$user=new Users;
		$user->user=$_REQUEST['user'];
		$user->password=md5($_REQUEST['passwd']);
		$user->email=$_REQUEST['email'];
		$user->fio=$_REQUEST['fio'];
		$user->address=$_REQUEST['address'];
		$user->telephone=$_REQUEST['telephone'];
		$user->activity=1;
		$user->data_registry=date("Y-m-d H:i:s");
		$res=$user->save();
		if($res)
			$new_user=$this->find('user=:user',array(':user'=>$_REQUEST['user']));
		$user_role=new UserRoles;
		$user_role->user_id=$new_user->id;
		$user_role->role_id=1;
		return $user_role->save();
	}
	
	 public function updateEmployee($user_id)
	{
		$user=$this->findByPk($user_id);
		$user->fio=$_REQUEST['employee_fio'];
		if($_REQUEST['employee_password'])
			$user->password=md5($_REQUEST['employee_password']);
		$user->email=$_REQUEST['employee_email'];
		$user->address=$_REQUEST['employee_address'];
		$user->telephone=$_REQUEST['employee_telephone'];
		$res=$user->save();
		$user_role=UserRoles::model()->find('user_id=:user_id',array(':user_id'=>$user_id));
		$user_role->role_id=$_REQUEST['role_id'];
		return $user_role->save();
	}
	
	public function getIdByFio($fio)
	{
		$criteria=new CdbCriteria;
		$criteria->select='id';
		$criteria->condition='fio=:fio';
		$criteria->params=array(':fio'=>$fio);
		$item=$this->find($criteria);
		return $item->id;
	}
	
	public function getUsersByRole($role_id,$no_criteria=false,$between=true)
	{
	
		$criteria=new CDbCriteria;
		if($role_id>2){
		
		if($between)
			$sql="SELECT users.*, user_roles.role_id 'role_id' FROM user_roles,users WHERE users.id = user_roles.user_id AND user_roles.role_id BETWEEN ".$role_id." AND 4 ORDER BY users.fio";
		else
			$sql="SELECT users.*, user_roles.role_id 'role_id' FROM user_roles,users WHERE users.id = user_roles.user_id AND user_roles.role_id=$role_id ORDER BY users.fio";
			$result=Yii::app()->db->createCommand($sql)->queryAll();
		}
			
		else{
			$criteria->with=array('user_role'=>array('select'=>false,'joinType'=>'INNER JOIN','condition'=>'user_role.role_id='.$role_id),'client','orders_archive'=>array('select'=>'sum(sum_client) AS sum_client','group'=>'fio'));
			$criteria->order='fio';
			$result['list']=$this->findAll($criteria);
			$result['criteria']=$criteria;
			
		}
		
		return $result;
	}
	
	public function getUsersById($id)
	{
	
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='`t`.id='.$id;
		$criteria->with=array('client','markup');
		return $this->find($criteria);
		
	}
	
	
	
	public function getUsersByRoleCount($role_id)
	{
		$res=Users::model()->with(array(
		'user_role'=>array(
		'select'=>false,
		'joinType'=>'INNER JOIN',
		'condition'=>'user_role.role_id='.$role_id
		),
		'client'
		))->count();
		return $res;
	}
	
	public function relations()
	{
		return array(
		'orders_archive'=>array(self::HAS_MANY,'OrdersArchive','user_id'),
		'orders_status'=>array(self::HAS_MANY,'OrdersStatus','user_id'),
		'user_role'=>array(self::HAS_MANY,'UserRoles','user_id'),
		'client'=>array(self::HAS_MANY,'Clients','user_id'),
		'markup'=>array(self::HAS_MANY,'Markups','user_id'),	
		'vin_requests'=>array(self::HAS_MANY,'VinRequest','user_id'),
		'purchase_points'=>array(self::HAS_MANY,'PurchasePoints','manager_id'),
		'type_payments'=>array(self::BELONGS_TO,'TypePayments','type_payment_id')
		);
	}
	 
	public function getLogin($login,$password)
	{
		
		
		$criteria=new CDbCriteria;
		$criteria->select='*';
		$criteria->condition='user=:user AND password=:password';
		$criteria->params=array(':user'=>$login,':password'=>md5($password));
		$criteria->with=array('user_role');
		$buffer=$this->find($criteria);
		$data['objects']=$buffer;
		$data['answer']=0;
		
		if($buffer)
			return $data;
		
		if($buffer==null){
			unset($criteria);
			unset($data);
			$criteria=new CDbCriteria;
			$criteria->select='*';
			$criteria->condition='user=:user';
			$criteria->params=array(':user'=>$login);
			$criteria->with=array('user_role');
			$buffer=$this->find($criteria);
			if(!$buffer){
				$data['answer']=1;
				return $data;
			
			}
			
		}
		
		if($buffer){
			unset($criteria);
			unset($data);
			$criteria=new CDbCriteria;
			$criteria->select='*';
			$criteria->condition='password=:password AND user=:user';
			$criteria->params=array(':password'=>md5($password),':user'=>$login);
			$criteria->with=array('user_role');
			$buffer=$this->find($criteria);
			if(!$buffer){
				$data['answer']=2;
				return $data;
			}
			
			
		}
		
			$data['answer']=100;
			return $data;
		
		
	}
	
	
	
	public function getEmail($email,$password)
	{
	
		$data=$this->find(array(
		'select'=>'*',
		'condition'=>'email=:email and password=:password',
		'params'=>array(':email'=>$email,':password'=>md5($password))
		));
		return $data;

	}
}

?>