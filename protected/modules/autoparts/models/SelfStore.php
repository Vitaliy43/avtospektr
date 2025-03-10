<?php

class SelfStore extends WebService
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'catalog_products';
	}
	
	
	
	public function search($codes)
	{
	 
		$command = Yii::app()->db->createCommand();
		foreach($codes as $code):
		$sql="SELECT * FROM `self_parts` WHERE `number`='".$code['number']."'" ;
			$res=Yii::app()->db->createCommand($sql)->queryAll();
		
		if(count($res)>0){
			foreach($res as $elem){
				$info=$elem['info'];
				$buffer=explode(' ',$info);
				if($buffer[count($buffer)-1]==''){
					$manufacturer=$buffer[count($buffer)-2];
				}
				else{
					$manufacturer=$buffer[count($buffer)-1];

				}
				if(count($buffer)>2){
					$temp=CArray::delete_index($buffer,array(0,count($buffer)-1));
					$field_info=implode(' ',$temp);
				}
				else{
					$field_info='';
				}
					
				
				if(isset($elem['price_retail']))
					$price_client=$elem['price_retail'];
				elseif(isset($elem['price_retail_remains']))
					$price_client=$elem['price_retail_remains'];
				
				if(isset($elem['number_of_sales']))
					$quantity=$elem['number_of_sales'];
                    $price=$price_client;
					
				$accesses=$this->access($elem['purchase_point_id'],1);
				$distributor_id=$accesses['distributor_id'];
				
				$fields=array(
				'id'=>null,
   				'manufacturer'=>$manufacturer,
   				'number'=>$code['number'],
   				'info'=>$field_info,
   				'price'=>$price,
   				'price_client'=>$price_client,
   				'period'=>'0/0',
   				'period_min'=>'0',
   				'period_max'=>'0',
   				'quantity'=>$quantity,
   				'distributor_id'=>$distributor_id,
   				'uniq_id'=>'',
   				'user_id'=>UserIdentity::getProperty('id')

   				);
								
				$command->insert('search_result',$fields);
				
				
			}
		}
			
			
		endforeach;
	}
}

?>