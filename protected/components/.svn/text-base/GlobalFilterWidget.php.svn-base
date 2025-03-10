<?php

class GlobalFilterWidget extends CWidget
{
	protected function prepareClientList($users,$autocomplete=false)
	{
	
		if($autocomplete):
	
		foreach($users as $user){
		
		if(count($user->user_role)>0 and $user->user_role[0]->role_id==2)
				$arr[]=$user->fio;
	
		}
		
		$str=implode("','",$arr);
		return $str;
		
		else:
		
		$arr['all']='Все';
		
		foreach($users as $user){
		
		if(count($user->user_role)>0 and $user->user_role[0]->role_id==2)
				$arr[$user->id]=$user->fio;

	
		}
		
		
		endif;
		
		return $arr;
		
		
	}
}

?>