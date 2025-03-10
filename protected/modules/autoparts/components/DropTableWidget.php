<?php

class DropTableWidget extends CWidget
{
	public $type;
	public $items;
	public $data_shipping;
	
	public function run()
	{
		
		 $this->render($this->type.'_drop_table');
		
	}
	
}

?>