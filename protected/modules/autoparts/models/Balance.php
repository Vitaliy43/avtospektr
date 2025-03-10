<?php

class Balance extends CActiveRecord
{
	
	public function tableName()
	{
		return 'balance';
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	 
	 
	 public function getScore($id,$admin=null)
	 {
	 	
	 
	 	if($admin){
			
		$buffer=Yii::app()->db->createCommand(array(
    	'select'=>'sum(score) sum_score',
    	'from'=>'balance',
	))->queryAll();
		return $buffer[0]['sum_score'];
			
		}
			
	 
	 	$score=$this->find(array(
		'select'=>'score',
		'condition'=>'user_id=:id',
		'params'=>array(':id'=>$id)
		
		));
		
		return $score->score;
	 }
	 
	 public function addBalance($user_id)
	 {
	 	$balance=new Balance;
		$balance->user_id=$user_id;
		$balance->score=0;
		$balance->all_output=0;
		return $balance->save();
	 }
}

?>