<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
	
<h2>Товары для выдачи</h2>
<?php if(count($clients)>0):?>
<table width="98%" class="info_table" cellpadding="3" cellspacing="3" style="margin-top:10px;">
<tr>
<th>Заказчик</th>
<th>Список запчастей</th>
<th>Сумма со скидкой, руб.</th>
<th>Действия</th>
</tr>
<?php 
 $last_count=count($clients)-1;
 $counter=0;
foreach($clients as $client):

 	$style='';
?>
<tr id="store_<?php echo $client['id'];?>">
	<td style="<?php echo $style;?>"><?php echo $client['fio'];?></td>
	<td style="<?php echo $style;?>" class="link_info" onclick="show_sale('<?php echo SITE_PATH.$this->module->id.'/option/get';?>','<?php echo $client['id'];?>','<?php echo $sum_clients[$client['id']]*1;?>')" id="show_sale_<?php echo $client['id'];?>" nowrap=""><span>Открыть</span></td>
	<td style="<?php echo $style;?>"><?php echo CPrice::getMoneyFormat($sum_clients[$client['id']]);?></td>
	<td nowrap="" style="<?php echo $style;?>" class="store_buttons" >
	<a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/ship?client_id='.$client['id'];?>" onclick="ship_product(this.href,'<?php echo $client['id'];?>');return false;"><span>Выдать товары</span></a>&nbsp;
	<a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/store?client_id='.$client['id'];?>" onclick="ajax_link(this.href);return false;"><span>Снять с выдачи</span></a>
	</td>
</tr>
<?php 
$counter++;
endforeach;
?>
</table>
<?php else:

	echo '<div class="no_results">Раздел пуст</div>';

endif;?>
