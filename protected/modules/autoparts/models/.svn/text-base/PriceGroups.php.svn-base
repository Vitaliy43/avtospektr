<?php

class PriceGroups extends CActiveRecord
{
	public function tableName()
	{
		return 'price_groups';
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getAll($sort=''){
	
			$items=$this->findAll(array(
			'select'=>'*',
			'order'=>'amount '.$sort
			
			)
			);
			
			return $items;
			
		}
		
	public function getPriceGroupName($amount)
	{
			$item=$this->find(array(
			'select'=>'name',
			'condition'=>'amount=:amount',
			'params'=>array(':amount'=>$amount)
			)
			);
			return $item->name;
		
	}
	
	public function getPriceGroupByAmount($amount)
	{
		$sql="SELECT * FROM price_groups WHERE amount=(SELECT MIN(amount) FROM price_groups WHERE amount>= ".$amount.')';
			$result=Yii::app()->db->createCommand($sql)->queryAll();
			if(isset($result[0]) && $result[0]){
				return $result[0];

			}
			else{
				$sql="SELECT * FROM price_groups WHERE amount=(SELECT MIN(amount) FROM price_groups)";
				$result=Yii::app()->db->createCommand($sql)->queryAll();
				return $result[0];
			}
	}
	
	public function updatePriceGroup($group_id)
	{
	
		if(empty($_REQUEST['price_group_limit_order']))
			$limit_order=0;
		else
			$limit_order=$_REQUEST['price_group_limit_order'];
			
		if(empty($_REQUEST['price_group_limit_store']))
			$limit_store=0;
		else
			$limit_store=$_REQUEST['price_group_limit_store'];
		
		$price_group=$this->findByPk($group_id);
		$price_group->name=$_REQUEST['price_group_name'];
		$price_group->amount=$_REQUEST['price_group_amount'];
		$price_group->percent=$_REQUEST['price_group_discount'];
		$price_group->limit_for_order=$limit_order;
		$price_group->limit_for_store=$limit_store;
		
		$res=$price_group->save();
		return $res;
	}
	
	public function insertPriceGroup()
	{
	
		if(empty($_REQUEST['price_group_limit_order']))
			$limit_order=0;
		else
			$limit_order=$_REQUEST['price_group_limit_order'];
			
		if(empty($_REQUEST['price_group_limit_store']))
			$limit_store=0;
		else
			$limit_store=$_REQUEST['price_group_limit_store'];
		
		$price_group=new PriceGroups;
		$price_group->name=$_REQUEST['price_group_name'];
		$price_group->amount=$_REQUEST['price_group_amount'];
		$price_group->percent=$_REQUEST['price_group_discount'];
		$price_group->limit_for_order=$limit_order;
		$price_group->limit_for_store=$limit_store;
		
		$res=$price_group->save();
		return $res;
	}
	
	public function validatePriceGroup($group_id=null)
	{
		if($group_id!=null){
			$next_price_group=$this->findByPk($group_id+1);
			$prev_price_group=$this->findByPk($group_id-1);
		}
		else{
			$criteria=new CDbCriteria;
			$criteria->order='id DESC';
			$prev_price_group=$this->find($criteria);
			$next_price_group=null;
		}
		

		if($next_price_group):
			if($next_price_group->amount<=$_REQUEST['price_group_amount'])
				return 1;
		endif;
		if($prev_price_group):
			if($prev_price_group->amount>=$_REQUEST['price_group_amount'])
				return 2;
		endif;
		return 0;
	}
}

?>