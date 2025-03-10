<?php

class PurchasePoints extends Model
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
		return 'purchase_points';
	}
	
	public function relations()
	{
		return array(
		'user'=>array(self::BELONGS_TO,'Users','manager_id')
				
		);
	}

	public function addPoint()
	{
		$point=new PurchasePoints;
		$point->show_name=$_REQUEST['purchase_point_name'];
		$point->name=strtolower(Utility::translit($_REQUEST['purchase_point_name']));
		$point->mark_up=$_REQUEST['purchase_point_markup'];
		$point->add_delivery_time=$_REQUEST['purchase_point_delivery_time'];
		$point->address=$_REQUEST['purchase_point_address'];
		$point->telephone=$_REQUEST['purchase_point_telephone'];
		$point->manager_id=$_REQUEST['manager_id'];
		$point->deactivated=0;
		return $point->save();
	}
	
	public function updatePoint($point_id)
	{
		$point=$this->findByPk($point_id);
		$point->show_name=$_REQUEST['purchase_point_name'];
		$point->name=strtolower(Utility::translit($_REQUEST['purchase_point_name']));
		$point->mark_up=$_REQUEST['purchase_point_markup'];
		$point->add_delivery_time=$_REQUEST['purchase_point_delivery_time'];
		$point->address=$_REQUEST['purchase_point_address'];
		$point->telephone=$_REQUEST['purchase_point_telephone'];
		$point->manager_id=$_REQUEST['manager_id'];
		//$point->deactivated=0;
		return $point->save();
	}
	

}

?>