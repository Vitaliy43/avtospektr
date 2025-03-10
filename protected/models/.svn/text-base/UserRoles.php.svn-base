<?php

class UserRoles extends CActiveRecord
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
		return 'user_roles';
	}
	
	public function getRoleByUserId($user_id)
	{
		$res=$this->find(array(
		'select'=>'*',
		'condition'=>'user_id=:user_id',
		'params'=>array(':user_id'=>$user_id)
		));
		
		return $res;
	}
	
	public function updateRoleByUserId($user_id,$role_id)
	{
		$user=$this->find(array(
		'select'=>'*',
		'condition'=>'user_id=:user_id',
		'params'=>array(':user_id'=>$user_id)
		));
		
		$user->role_id=$role_id;
		$res=$user->save();
		return $res;
	}
	
	
	public function relations()
	{
		return array(
		'user'=>array(self::BELONGS_TO,'Users','user_id'),
		);
	}
}

?>