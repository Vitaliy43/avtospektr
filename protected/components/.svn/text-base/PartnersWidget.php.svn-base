<?php

class PartnersWidget extends CWidget {
	
	
	public $bacauto_path = 'http://bacauto.vit/';
	
	public function run(){
	
		$partners = $this->get_partners();
		
		
		$this->render('partners',array('partners' => $partners));
	}
	
	
	protected function get_partners(){
		
		$partners = Yii::app()->db->createCommand(array(
    	'select' => '*',
    	'from' => 'partners',
		'order' => 'position'
				
	))->queryAll();
	
	
	return $partners;
		
	}
	
}

?>