
<script type="text/javascript">

if($('#formDate1').length>0){
			$("#formDate1").attachDatepicker();
			$("#formDate2").attachDatepicker();
		}
		<?php if(isset($clients) && is_string($clients)):?>
		var clients=['<?php echo $clients;?>'];
		<?php endif;?>
		$(document).ready(function(){
		<?php if(!is_array($clients)):?>
		$("#client").autocomplete(clients);
		<?php endif;?>
		
		});
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
	
<?php }
elseif($action=='sales'){
?>	
#client {
	width:250px;
}
<?php }?>

</style>

<div id="turner_filter">
	<a href="#open_filter" onclick="view_filter();return false;"><?php if($this->hidden_filter and empty($_POST['flag_filter'])) echo 'Показать фильтр &raquo;'; else echo 'Скрыть фильтр &raquo;';?></a>
</div>

<div id="container_filter" <?php if($this->hidden_filter and empty($_POST['flag_filter'])) echo 'style="display:none;"';?>>

<div id="clients_filter">

	<span>
	<?php if(is_array($clients)):
	
	if($this->type_client_filter=='selectbox'):
	
	if(isset($_REQUEST['client_id']) and $_REQUEST['client_id']!=''){
		$selected=$_REQUEST['client_id'];
		 
	}
		
	  else{
	  		$selected='0';
	  }
	  
	else:
	
	 if(isset($_REQUEST['client']) and $_REQUEST['client']!='')
  		$selected=$_REQUEST['client'];
  	  else
  		$selected='all';
	
	endif;
	 
	 
	 
	echo '<span>Клиент&nbsp;</span>';
	echo CHtml::dropDownList('client',$selected,$clients,array('id'=>'client','class'=>'list_clients'));
	else:?>
	Клиент <input type="text" id="client" value="<?php if(isset($_REQUEST['client'])) echo $_REQUEST['client'];?>">
	
	<?php endif;?>
	</span>
</div>
<?php if($action=='status'):?>
<div id="status_filter">
<span>Статусы
<?php 
 if(isset($_REQUEST['status_id']))
  	$selected=$_REQUEST['status_id'];
  else
  	$selected='all';
	
	 echo CHtml::dropDownList('status_id',$selected,$statuses,array('id'=>'status_id'));
?>
</span>
</div>
<?php endif;?>
<?php if($action!='sales'):?>
<div id="distributors_filter">
	<span>
	Поставщики
	 <?php 
	 
	  if(isset($_REQUEST['distributor_id']))
  		$selected=$_REQUEST['distributor_id'];
  	  else
  		$selected='all';
	
	 echo CHtml::dropDownList('distributor',$selected,$distributors,array('id'=>'distributor'));?>
	</span>
</div>
<?php endif;?>
<div id="time_filter">
	<input type="hidden" name="filter" id="flag_filter" value="1"/>
	<span>
		<font id="data_type"><?php echo $this->type_date;?></font>
		От <input id="formDate1" name="data1" type="text" value="<?php if(isset($_POST['date1'])) echo $_POST['date1']; else echo '00.00.0000';?>">
		</span>
	<span>
	&nbsp;&nbsp;До
	<input id="formDate2" name="data2" type="text" value="<?php if(isset($_POST['date2'])) echo $_POST['date2']; else echo '00.00.0000';?>"">
	</span>
</div>
<?php if($action!='sales'):?>
<div id="number_filter">
	Артикул детали
	<input type=text name='number' id="input_number" value="<?php if(isset($_POST['number'])) echo $_POST['number']; else echo '';?>">
	&nbsp;&nbsp;
	Без разделителей&nbsp;<input type=checkbox name="without_dividers" checked="" id="without_dividers" value="<?php if(isset($_POST['without_dividers'])) echo $_POST['without_dividers']; else echo 'On';?>" onclick="check_turner(this.id);">
</div>
<div id="manufacturer_filter">
	Производитель&nbsp;&nbsp;&nbsp;&nbsp;<input type=text name='number' id="manufacturer_number" value="<?php if(isset($_REQUEST['manufacturer'])) echo $_REQUEST['manufacturer']; else echo '';?>"">
	&nbsp;&nbsp;
</div>
<div id="description_filter">
	Описание&nbsp;&nbsp;&nbsp;&nbsp;<input type=text name='description' id="description" value="<?php if(isset($_REQUEST['description'])) echo $_REQUEST['description']; else echo '';?>"">
	&nbsp;&nbsp;
</div>
<?php endif;?>
<div id="submit_filter">
<span>
	<button id="search" onclick="filter('admin_orders','<?php echo SITE_PATH.$this->current_url;?>');">Поиск</button>
</span>
<span>
	<button id="reset" onclick="reset_filter('all','orders');">Сброс</button>
</span>
<span id="container_export">
<?php
$this->Widget('application.components.ExportWidget');
?>
</span>
</div>
</div>