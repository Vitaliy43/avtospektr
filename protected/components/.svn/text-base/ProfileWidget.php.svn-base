<?php

class ProfileWidget extends CWidget {
	
public $model_name;	
public $type_profile;
	
public $action;
	
	public function run()
	{
			
		$this->model_name=ucfirst($this->model_name).'Items';
		
		$items=CActiveRecord::model($this->model_name)->getItems();
		
		
		$items=UserIdentity::SetPermissionsItems($items,'profile_menu');
		$num_in_basket=Basket::model()->count('user_id=:user_id',array(':user_id'=>UserIdentity::getProperty('id')));
		 
		
		foreach($items as $item){
			
			if($this->action==$item->name){
				
				$sub_items=CActiveRecord::model($this->model_name)->getItems($item->id);
				$parent_item=$item;
				break;
			}
		}
		if(isset($sub_items) and isset($parent_item))
			$this->render('profile',array('fio'=>UserIdentity::getProperty('fio'),'items'=>$items,'role'=>UserIdentity::getProperty('role'),'sub_items'=>$sub_items,'parent_item'=>$parent_item,'num_in_basket'=>$num_in_basket));
		else
			$this->render('profile',array('fio'=>UserIdentity::getProperty('fio'),'items'=>$items,'role'=>UserIdentity::getProperty('role'),'num_in_basket'=>$num_in_basket));
		
		
		
	}
	
	
	
	
}

?>