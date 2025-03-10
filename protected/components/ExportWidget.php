<?php

class ExportWidget extends CWidget
{
	public function run(){
			
		$parameters=$this->add_parameters();
		if($parameters!=''){

			$this->render('export',array('parameters'=>$parameters));

		}
		else{
			$this->render('export',array('parameters'=>''));

		}
	}
	
	protected function add_parameters()
	{
		$parameters='';
		
		if(isset($_REQUEST['date1']) and $_REQUEST['date1']!='00.00.0000')
			$parameters.='&date1='.$_REQUEST['date1'];
		if(isset($_REQUEST['date2']) and $_REQUEST['date2']!='00.00.0000')
			$parameters.='&date2='.$_REQUEST['date2'];
		if(isset($_REQUEST['number']) and $_REQUEST['number']!='')
			$parameters.='&number='.$_REQUEST['number'];
		if(isset($_REQUEST['manufacturer']) and $_REQUEST['manufacturer']!='')
			$parameters.='&manufacturer='.$_REQUEST['manufacturer'];
		if(isset($_REQUEST['description']) and $_REQUEST['description']!='')
			$parameters.='&description='.$_REQUEST['description'];
		if(isset($_REQUEST['flag_filter']))
			$parameters.='&flag_filter='.$_REQUEST['flag_filter'];
		if(isset($_REQUEST['without_dividers']))
			$parameters.='&without_dividers='.$_REQUEST['without_dividers'];
		if(isset($_REQUEST['distributor_id']) and $_REQUEST['distributor_id']!=0)
			$parameters.='&distributor_id='.$_REQUEST['distributor_id'];
		if(isset($_REQUEST['client_id']) and $_REQUEST['client_id']!=0)
			$parameters.='&client_id='.$_REQUEST['client_id'];
			
			
		return $parameters;
	}
	
}

?>