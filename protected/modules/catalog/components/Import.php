<?php

Yii::import('application.modules.catalog.models.Items');
Yii::import('application.modules.catalog.models.Products');

class Import extends CApplicationComponent
{
	public $path_1c_import;
	public $message_error;
	public $header='магазин "Автоспектр"';
	public $fields=array(
	4=>'number',
	5=>'number_of_sales',
	6=>'sum',
	7=>'price_retail',
	8=>'measure_sales'
	);

	protected function init_path($type)
	{
			
		if($type=='xls'){
			$this->path_1c_import=REAL_PATH.'/uploads/import/'.UserIdentity::getPurchasePoint().'.xls';
		}
		
	}
	
	public function importCatalog()
	{
	
	if($_POST['type_source']=='xls'){
		
		$this->init_path('xls');
		if(isset($_POST['check_file'])){
			$this->checkFileCatalog('xls');
			if($this->message_error!='0')
				return $this->message_error;

		}
		if($_POST['type_import']=='update'){
			$command = Yii::app()->db->createCommand();
			$command->delete(Products::model()->tableName(),'purchase_point_id=:purchase_point_id',array(':purchase_point_id'=>UserIdentity::getPurchasePoint()));
			$command->delete('self_parts','purchase_point_id=:purchase_point_id',array(':purchase_point_id'=>UserIdentity::getPurchasePoint()));
			
		}
			
		$this->message_error=$this->importXls();
		
				return $this->message_error;
	}
	}
	
	public function checkFileCatalog($type)
	{
		$path_name='path_1c_import';
		$file=$this->path_1c_import;
		if (file_exists($file)) {
		$data_changed=date ("Y-m-d H:i:s", filemtime($file));
		$differ=mktime()-CTime::human_to_unix($data_changed);
		 if(!CTime::differ_time(CTime::human_to_unix($data_changed),mktime(),'day'))
		 	$this->message_error='Каталог обновлялся менее дня назад!';
		else
			$this->message_error='0';
}
		
	}
	
	protected function importXls()
	{
		Yii::import('application.vendors.Spreadsheet_Excel_Reader');
		$data=new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding(Yii::app()->charset);
		$data->read($this->path_1c_import);
		$buffer_keys=array_keys($this->fields);
		$flag_begin=false;
		$item_id=0;
		$fields=Products::model()->getMetaData()->tableSchema->columns;

		$table=Products::model()->tableName();
		$item_names=CArray::arrayFromObjects(Items::model()->findAll(),'id','name');
		$changes=array_flip(Items::model()->changes);
		$temp=Items::model()->getItemByName('Запчасти');
		$ids_parts=Items::model()->getChilds($temp->id);
		$flag_header=false;
		$num_rows=$data->sheets[0]['numRows'];
//		echo '<meta content="text/html; charset=utf-8" http-equiv="Content-Type">';
			
	for ($i = 0; $i <= $data->sheets[0]['numRows']; $i++) {
  	if(isset($data->sheets[0]['cells'][$i][1])):

  	$curr_first_sheet=$data->sheets[0]['cells'][$i][1];
	$curr_first_sheet=str_replace('  ',' ',$curr_first_sheet);
	$buffer_curr_sheet=explode(' ',$curr_first_sheet);
	$spec_curr_first_sheet=mb_strtolower($curr_first_sheet);
	$spec_curr_first_sheet=trim($spec_curr_first_sheet);

	$spec_curr_first_sheet=CString::mb_ucfirst($spec_curr_first_sheet);
		if(in_array($spec_curr_first_sheet,$item_names)){
			$item_id=Items::model()->getItemIdByName($spec_curr_first_sheet);
			$flag_header=true;
		}
			
		else{
			$flag_header=false;
		}
	endif;
		$insert_array=array();
		if($flag_header==false and $item_id!=false):
			
			$command = Yii::app()->db->createCommand();
			$insert_array['id']=null;
			$insert_array['item_id']=$item_id;
			$insert_array['info']=$curr_first_sheet;
			if(isset($data->sheets[0]['cells'][$i][1]))
			
			for($k=min($buffer_keys);$k<max($buffer_keys)+1;$k++){
				
				if(isset($data->sheets[0]['cells'][$i][$k])){
				$buffer_cell=str_replace('  ',' ',$data->sheets[0]['cells'][$i][$k]);
				$buffer_cell=$data->sheets[0]['cells'][$i][$k];
				
				if($k==5 or $k==6 or $k==7){
					$buffer_cell=str_replace(' ','',$buffer_cell);
					$buffer_cell=str_replace(',','',$buffer_cell);
					
					$buffer_cell*=1;
				}
				elseif($k==4){
					$buffer_cell=str_replace('-','',$buffer_cell);
					$buffer_cell=str_replace('.','',$buffer_cell);
				}
				$insert_array[$this->fields[$k]]=$buffer_cell;
			}
			else{
				$insert_array[$this->fields[$k]]=null;
			}
				
			}
			
		echo $insert_array['info'].'<br>';
		echo '<b>'.$insert_array['number'].'</b><br>';
		$insert_array['purchase_point_id']=UserIdentity::getPurchasePoint();
		if(mb_strlen($insert_array['number']) > 100)
				$insert_array['number'] = mb_substr($insert_array['number'],100);
		$command->insert($table,$insert_array);
		
		if(in_array($insert_array['item_id'],$ids_parts)){
		
		
			$command->insert('self_parts',$insert_array);

		}
	
		endif;
		
		

}
	if($_POST['type_import']=='create')
		$state='загружен';
	else
		$state='обновлен';
	
	if(count(Items::model()->unparsed)>0):
		$message='Каталог частично '.$state.'. Информация по следующим разделам не вошла в каталог:';
		$message.=implode(',',Items::model()->unparsed);
		return $message;
	else:
		$loaded_rows=Products::model()->count();
		if($loaded_rows>($num_rows-10)){
//			echo '<br><br><br><br><a href="'.SITE_PATH.'" style="font-size:16px;">Вернуться на сайт</a>';
			return 'Каталог успешно '.$state;

		}
		elseif($loaded_rows>0){
			echo '<br><br><br><br><a href="'.SITE_PATH.'" style="font-size:16px;">Вернуться на сайт</a>';
			return 'Каталог частично '.$state;
		}
		else{
			return 'Ошибка! Каталог не загрузился!';
		}
	 
		 
	endif;


	}

}

?>