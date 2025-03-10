<?php

class Iksora extends WebService {
    
    public $site='auto-iksora.ru';
	private $path="http://ws.auto-iksora.ru/SearchDetails/SearchDetails.asmx/";
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'search_result';
	}
    
   
	 
	function search($search_code){
		
		$access=$this->access($this->site);
		$distributor=Distributors::model()->find('site=:site',array(':site'=>$this->site));

	$url = 'http://ws.auto-iksora.ru/SearchDetails/SearchDetails.asmx';
  
	$link="http://ws.auto-iksora.ru/SearchDetails/SearchDetails.asmx/FindDetails?DetailNumber=$search_code&MakerID=1&ContractID=".$access->id."&Login=".$access->login."&Password=".$access->password;
	
	if (!$this->check_domain_available($url)){
    return false;
    
}
 
	$screen=$this->file_get_contents($link);
	
	if(strpos($screen,'ArrayOfDetailInfo')):

	$info=new SimpleXMLElement($screen);
	
	for($i=0;$i<count($info);$i++):
	
	$fields[$i]['id']='';
	$fields[$i]['manufacturer']=$info->DetailInfo[$i]->{'maker'}->name;
	$fields[$i]['number']=$info->DetailInfo[$i]->detailnumber;
	$fields[$i]['info']=$info->DetailInfo[$i]->detailname;
	$fields[$i]['price']=$info->DetailInfo[$i]->price;
	
	$price_client=$info->DetailInfo[$i]->price;
	$price_client=round($price_client,2);
	if(UserIdentity::getProperty('role'))
		$fields[$i]['price_client']=$price_client;
	
	$period=($info->DetailInfo[$i]->days+$info->DetailInfo[$i]->dayswarranty)/2;
	$period=round($period);
	
	$fields[$i]['period']=$period;
	$fields[$i]['period_min']=$info->DetailInfo[$i]->days;
	$fields[$i]['period_max']=$info->DetailInfo[$i]->dayswarranty;
	$fields[$i]['quantity']=$info->DetailInfo[$i]->quantity;
	$fields[$i]['distributor_id']=$distributor->id;
	$fields[$i]['uniq_id']=$info->DetailInfo[$i]->orderrefernce;
	
	endfor;
	
	endif;
	
	if(empty($fields))
		return FALSE;

	if(empty($_REQUEST['CrossType']))
		$fields=$this->clean_crosses($search_code,$fields);
        
	if(isset($fields) and count($fields)>0){
		$this->insert_base($fields,$search_code,$distributor);
	}
	else{
		return FALSE;
	}
		
			
	}
	
	function clean_crosses($search_code,$fields)
	{
	   
		$arr=array();
		foreach($fields as $field){
			if($field['number']==strtoupper($search_code) or $field['number']==strtolower($search_code))
				$arr[]=$field;
		}

		
		return $arr;
	}
	
	
	function insert_base($result,$search_code,$distributor){
	
	$base_markup=$this->getBaseMarkup($distributor->id,$distributor->add_price_default);
	if(UserIdentity::getProperty('role'))
		$complex_markups=$this->getComplexMarkups($distributor->id);
	else
		$complex_markups=$this->getComplexMarkups($distributor->id,$this->guest_id);	
	$base_add_price=($base_markup/100)+1; 

 list($period_min,$period_max)=explode('/',$distributor->period_delivery);
 

 	  $command = Yii::app()->db->createCommand();

 
 for($i=0;$i<count($result);$i++):

       $period=($result[$i]['period']+$period_min).'/'.($result[$i]['period_max']+$period_max);
      
      $result[$i]['quantity']=str_replace('>','',$result[$i]['quantity']);
      $result[$i]['quantity']=str_replace('=','',$result[$i]['quantity']);
	  	$complex_add_price=$this->getMarkup($complex_markups,$result[$i]['price']);

  	 if($complex_add_price==false)
   		$add_price=$base_add_price;
	 else
		$add_price=$complex_add_price;
     	
	   if(UserIdentity::getProperty('role')){
	   		$fields=array('id'=>null,
	   'manufacturer'=>$result[$i]['manufacturer'],
	   'number'=>CString::cut_spaces($result[$i]['number']),
	   'info'=>$result[$i]['info'],
	   'price'=>round($result[$i]['price']*1,1),
	   'price_client'=>round($result[$i]['price']*$add_price,1),
	   'period'=>$period,
	   'period_min'=>$result[$i]['period_min']+$period_min,
	   'period_max'=>$result[$i]['period_max']+$period_max,
	   'quantity'=>$result[$i]['quantity']*1,
	   'distributor_id'=>$distributor->id*1,
	   'uniq_id'=>$result[$i]['uniq_id'],
	   'user_id'=>UserIdentity::getProperty('id')
	   );
	   
       $command->insert('search_result',$fields);
		
	   }
	   else{
	   	
		$fields=array('id'=>null,
	   'manufacturer'=>$result[$i]['manufacturer'],
	   'number'=>CString::cut_spaces($result[$i]['number']),
	   'info'=>$result[$i]['info'],
	   'price'=>round($result[$i]['price']*1,1),
	   'price_client'=>round($result[$i]['price']*$add_price,1),
	   'period'=>$period,
	   'period_min'=>$result[$i]['period_min']+$period_min,
	   'period_max'=>$result[$i]['period_max']+$period_max,
	   'quantity'=>$result[$i]['quantity']*1,
	   'distributor_id'=>$distributor->id*1,
	   'uniq_id'=>$result[$i]['uniq_id'],
	   'ip'=>$_SERVER['REMOTE_ADDR']
	   );
	   
       $command->insert('search_result_guests',$fields);
		
	   }	
       


endfor;

		
		
	}
	
	
}

?>