<?php

class NewsWidget extends CWidget {
	
	
	public $bacauto_path = 'http://bacauto.vit/';
	
	public function run(){
	
		$data = $this->get_news();
		
		
		$this->render('news',array('data' => $data, 'bacauto_path' => $this->bacauto_path));
	}
	
	
	protected function get_news(){
		
		$news = Yii::app()->db->createCommand(array(
    	'select' => '*',
    	'from' => 'bacauto.modul_news',
		'order' => 'date desc',
		'limit' => '2',
		'offset' => '0'
			
	))->queryAll();
	
	
	return $news;
		
	}
	
}

?>