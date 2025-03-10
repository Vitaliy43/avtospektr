<style type="text/css">

.edit_block {
	width:100%;
}
.edit_block a {
	text-decoration:underline;
}

#easyTooltip{
	padding:5px 10px;
	border:1px solid #195fa4;
	background:#195fa4 url(/images/bg.gif) repeat-x;
	color:#fff;
	}

</style>

<script type="text/javascript">

$(function(){
$(".link_info").tipTip();
});

</script>
<?php 
if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;
	$last_distributor=$distributors[count($distributors)-1];
	
	?>
	
	<div class="hidden_block">
	<?php if(count($missing_distributors)>0):?>
	<div id="missing_distributors" style="display:none;">
	 <?php
	 echo CHtml::dropDownList('missing_distributors','0',$missing_distributors,array('onchange'=>'set_distributor();','id'=>'select_missing_distributors'));
	 ?>
	</div>
	<div id="container_input_distributor">
	<input id="input_distributor" type="text" class="input_markups">%
	</div>
	<input  type="hidden" id="counter_distributors" name="counter_distributors" value="<?php echo count($missing_distributors)-1;?>"/>
	<input  type="hidden" id="client_id" name="client_id" value="<?php echo $client->id;?>"/>
	<input  type="hidden" id="last_markup" value="<?php echo $last_distributor->id;?>"/>
		<?php endif;?>
</div>
	<div class="edit_block">
	
	<h3 style="margin-top:5px;">Клиент: <?php echo $client->fio;?></h3>
	<form action="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/edit?client_id='.$client->id;?>" method="POST" onsubmit="validate_edit_client(this,'<?php echo $client->id;?>');return false;" id="form_edit_client" style="margin-top:10px;">
	
	<div>Лимит для кредита: <input type="text" value="<?php echo $client->client[0]->limit_credit;?>" id="limit_credit" name="limit_credit"> руб.</div>
	<table width="50%" cellpadding="2" cellspacing="2" style="margin-top:10px;">
	
	<tr>
	<th align="left">
	Поставщик:
	</th>
	<th align="left">Базовая наценка</th>
	<th align="left">Комплексное ценообразование</th>
	
	</tr>
	<?php foreach($distributors as $distributor):?>
	<?php if(isset($distributor->markups[0]->id)):?>
	<?php
	
		$pricing_markups='Ценовые диапазоны:';
	foreach($distributor->markups as $markup){
		if(isset($markup->price_range)){
			$pricing_markups.=' До '.$markup->price_range.' руб. - '.$markup->markup.'% .';
		}
		else{
			$base_markup=$markup->markup;
		}
	}
	
	if($pricing_markups=='Ценовые диапазоны:')
		$pricing_markups='Отсутствует';
	
	?>
	<tr id="row_markup_<?php echo $distributor->id;?>">
	<td><?php echo $distributor->name.': </td><td><input type="text" value="'.$base_markup.'" class="input_markups" name="markup_'.$distributor->id.'" id="markup_'.$distributor->id.'">%</td>';
	?>
	<td id="block_link_<?php echo $distributor->id;?>">
	<?php if($pricing_markups!='Отсутствует'):?>
	<span class="link_info" title="<?php echo $pricing_markups;?>">Смотреть</span>
	<span style="margin-left:5px;">
	<a href="#set_price_range" onclick="set_pricing('<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/setpricing?distributor_id='.$distributor->id.'&edit_markups=1';?>','<?php echo $distributor->id;?>','<?php echo $client->id;?>');return false;" id="set_pricing_<?php echo $distributor->id;?>" class="update">Редактировать</a>
	</span>
	<?php else:?>
	<a href="#set_price_range" onclick="set_pricing('<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/setpricing?distributor_id='.$distributor->id;?>','<?php echo $distributor->id;?>','<?php echo $client->id;?>');return false;" id="set_pricing_<?php echo $distributor->id;?>" class="set">Установить</a>
	<?php endif;?>

	</td>
	</tr>
	<?php endif;?>
	<?php endforeach;?>
	
	</table>
	<?php if(count($missing_distributors)>1):?>
	
 	<div id="add_markup">
	<span onclick="add_markup();">Добавить группу наценок
	</span>
	 
	</div>
	<?php endif;?>
	<div style="margin-top:10px;">
	<input type="submit" value="Изменить" name="update"/>
	<!--button onclick="validate_edit_client('<?php echo $client->id;?>');">Изменить</button-->
	</div>
	</form>
	</div>
	
		 
	 
