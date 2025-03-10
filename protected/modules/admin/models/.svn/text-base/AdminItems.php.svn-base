<?php

class AdminItems extends ItemsTree
{

	public $childs=array();


		public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'admin_items';
	}
	
	
	
	
	public function getItemName($name){
	
			$item=$this->find(array(
			'select'=>'show_name',
			'condition'=>'name=:name',
			'params'=>array(':name'=>$name)
			
			)
			);
			
			return $item->show_name;
			
		}
	
}

?>