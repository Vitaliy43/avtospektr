<?php

class SearchResult extends Model
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
			return 'search_result';		
		
	}
	
	public function countBrands($search_code)
	{
		$user_id=UserIdentity::getProperty('id');
		if(UserIdentity::getProperty('role'))
			$sql="SELECT COUNT(*) AS num FROM ".$this->tableName()." WHERE user_id = ".$user_id;
		else
			$sql="SELECT COUNT(*) AS num FROM search_result_guests WHERE ip = '".$_SERVER['REMOTE_ADDR']."'";

		$res=Yii::app()->db->createCommand($sql)->queryRow();
		return $res['num'];
	}
	
	public function getBrands($search_code)
	{
		$user_id=UserIdentity::getProperty('id');
		if(isset($_REQUEST['CrossType'])):
			if(UserIdentity::getProperty('role'))
				$sql="SELECT DISTINCT manufacturer AS brand, (SELECT COUNT(*) from ".$this->tableName()." WHERE manufacturer = brand AND user_id = ".$user_id.") aS num FROM ".$this->tableName()." WHERE user_id = ".$user_id." ORDER BY brand";
			else
				$sql="SELECT DISTINCT manufacturer AS brand, (SELECT COUNT(*) from search_result_guests WHERE manufacturer = brand AND ip = '".$_SERVER['REMOTE_ADDR']."') aS num FROM search_result_guests WHERE ip = '".$_SERVER['REMOTE_ADDR']."' ORDER BY brand";
		$res=Yii::app()->db->createCommand($sql)->queryAll();	
		
		else:
			if(UserIdentity::getProperty('role')){
				$res=Yii::app()->db->createCommand(array(
    			'select'=>'manufacturer',
				'distinct'=>true,
    			'from'=>$this->tableName(),
				'where'=>'user_id=:user_id AND number=:number',
				'params'=>array(':user_id'=>UserIdentity::getProperty('id'),':number'=>$search_code),
				'order'=>'manufacturer'	
				))->queryAll();
				
			}
			else{
				$res=Yii::app()->db->createCommand(array(
    			'select'=>'manufacturer',
				'distinct'=>true,
    			'from'=>'search_result_guests',
				'where'=>'ip=:ip AND number=:number',
				'params'=>array(':ip'=>$_SERVER['REMOTE_ADDR'],':number'=>$search_code),
				'order'=>'manufacturer'	
				))->queryAll();
				
			}
			
		
		endif;
		
		return $res;
	}
	
	public function getNumbers()
	{
		
		$res=Yii::app()->db->createCommand(array(
    	'select'=>'number',
		'distinct'=>true,
    	'from'=>$this->tableName(),
		'where'=>'user_id=:user_id',
		'params'=>array(':user_id'=>UserIdentity::getProperty('id')),
		'order'=>'number'	
		))->queryAll();
		
		return $res;
	}
	
	public function search($condition,$params,$order)
	{
		if(UserIdentity::getProperty('role')){
			$res=Yii::app()->db->createCommand(array(
    		'select'=>'*',
    		'from'=>$this->tableName(),
			'where'=>$condition,
			'params'=>$params,
			'order'=>$order	
			))->queryAll();
		}
		else{
			$res=Yii::app()->db->createCommand(array(
    		'select'=>'*',
    		'from'=>'search_result_guests',
			'where'=>$condition,
			'params'=>$params,
			'order'=>$order	
			))->queryAll();
		}
		
		
		return $res;
	}
	
	public function number_sorting($number)
	{
	    $array=array();

		if(UserIdentity::getProperty('role')){
			
			$res=Yii::app()->db->createCommand(array(
    		'select'=>'number',
			'distinct'=>true,
    		'from'=>$this->tableName(),
			'where'=>'number!=:number AND user_id=:user_id',
			'params'=>array(':number'=>$number,':user_id'=>UserIdentity::getProperty('id')),
			'order'=>'number'
			))->queryAll();
		}
		else{
			
			$res=Yii::app()->db->createCommand(array(
    		'select'=>'number',
			'distinct'=>true,
    		'from'=>'search_result_guests',
			'where'=>'number!=:number AND ip=:ip',
			'params'=>array(':number'=>$number,':ip'=>$_SERVER['REMOTE_ADDR']),
			'order'=>'number'
			))->queryAll();
		}
		

        foreach($res as $elem):

         $curr_number=$elem['number'];              

			if(UserIdentity::getProperty('role')){
				$buffer2=Yii::app()->db->createCommand(array(
    			'select'=>'*',
    			'from'=>$this->tableName(),
				'where'=>'number=:number AND user_id=:user_id',
				'params'=>array(':number'=>$curr_number,':user_id'=>UserIdentity::getProperty('id')),
				'order'=>'price_client'
				))->queryAll();
				
			}
			else{
				
				$buffer2=Yii::app()->db->createCommand(array(
    			'select'=>'*',
    			'from'=>'search_result_guests',
				'where'=>'number=:number AND ip=:ip',
				'params'=>array(':number'=>$curr_number,':ip'=>$_SERVER['REMOTE_ADDR']),
				'order'=>'price_client'
				))->queryAll();
			}
			
             $array=array_merge($array,$buffer2);

           endforeach;             

           return $array;
	}
	
	public function double_sorting($first,$second,$condition,$params)
	{
		 
		 if(UserIdentity::getProperty('role')){
		 	$res=Yii::app()->db->createCommand(array(
    		'select'=>$first,
			'distinct'=>true,
    		'from'=>$this->tableName(),
			'where'=>$condition,
			'params'=>$params,
			'order'=>$first
			))->queryAll();
			
		 }
		 else{
		 	$res=Yii::app()->db->createCommand(array(
    		'select'=>$first,
			'distinct'=>true,
    		'from'=>'search_result_guests',
			'where'=>$condition,
			'params'=>$params,
			'order'=>$first
			))->queryAll();
			
		 }
		 	
            $array=array();

            foreach($res as $elem):

				$curr=$elem[$first];
				
				if(UserIdentity::getProperty('role')){
					$buffer=Yii::app()->db->createCommand(array(
    				'select'=>'*',
    				'from'=>$this->tableName(),
					'where'=>"$first=:$first AND user_id=:user_id",
					'params'=>array(':user_id'=>UserIdentity::getProperty('id'),":$first"=>$curr),
					'order'=>$second
					))->queryAll();
					
				}
				else{
					$buffer=Yii::app()->db->createCommand(array(
    				'select'=>'*',
    				'from'=>'search_result_guests',
					'where'=>"$first=:$first AND ip=:ip",
					'params'=>array(':ip'=>$_SERVER['REMOTE_ADDR'],":$first"=>$curr),
					'order'=>$second
					))->queryAll();
				}
				

				$array=array_merge($array,$buffer);         
                 


             endforeach;

             return $array;
	}
}

?>