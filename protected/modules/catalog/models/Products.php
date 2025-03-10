<?php

class Products extends Model
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
		return 'catalog_products';
	}
	
	public function getProductsById($item_id)
	{
		$products=$this->findAll(array(
		'select'=>'*',
		'condition'=>'item_id=:id AND purchase_point_id=:purchase_point_id',
		'params'=>array(':id'=>$item_id,':purchase_point_id'=>UserIdentity::getPurchasePoint()),
		'order'=>'info'
		));
		
		return $products;
	}
}

?>