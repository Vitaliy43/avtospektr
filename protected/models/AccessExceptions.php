<?php

class AccessExceptions extends Model
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
		return 'bans_url';
	}
	
	public function getUrlException($role_id=null,$user_id=null,$module=null,$controller,$action='index',$url_parameters='')
	{
		if($role_id==null and $user_id==null)
			return false;
				
		$criteria=new CDbCriteria;
		if($role_id==null){
			$criteria->condition='user_id=:user_id ';
			$criteria->params[':user_id']=$user_id;
		}
		else{
			$criteria->condition='role_id=:role_id ';
			$criteria->params[':role_id']=$role_id;
		}
		
		if($module!=null){
			$criteria->condition.='AND module=:module ';
			$criteria->params[':module']=$module;
		}
		
		$criteria->condition.='AND controller=:controller AND action=:action ';
		$criteria->params[':controller']=$controller;
		$criteria->params[':action']=$action;
		
		if($url_parameters!=''){
			$criteria->condition.='AND url_parameters=:url_parameters ';
			$criteria->params[':url_parameters']=$url_parameters;
		}
		
		if($this->exists($criteria))
			return true;
		return false;
		
	}
}

?>