<?php

if($_POST['flag_admin'])
	$type='admin';
else
	$type='client';

$this->Widget('application.modules.autoparts.components.DropTableWidget',array('items'=>$orders,'type'=>$type,'data_shipping'=>CTime::change_show_data($this->data_shipping)));

?>