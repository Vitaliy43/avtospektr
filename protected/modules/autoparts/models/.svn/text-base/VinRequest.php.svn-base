<?php

class VinRequest extends Model
{

	public $filter_params=array(
	'date1'=>'data_requested',
	'date2'=>'data_requested',
	'brand'=>'brand',
	'model'=>'model',
	'number_vin'=>'number_vin',
	'year'=>'year'
	);
	
	public $field_order='data_requested';

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'vin_requests';
	}
	
	public function relations()
	{
		return array(
		'user'=>array(self::BELONGS_TO,'Users','user_id')				
		);
	}
	
	public function insertVin()
	{
		$vin=new VinRequest;
		$vin->user_id=UserIdentity::getProperty('id');
		$vin->number_vin=$_REQUEST['numberVin'];
		$vin->year=$_REQUEST['year'];
		$vin->brand=$_REQUEST['brands'];
		$vin->model=$_REQUEST['model'];
		$vin->type_engine=$_REQUEST['type_engine'];
		$vin->engine_capacity=$_REQUEST['engine-capacity'];
		$vin->gear=$_REQUEST['gear'];
		$vin->car_bodies=$_REQUEST['car_bodies'];
		$vin->transmission=$_REQUEST['transmission'];
		$vin->air=$_REQUEST['air'];
		$vin->gur=$_REQUEST['gur'];
		$vin->additional_info=$_REQUEST['additional_info'];
		$vin->necessary_parts=$_REQUEST['necessary_parts'];
		$vin->data_requested=date("Y-m-d H:i:s");
		return $vin->save();
	}
	
	public function getVin()
	{
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:user_id';
		$criteria->params=array(':user_id'=>UserIdentity::getProperty('id'));
		$criteria->order='data_requested DESC';
		$items=VinRequest::model()->findAll($criteria);
		
		return $items;
	}
}

?>