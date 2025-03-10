
<script type="text/javascript">

if($('#formDate1').length>0){
			$("#formDate1").attachDatepicker();
			$("#formDate2").attachDatepicker();
		}

</script>
<?php

$action=$this->getController()->getAction()->getId();

?>
<style type="text/css">
<?php if($action=='status'){?>

#input_number {
	width:211px;
}	
#manufacturer_number {
	width:212px;
}	
	
<?php }?>
</style>
<div id="turner_filter">
	<a href="#open_filter" onclick="view_filter();return false;"><?php if($this->hidden_filter and empty($_REQUEST['flag_filter'])) echo 'Показать фильтр &raquo;'; else echo 'Скрыть фильтр &raquo;';?></a>
</div>
<div id="container_filter" <?php if($this->hidden_filter and empty($_REQUEST['flag_filter'])) echo 'style="display:none;"';?>>
<div id="clients_filter">

	<span>
	<?php if(is_array($clients)):
	
	
	 if($this->type_client_filter=='selectbox'):
	
	if(isset($_REQUEST['client_id']) and $_REQUEST['client_id']!=''){
		$selected=$_REQUEST['client_id'];
		if(isset($_REQUEST['add_payment']))
			$selected='0';
		 
	}
		
	  else{
	  		$selected='0';
	  }
	  
	else:
	
	 if(isset($_REQUEST['client']) and $_REQUEST['client']!=''){
	 	$selected=$_REQUEST['client'];
		if(isset($_REQUEST['add_payment']))
			$selected='all';
	 }
  		
  	  else{
	  	$selected='all';
	
	  }
	endif;
  		
	echo '<span>Клиент&nbsp;</span>';
	echo CHtml::dropDownList('client',$selected,$clients,array('id'=>'client','class'=>'list_clients'));
	else:?>
	Клиент <input type="text" id="client" value="<?php if(isset($_REQUEST['client'])) echo $_REQUEST['client'];?>">
	
	<?php endif;?>
	</span>
</div>
<div id="time_filter">
	<input type="hidden" name="filter" id="flag_filter" value="1"/>
	<span>
		<font id="data_type"><?php echo $this->type_date;?></font>
		От <input id="formDate1" name="data1" type="text" value="<?php if(isset($_REQUEST['date1'])) echo $_REQUEST['date1']; else echo '00.00.0000';?>">
		</span>
	<span>
	&nbsp;&nbsp;До
	<input id="formDate2" name="data2" type="text" value="<?php if(isset($_REQUEST['date2'])) echo $_REQUEST['date2']; else echo '00.00.0000';?>"">
	</span>
</div>
<div id="number_filter">
	Вид платежа
&nbsp;
<?php 
  
  if(isset($_REQUEST['type_payment']))
  	$selected=$_REQUEST['type_payment'];
  else
  	$selected='0';
  
  echo CHtml::dropDownList('type_payments',$selected,$this->drop_lists['type_payments'],array('id'=>'type_payments'));?>	

</div>
<div id="manufacturer_filter">
	Вид операции
&nbsp;
<?php 
 if(isset($_REQUEST['type_operation'])){
 	$selected=$_REQUEST['type_operation'];
	if(isset($_REQUEST['add_payment']))
			$selected='all';
 }
  	
  else{
  		$selected='all';
  }
  
	
echo CHtml::dropDownList('type_operation',$selected,array('2'=>'Снятие средств','3'=>'Зачисление средств','all'=>'Все'),array('id'=>'type_operation'));?>	
</div>


<div id="submit_filter">
<span>
	<button id="search" onclick="filter('admin_payments','<?php echo SITE_PATH.$this->current_url;?>');">Поиск</button>
</span>
<span>
	<button id="reset" onclick="reset_filter('all','payments');">Сброс</button>
</span>
<span id="container_export">
<?php
$this->Widget('application.components.ExportWidget');
?>
</span>
</div>
</div>