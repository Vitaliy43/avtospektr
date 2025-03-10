<?php

class ClientItems extends ItemsTree
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
		return 'client_items';
	}
	
	public function getIdByName($name)
	{
			$item=$this->find(array(
			'select'=>'id',
			'condition'=>'name=:name',
			'params'=>array(':name'=>$name)
			
			)
			);
			
			return $item->id;
	}
	
	
	public function getItemName($name,$section=null){
	
		if($section){
			$item=$this->find(array(
			'select'=>'show_name',
			'condition'=>'name=:name AND parent_id=:parent_id',
			'params'=>array(':name'=>$name,':parent_id'=>$this->getIdByName($section))
			
			)
			);
		}
		else{
			$item=$this->find(array(
			'select'=>'show_name',
			'condition'=>'name=:name',
			'params'=>array(':name'=>$name)
			
			)
			);
		}
			
			
			return $item->show_name;
			
		}
	
}

?>