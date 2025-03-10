<?php

class PurchasePointWidget extends CWidget
{
	public $bacauto_path = 'http://bacauto.vit/';
	
	public function run(){
	
		$criteria=new CDbCriteria;
		$criteria->condition='deactivated=:deactivated';
		$criteria->params=array(':deactivated'=>0);
		$criteria->order='show_name';
		$buffer=PurchasePoints::model()->findAll($criteria);
		foreach($buffer as $elem){
			$points[$elem['id']]=$elem['show_name'];
		}
		
		$this->render('purchase_points',array('points' => $points,'selected'=>UserIdentity::getPurchasePoint()));
	}
	
	
}

?>