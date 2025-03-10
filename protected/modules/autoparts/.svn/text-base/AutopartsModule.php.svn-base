<?php

class AutopartsModule extends GlobalModule{
	
	
	public $access=array(
	'index'=>array('root','admin','manager','client','user'),
	'result'=>array('root','admin','manager','client','user'),
	'request'=>array('root','admin','manager','client','user'),
	'list'=>array('root','admin','manager','client','user')
	);
	
	public function init()
    {
        parent::init();

        $this->setImport(array(
            'autoparts.components.*',
        ));
    }
	
}

?>