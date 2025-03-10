<?php

class Partkom extends WebService {



	public $site='part-kom.ru';
	protected $check_url='http://www.part-kom.ru/webservice/search.php?wsdl';
	
   public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'search_result';
	}
	
	function init($service){
		
		$wsdl="http://www.part-kom.ru/webservice/$service.php?wsdl";
		
		$client = new SoapClient($wsdl);
		return $client;
		
		
	}
	
	function get_orders(){
		
		global $base;
		
		$access=$this->access($this->site);
		
		$client=$this->init('motion');
     
		
		$result=$client->getMotion($access['login'],$access['password']);
        
       
       
		
		if($result)
		mysql_query('truncate partkom_brands');
		
		foreach($result as $res):
		
			array_unshift($res,'');
			
			$base->insert('partkom_brands',$res);
		
		
		endforeach;
		
		
	}
	
	
	function search($search_code){
		
		
        $client=$this->init('search');
		
		$access=$this->access($this->site);
		if (!$this->check_domain_available($this->check_url)){
   			 return false;
  		}
		
	$distributor=Distributors::model()->find('site=:site',array(':site'=>$this->site));

		$base_markup=$this->getBaseMarkup($distributor);
		$complex_markups=$this->getComplexMarkups($distributor);		

        
		if($base_markup)
			$base_add_price=($base_markup/100)+1; 
        else
            $base_add_price=($distributor->add_price_default/100)+1;
		
		$result = $client->findDetail($access['login'], $access['password'],$search_code);
  
        list($period_min,$period_max)=explode('/',$distributor->period_delivery);


 
for($i=0;$i<count($result);$i++):

       $period=($result[$i]['minDeliveryDays']+$period_min).'/'.($result[$i]['maxDeliveryDays']+$period_max);
       $id=$result[$i]['makerId'].'_'.$result[$i]['providerId'];

         $temp=$result[$i]['description'];

      $result[$i]['quantity']=str_replace('>','',$result[$i]['quantity']);

      $uniq_id=$result[$i]['number'].'-'.$result[$i]['makerId'].'-'.$result[$i]['providerId'];

       $base = Yii::app()->db->createCommand();
	   
	    $complex_add_price=$this->getMarkup($complex_markups,$result[$i]['price']);
  	 if($complex_add_price==false)
   		$add_price=$base_add_price;
	 else
		$add_price=$complex_add_price;

       $fields=array(
       'id'=>null,
	   'manufacturer'=>$result[$i]['maker'],
	   'number'=>CString::cut_spaces($result[$i]['number']),
	   'info'=>$result[$i]['description'],
	   'price'=>round($result[$i]['price']*1,1),
	   'price_client'=>round($result[$i]['price']*$add_price,1),
	   'period'=>$period,
	   'period_min'=>$result[$i]['minDeliveryDays']+$period_min,
	   'period_max'=>$result[$i]['maxDeliveryDays']+$period_max,
	   'quantity'=>$result[$i]['quantity'],
	   'distributor_id'=>$distributor->id,
	   'uniq_id'=>$uniq_id,
       'user_id'=>UserIdentity::getProperty('id')
	   );

       $base->insert('search_result',$fields);


endfor;
	
		
	}
	
		
}

?>