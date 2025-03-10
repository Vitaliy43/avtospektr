
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
<?php
if(Browser::get_browser()=='Presto'):

    ?>


#time_filter #formDate1 {margin-left: 25px;}

    <?php
    endif;

    ?>
</style>
<?php

$action=$this->getController()->getAction()->getId();


?>
<div id="turner_filter">
	<a href="#open_filter" onclick="view_filter();return false;"><?php if($this->hidden_filter and empty($_POST['flag_filter'])) echo 'Показать фильтр &raquo;'; else echo 'Скрыть фильтр &raquo;';?></a>
</div>
<div id="container_filter" <?php if($this->hidden_filter and empty($_POST['flag_filter'])) echo 'style="display:none;"';?>>
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
<div id="number_filter">
	Артикул детали
	<input type=text name='number' id="input_number" value="<?php if(isset($_POST['number'])) echo $_POST['number']; else echo '';?>">
	&nbsp;&nbsp;
	Без разделителей&nbsp;<input type=checkbox name="without_dividers" checked="" id="without_dividers" value="<?php if(isset($_POST['without_dividers'])) echo $_POST['without_dividers']; else echo 'On';?>" onclick="check_turner(this.id);">
</div>
<div id="manufacturer_filter">
	Производитель&nbsp;&nbsp;&nbsp;&nbsp;<input type=text name='number' id="manufacturer_number" value="<?php if(isset($_POST['manufacturer'])) echo $_POST['manufacturer']; else echo '';?>"">
	&nbsp;&nbsp;
</div>
<div id="description_filter">
	Описание&nbsp;&nbsp;&nbsp;&nbsp;<input type=text name='description' id="description" value="<?php if(isset($_POST['description'])) echo $_POST['description']; else echo '';?>"">
	&nbsp;&nbsp;
</div>
<div id="submit_filter">
<span>
	<button id="search" onclick="filter('client_orders','<?php echo SITE_PATH.$this->current_url;?>');">Поиск</button>
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