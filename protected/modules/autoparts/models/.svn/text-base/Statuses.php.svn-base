<?php

class Statuses extends CActiveRecord
{

	public $status_groups=array(
	'waiting'=>array(1,2),
	'working'=>array(3,4,5,6,7,8,9,11)
	);

	public function tableName()
	{
		return 'statuses';
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function relations()
	{
		return array(
		'status'=>array(self::HAS_MANY,'OrdersStatus','status_id'),

		);
	}
}

?>