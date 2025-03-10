<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2><?php echo $this->section_header;?></h2>
<table cellpadding=2 cellspacing=4 border=0 width="60%">
<th align="left">Клиент</th>
<th>
<?php

if(isset($_POST['client_id'])){
	$selected=$_POST['client_id'];
	
}
else{
	$selected='0';
}

echo CHtml::dropDownList('clients',$selected,$clients,array('id'=>'client_id','class'=>'list_clients','onchange'=>"show_client_balance('".SITE_PATH.$this->module->id.'/'.$this->id.'/'.$this->getAction()->getId()."');return false;"));
?>
</th>
<tr>
<td>Общая сумма</td>
<td style="padding-left:10px;"><?php echo CPrice::getMoneyFormat($balance);?> руб.</td>
</tr>
<tr>
<td>Сумма по заказам, находящимся в работе</td>
<td style="padding-left:10px;"><?php echo CPrice::getMoneyFormat($orders_in_work);?> руб.</td>
</tr>
<tr>
<td>Сумма по заказам, находящимся на складе(выдаче)</td>
<td style="padding-left:10px;"><?php echo CPrice::getMoneyFormat($orders_in_store);?> руб.</td>
</tr>
<tr>
<td>Выданные позиции</td>
<td style="padding-left:10px;"><?php echo CPrice::getMoneyFormat($orders_archive);?> руб.</td>
</tr>
</table>