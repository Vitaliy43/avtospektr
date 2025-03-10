<?php

class Accesses extends Model
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'accesses';
	}
	
	public function relations()
	{
		return array(
		'distributor'=>array(self::BELONGS_TO,'Distributors','distributor_id')
				
		);
	}
}

?>