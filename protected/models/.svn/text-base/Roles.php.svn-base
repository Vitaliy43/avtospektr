<?php

class Roles extends CActiveRecord
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
		return 'roles';
	}
	
	public function relations()
	{
		return array(
		'distributor_activity'=>array(self::HAS_MANY,'DistributorActivity','user_role_id')
		);
	}
	
}

?>