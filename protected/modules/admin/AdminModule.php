<?php



class AdminModule extends GlobalModule{

	public $prefix_title = 'Админка';
	
	public $access=array(
	'index'=>array('root','admin','manager'),
	'status'=>array('root','admin','manager'),
	'archive'=>array('root','admin','manager'),
	'submenu'=>array('root','admin','manager'),
	'document'=>array('root','admin','manager'),
	'delete'=>array('root','admin'),
	'store'=>array('root','admin'),
	'sales'=>array('root','admin'),
	'statistic'=>array('root','admin'),
	'balance'=>array('root','admin'),
	'reports'=>array('root','admin'),
	'payments'=>array('root','admin'),
	'edit'=>array('root','admin'),
	'add'=>array('root','admin'),
	'import'=>array('root','admin','manager'),
	'structure'=>array('root','admin'),
	'ship'=>array('root','admin'),
	'content'=>array('root','admin'),
	'menu'=>array('root','admin'),
	'addpoint'=>array('root','admin'),
	'editpoint'=>array('root','admin'),
	'pricegroups'=>array('root'),
	'purchasepoints'=>array('root'),
	'setcars'=>array('root'),
	'setpricing'=>array('root','admin'),
	'removemarkup'=>array('root','admin'),
	'firm'=>array('root')
	);
	
	
	public $exceptions_access=array(
	'finance'=>array('admin'=>array('statistic','pricegroups'))
	
	);

	public function init()
    {
        parent::init();

        $this->setImport(array(
            'admin.components.*',
			'autoparts.models.FirmSettings'
        ));
    }
	
	
	
	

	
}

?>