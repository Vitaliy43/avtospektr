<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2><?php echo $this->section_header.' для '.UserIdentity::getProperty('fio');?></h2>

<div class="filter">

<?php
if(isset($_POST['flag_filter']) or count($orders)>0):
 $this->Widget('application.modules.client.components.FilterWidget',array('current_url'=>$this->getRoute(),'action_view'=>$this->id,'type_date'=>$this->module->type_date[$this->getAction()->getId()],'num_items'=>count($orders),'current_model'=>'OrdersStatus'));
 endif;

?>
</div>
<div class="pager">
<?php $this->Widget('application.components.PagerWidget',array('pages'=>$pages,'cssFile'=>$this->css_file_pager,'page_size'=>$this->page_size,'current_route'=>$this->getRoute(),'pager_place'=>'up','is_filter'=>1));?>
</div>
<div id="links_other_pages" style="margin-bottom:15px;margin-left:5px;">
<span><a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/archive';?>" style="text-decoration:underline;" onclick="link_to(this);return false;">Архив заказов</a></span>
<span style="margin-left:10px;"><a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/sales';?>" style="text-decoration:underline;" onclick="link_to(this);return false;">Архив покупок</a></span>
</div>
<?php if(count($orders)>0):?>

<table width="99%" class="info_table" cellpadding="0" cellspacing="0">
<tr><th>№ заказа</th><th>Код детали</th><th>Производитель</th>
<th>Описание</th><th>Цена</th><th>Кол-во</th><th>Сумма, руб.</th><th>Срок,д.</th><th>Статус</th>
<th>
 Дата заказа</th>
 <th>Дата статуса</th>
 <th>Комментарий</th>
 </tr>
  <?php 
 
 $last_count=count($orders)-1;
 $counter=0;
 
 ?>
 <?php foreach($orders as $order):
 
 	if($last_count==$counter)
 		$style='border-bottom: 1px solid #bde0a3;';
 	else
 		$style='';
	
	if(isset($order->old_id))	{
	$order_id='B-'.$order->old_id;
}
else{
	$order_id='A-'.$order->id;
}
 
 ?>

 <tr style="background:#<?php echo $order->status->color;?>">
 	<td style="<?php echo $style;?>"><?php echo $order_id;?></td>
	<td style="<?php echo $style;?>"><?php echo $order->number;?></td>
	<td style="<?php echo $style;?>"><?php echo $order->manufacturer;?></td>
 	<td style="<?php echo $style;?>"><?php echo $order->info;?></td>
	<td style="<?php echo $style;?>"><?php echo CPrice::getMoneyFormat($order->price_client);?></td>

	<td style="<?php echo $style;?>"><?php echo $order->quantity;?></td>
	<td style="<?php echo $style;?>"><?php echo CPrice::getMoneyFormat($order->sum_client);?></td>
	<td style="<?php echo $style;?>"><?php echo $order->period_min.'-'.$order->period_max;?> </td>
	<?php
	
	if($order->status->show_status=='Отправить на выдачу')
		$show_status='Готов к выдаче';
	else
		$show_status=$order->status->show_status;
	
	?>
	<td style="<?php echo $style;?>"><?php  echo $show_status;?></td>
	<td style="<?php echo $style;?>"><?php echo CTime::change_show_data($order->data_waiting);?></td>
	<td style="<?php echo $style;?>"><?php echo CTime::change_show_data($order->data_modified);?></td>
	<td style="<?php echo $style;?>;border-right: 1px solid #bde0a3;">
		<?php if($order->comment) echo $order->comment;?>
	</td>

 </tr>
 
 
 <?php 
 $counter++;
 endforeach;?>
</table>


<?php else:


if(isset($_POST['flag_filter'])){
	echo '<div class="no_results">Поиск не дал результатов</div>';
}
else{
	echo '<div class="no_results">Раздел пуст</div>';

}


endif;?>
