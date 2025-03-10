<?php

class FirmSettings extends Model
{
	public function tableName()
	{
		return 'firm_settings';
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function updateFirm()
	{
		$firm=$this->find();
		$firm->name=$_REQUEST['firm_name'];
		$firm->inn=$_REQUEST['inn'];
		$firm->banking_details=$_REQUEST['banking_details'];
		$firm->main_address=$_REQUEST['main_address'];
		$firm->main_telephone=$_REQUEST['main_telephone'];
		return $firm->save();
	}
}

?>