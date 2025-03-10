<?php

class FilterWidget extends CWidget
{

public $sort;
public $current_url;
public $action_view;
public $type_date;
public $num_items;
public $hidden_filter=false;
public $current_model;
public $user_id;
public $drop_lists;
	
	public function run()
	{
		
		
		if(empty($this->user_id))
			$this->user_id=UserIdentity::getProperty('id');
			
		$this->CountItemsForFilter();
		$action=$this->getController()->getAction()->getId();
		if($this->action_view=='orders' and $action=='status'){
			$buffer_statuses=Statuses::model()->findAll();
			$statuses=CArray::arrayFromObjects($buffer_statuses,'id','show_status');
			
			$statuses=CArray::delete_index($statuses,array(count($statuses),count($statuses)-1),true);
			$statuses['all']='Все';
			$data['statuses']=$statuses;
		}
		else{
			$data=array();
		}
	
		$this->render($this->action_view,$data);
	}
	
	protected function CountItemsForFilter()
	{
	
		$config_count_items=Config::model()->item('page_size',$this->user_id,CActiveRecord::model($this->current_model)->tableName());
		if(empty($config_page_size))
			$config_count_items=Config::model()->item('page_size',1,CActiveRecord::model($this->current_model)->tableName());
			
			if($this->num_items<$config_count_items)
				$this->hidden_filter=true;
	}
	
	
	
		
}

?>