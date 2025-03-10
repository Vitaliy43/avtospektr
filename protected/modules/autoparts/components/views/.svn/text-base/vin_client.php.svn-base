
<script type="text/javascript">

if($('#formDate1').length>0){
			$("#formDate1").attachDatepicker();
			$("#formDate2").attachDatepicker();
		}
			
		
		$(document).ready(function(){
//		$("#client").autocomplete(clients);
		
		});
</script>
<?php
$action=$this->getController()->getAction()->getId();
?>
<div id="turner_filter">
	<a href="#open_filter" onclick="view_filter();return false;"><?php if(empty($_POST['flag_filter'])) echo 'Показать фильтр &raquo;'; else echo 'Скрыть фильтр &raquo;';?></a>
</div>
<div id="container_filter" <?php if($this->hidden_filter and empty($_POST['flag_filter'])) echo 'style="display:none;"';?>>
<div id="clients_filter">
Номер VIN<input type=text name='number_vin' id="number_vin" value="<?php if(isset($_POST['number_vin'])) echo $_POST['number_vin']; else echo '';?>" style="width:325px;margin-left:58px;">
	&nbsp;&nbsp;
</div>
<div id="distributors_filter">
	<input type="hidden" name="flag_filter" id="flag_filter" value="<?php if(isset($_REQUEST['flag_filter'])) echo 1; else echo 0;?>"/>
	<span>
		<font id="data_type"><?php echo $this->type_date;?></font>
		От &nbsp;&nbsp;&nbsp;<input id="formDate1" name="data1" type="text" value="<?php if(isset($_POST['date1'])) echo $_POST['date1']; else echo '00.00.0000';?>">
		</span>
	<span>
	&nbsp;&nbsp;До
	<input id="formDate2" name="data2" type="text" value="<?php if(isset($_POST['date2'])) echo $_POST['date2']; else echo '00.00.0000';?>"">
	</span>
</div>
<div id="time_filter">
Модель
<input type=text name='model' id="model" value="<?php if(isset($_POST['model'])) echo $_POST['model']; else echo '';?>" style="width:325px;margin-left:72px;">
</div>
<div id="number_filter">
<?php 
	echo '<span style="margin-right:78px;">Марка&nbsp;</span>';
	
	if(isset($_REQUEST['brand']) and $_REQUEST['brand'])
		$selected=$_REQUEST['brand'];
	else
		$selected='--';
	echo CHtml::dropDownList('brands',$selected,$data['brands'],array('id'=>'brands'));
?>
</div>
<div id="manufacturer_filter">
<?php
	echo '<span style="margin-right:41px;">Год выпуска&nbsp;</span>';
	if(isset($_REQUEST['year']) and $_REQUEST['year'])
		$selected=$_REQUEST['year'];
	else
		$selected='';
	echo CHtml::dropDownList('year',$selected,$data['years'],array('id'=>'year'));

?>
</div>
<div id="description_filter" style="white-space:nowrap;">
	Запчасти<input type=text name='necessary_parts' id="necessary_parts" value="<?php if(isset($_POST['necessary_parts'])) echo $_POST['necessary_parts']; else echo '';?>" style="width:325px;margin-left:63px;">
	&nbsp;&nbsp;
</div>
<div id="submit_filter">
<span>
	<button id="search" onclick="filter('client_vin','<?php echo SITE_PATH.$this->current_url;?>');">Поиск</button>
</span>
<span>
	<button id="reset" onclick="reset_filter_vin('all','orders');">Сброс</button>
</span>
<span id="container_export">
<?php
$this->Widget('application.components.ExportWidget');
?>
</span>
</div>
</div>