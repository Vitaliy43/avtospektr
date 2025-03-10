<?php

class Clients extends Model
{
	public function tableName()
	{
		return 'clients';
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	
	
	public function relations()
	{
		return array(
		'user'=>array(self::BELONGS_TO,'Users','user_id')
				
		);
	}
	
	public function updateLimitCredit($user_id)
	{
		$criteria=new CDbCriteria;
		$criteria->condition='user_id='.$user_id;
		$client=$this->find($criteria);
		$client->limit_credit=$_REQUEST['limit_credit'];
		return $client->save();
		
	}
	
	public function addLimitCredit()
	{
		
		$client=new Clients;
		$client->user_id=$_REQUEST['client_id'];
		$client->limit_credit=$_REQUEST['limit_credit'];
		return $client->save();
		
	}
	
	public function getLimitCredit($user_id)
	{
		$res=$this->find('user_id=:user_id',array(':user_id'=>$user_id));
		return $res->limit_credit;
	}
}

?>