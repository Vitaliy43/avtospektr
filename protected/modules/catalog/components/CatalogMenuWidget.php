<?php

class CatalogMenuWidget extends CWidget {
	
	
	
	public function run(){
		
		$items=Items::model()->findAll(array(
		'select'=>'*',
		'condition'=>'parent_id=:id',
		'params'=>array(':id'=>0),
		'order'=>'position'
		));
		
		if(isset($_REQUEST['item_id'])){
			
			$buffer_parent_item=Items::model()->getItemsLinkTree($_REQUEST['item_id']);
			ksort(Items::model()->tree);
			Items::model()->getItemsFromTree();
			
			$parent_item=array_shift(Items::model()->tree);
			$sub_items=Items::model()->items;
			
		}
		else{
			$sub_items=array();
			$parent_item=0;
		}
		if(UserIdentity::getProperty('role')=='root' or UserIdentity::getProperty('role')=='admin'){
			$enable_edit=true;
		}
		else{
			$enable_edit=false;
		}
		
		$this->render('catalog_menu',array('items'=>$items,'parent_item'=>$parent_item,'sub_items'=>$sub_items,'enable_edit'=>$enable_edit));
		
	}
	

	
}

?>