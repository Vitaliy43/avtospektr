<?php

class Crosses extends Model
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'crosses';
	}
	
	public function getCrosses($items)
	{
		
		
	}
	
	function collect_crosses($search_code,$user_id)
	{
				$command = Yii::app()->db->createCommand();		
		
		$res=Yii::app()->db->createCommand(array(
    	'select'=>'number',
		'distinct'=>true,
    	'from'=>'search_result',
		'where'=>'user_id=:user_id AND number!=:number',
		'params'=>array(':user_id'=>$user_id,':number=>$search_code'),
		))->queryAll();
		
		if(count($res)>0){
		
		 	
			foreach($res as $cross):
			
			$command->insert('crosses',array(null,$cross->number,$search_code));
				
			endforeach;
		}
				
	}
	
	
	
	function cross_from($number)
	{
		
		global $base;
		
		$buffer=$base->select_record('crosses','link_to',"name='$number'");
		
		if($buffer)return $buffer['link_to'];
		
		return false;
		
	}

}

?>