<?php

class Search extends CApplicationComponent
{
	public static function Result($search_code)
	{
		$manufacturer=$_REQUEST['manufacturer'];
 		$sort=$_REQUEST['sort'];
		$term=0;
		if(isset($_REQUEST['cross']))
 			$cross=$_REQUEST['cross'];
		else
			$cross='';
		
		$cross_result=array();
		if(UserIdentity::getProperty('role')){
			$condition='user_id=:user_id ';
        	$condition_cross='user_id=:user_id ';
			$params[':user_id']=UserIdentity::getProperty('id');
		}
		else{
			$condition='ip=:ip ';
        	$condition_cross='ip=:ip ';
			$params[':ip']=$_SERVER['REMOTE_ADDR'];
		}
		

 		if($term=='0'){
 			$join_term='';
 		}
 		else{
 			$join_term="AND period_max<=:period_max";
			$params[':period_max']=$term;
 		}
 
 		if($manufacturer=='all'){
	 		$join_manufacturer='';
 		}
 		else{
 			$join_manufacturer="AND manufacturer=:manufacturer";
			$params[':manufacturer']=$manufacturer;
 		}
		
		if($sort=='price_client'){

			$condition.="AND number='$search_code' $join_manufacturer $join_term";
			$search_result=SearchResult::model()->search($condition,$params,$sort);

			if($cross=='on'):
				$condition_cross.="AND number!='$search_code' $join_manufacturer $join_term";
				$cross_result=SearchResult::model()->search($condition_cross,$params,$sort);
                
				endif;
			}

			elseif($sort=='manufacturer'){
			
				$condition.="AND number='$search_code' $join_manufacturer $join_term";
				$search_result=SearchResult::model()->search($condition,$params,'price_client');
				

			if($cross=='on')
				$cross_result=SearchResult::model()->number_sorting($search_code);
			}

			else{
 				
				$condition.="AND number=:number $join_manufacturer $join_term";
				$params[':number']=$search_code;
				
				$search_result=SearchResult::model()->double_sorting($sort,'price_client',$condition,$params);
				
 			if($cross='on'){
				if(UserIdentity::getProperty('role'))
					$cross_result=SearchResult::model()->double_sorting($sort,'price_client','user_id=:user_id AND number!=:number',array(':user_id'=>UserIdentity::getProperty('id'),':number'=>$search_code));
				else
					$cross_result=SearchResult::model()->double_sorting($sort,'price_client','ip=:ip AND number!=:number',array(':ip'=>$_SERVER['REMOTE_ADDR'],':number'=>$search_code));
			}
					
			}
            			
			return array(
			'search_result'=>$search_result,
			'cross_result'=>$cross_result
			);
}

}

?>