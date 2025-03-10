<?php

class SubmenuWidget extends CWidget {
	
public $items=array();
public $parent_item=array();
public $client_items=array();
public $admin_items=array();
public $model_name;
public $type_content;
	
	public function run()
	{
	
		if(UserIdentity::getProperty('role')=='root' or UserIdentity::getProperty('role')=='admin'){
			$enable_edit=true;
		}
		else{
			$enable_edit=false;
		}
		
		$this->render('submenu',array('enable_edit'=>$enable_edit));
	}
	
	
	
	
}

?>