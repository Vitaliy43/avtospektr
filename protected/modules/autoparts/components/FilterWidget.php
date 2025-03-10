<?php

class FilterWidget extends GlobalFilterWidget
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
public $type_client_filter;

	public function run()
		{
		
		if(empty($this->user_id))
			$this->user_id=UserIdentity::getProperty('id');
		$role=UserIdentity::getProperty('role');
		$this->type_date='Дата запроса';
		$this->hidden_filter=true;
			
		$data['years']=Vin::years_output();
		$data['brands']=Vin::get_brands();
		foreach($this->getController()->tables as $table){
			$data[$table]=Vin::get_vin($table);
		}
		
		if($role=='admin' or $role=='root' or $role=='manager'){
			$users=Users::model()->getAll();
			if(count($users)>0)
				$clients=$this->getController()->clients;
			
		}
		
		
		if($role=='client' or $role=='user')
			$this->render('vin_client',array('data'=>$data));
		else
			$this->render('vin_admin',array('data'=>$data,'clients'=>$clients));

		}

}

?>