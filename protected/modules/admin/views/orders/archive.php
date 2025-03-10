<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2><?php echo $this->section_header;?></h2>
<div class="filter">

<?php
if(isset($_POST['flag_filter']) or count($orders)>0):
 $this->Widget('application.modules.admin.components.FilterWidget',array('current_url'=>$this->getRoute(),'action_view'=>$this->id,'type_date'=>$this->module->type_date[$this->getAction()->getId()],'num_items'=>count($orders),'current_model'=>'OrdersArchive'));
 endif;

?>
</div>
<div class="pager">
<?php $this->Widget('application.components.PagerWidget',array('pages'=>$pages,'cssFile'=>$this->css_file_pager,'page_size'=>$this->page_size,'current_route'=>$this->getRoute(),'pager_place'=>'up','is_filter'=>1));?>
</div>

<div id="container_info_table">
<?php if(count($orders)>0):?>
<table width="98%" class="info_table" cellpadding="2" cellspacing="0">
<tr><th>№ заказа</th><th>Заказчик</th><th>Код детали</th><th>Производитель</th>
<th>Описание</th><th>Сумма со скидкой, руб.</th><th>Кол-во</th><th>Поставщик</th><th>Дата продажи</th>
 </tr>
 <?php 
 
 $last_count=count($orders)-1;
 $counter=0;
 
 ?>
 <?php foreach($orders as $order):?>
 <tr>
 <?php 

 	$style='';
	
if(isset($order->old_id))	{
	$order_id='B-'.$order->old_id;
}
else{
	$order_id='A-'.$order->id;
}
?>
 <td style="<?php echo $style;?>"><?php echo $order_id;?></td>
 <td style="<?php echo $style;?>"><?php echo $order->user->fio;?></td>
 <td style="<?php echo $style;?>"><?php echo $order->number;?></td>
 <td style="<?php echo $style;?>">
 <?php echo $order->manufacturer;?>
 </td>
 <td style="<?php echo $style;?>"><?php echo $order->info;?></td>
 <td style="<?php echo $style;?>"><?php echo CPrice::getMoneyFormat($order->sum_client);?></td>
 <td style="<?php echo $style;?>"><?php echo $order->quantity;?></td>
 <td style="<?php echo $style;?>"><?php echo $order->distributor->name;?></td>
 <td style="<?php echo $style;?>"><?php echo CTime::change_show_data($order->data_shipping);?></td>
 
 </tr>
 
 <?php 
 $counter++;
 endforeach;
 ?>
</table>
<?php else:
if(isset($_POST['flag_filter'])){
	echo '<div class="no_results">Поиск не дал результатов</div>';
}
else{
	echo '<div class="no_results">Раздел пуст</div>';

}

?>
<?php endif;?>
</div>
<div class="pager">
<?php $this->Widget('application.components.PagerWidget',array('pages'=>$pages,'cssFile'=>$this->css_file_pager,'page_size'=>$this->page_size,'current_route'=>$this->getRoute(),'pager_place'=>'down','is_filter'=>1));?>
</div>