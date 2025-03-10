<?php

class CarsWidget extends CWidget
{
	public $path='/site/auto';
	
	public function run(){
	
		$cars=Cars::model()->findAll();
		
		$this->render('cars',array('cars' => $cars));
	}
}

?>