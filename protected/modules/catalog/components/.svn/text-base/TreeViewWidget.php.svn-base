<?php

class TreeViewWidget extends CWidget
{
	public $items;
	public $parent_id;
	
	public function run()
	{
		$items=Items::model()->findAll(array(
		'select'=>'*',
		'condition'=>'parent_id=:id',
		'params'=>array(':id'=>0),
		'order'=>'position'
		));
		
		$this->render('tree',array('items'=>$items));
	}
}

?>