<style type="text/css">
#easyTooltip{
	padding:5px 10px;
	border:1px solid #195fa4;
	background:#195fa4 url(/images/bg.gif) repeat-x;
	color:#fff;
	}

</style>

<script type="text/javascript">

status_colors=new Array();

<?php foreach($statuses as $status):?>
	
status_colors['<?php echo $status->id;?>']='<?php echo $status->color;?>';

<?php endforeach;?>

$(function(){
$(".link_info").tipTip();
});
</script>

<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2>Статус заказов</h2>
<div class="filter">

<?php
if(isset($_POST['flag_filter']) or count($orders)>0):
 $this->Widget('application.modules.admin.components.FilterWidget',array('current_url'=>$this->getRoute(),'action_view'=>$this->id,'type_date'=>$this->module->type_date[$this->getAction()->getId()],'num_items'=>count($orders),'current_model'=>'OrdersStatus'));
 endif;

?>
</div>
<div class="pager">
<?php $this->Widget('application.components.PagerWidget',array('pages'=>$pages,'cssFile'=>$this->css_file_pager,'page_size'=>$this->page_size,'current_route'=>$this->getRoute(),'pager_place'=>'up','is_filter'=>1));?>
</div>

<?php if(count($orders)>0):?>

<table width="98%" class="info_table" cellpadding="0" cellspacing="0">
<tr><th>№ заказа </th><th>Заказчик</th><th>Код детали</th><th>Производитель</th>
 <th>Описание</th><th>Цена</th><th>Кол-во</th><th>Сумма, руб</th><th>Поставщик</th><th>Срок,д.</th><th>Статус</th>
<th >Дата статуса</th><th></th>
 </tr>
  <?php 
 
 $last_count=count($orders)-1;
 $counter=0;
 
 ?>
 <?php foreach($orders as $order):
 
 
 	$style='';
	
	if(isset($order->old_id))	{
	$order_id='B-'.$order->old_id;
}
else{
	$order_id='A-'.$order->id;
}
 
 ?>

 <tr style="background:#<?php echo $order->status->color;?>" id="row_<?php echo $order->id;?>">
 	<td style="<?php echo $style;?>" id="order_id_<?php echo $order->id;?>"><?php echo $order_id;?></td>
	<td style="<?php echo $style;?>"><?php echo $order->user->fio;?></td>
	<td style="<?php echo $style;?>font-size:10px;"><?php echo $order->number;?></td>
	<td style="<?php echo $style;?>font-size:10px;"><?php echo $order->manufacturer;?></td>
 	<td style="<?php echo $style;?>" class="link_info" title="<?php echo $order->info;?>">Смотреть</td>
 	<td style="<?php echo $style;?>"><?php echo CPrice::getMoneyFormat($order->price_client);?></td>
	<td style="<?php echo $style;?>"><?php echo $order->quantity;?></td>
 	<td style="<?php echo $style;?>"><?php echo CPrice::getMoneyFormat($order->sum_client);?></td>
	<td style="<?php echo $style;?>"><?php echo $order->distributor->name;?></td>
	<td><?php echo $order->period_min.'-'.$order->period_max;?></td>
	<td style="<?php echo $style;?>" id="container_status_<?php echo $order->id;?>">
	<input type="hidden" id="current_status" value="<?php echo $order->status->id;?>" />
	<?php 
	
	echo CHtml::dropDownList('statuses',$order->status->id,Utility::createListStatuses($statuses,$status_groups,$order->status->id),array('id'=>'status_'.$order->id,'class'=>'list_statuses','onchange'=>"change_status('$order->id','".$this->module->id."','".SITE_PATH."','".$order->distributor->name."');",'style'=>'background: #'.$order->status->color));
	?>
	</td>
	<td style="<?php echo $style;?>" id="data_order_<?php echo $order->id;?>" nowrap=""><?php echo CTime::change_show_data($order->data_modified);?></td>
	<td style="<?php echo $style;?>">
	<?php if(UserIdentity::getProperty('role')=='admin' or UserIdentity::getProperty('role')=='root'):?>
	<a href="<?php echo SITE_PATH.$this->module->id.'/option/delete';?>" onclick="delete_order(this,'<?php echo $order->id;?>','<?php echo SITE_PATH.$this->getRoute();?>');return false;" title="Удалить заказ"><img src="/images/<?php echo Yii::app()->theme->name.'/icon_delete.png';?>" width="8" height="8"/></a>
	<?php endif;?>
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
