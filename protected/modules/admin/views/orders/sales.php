<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2><?php echo $this->section_header;?></h2>
	
	<?php if(count($sales)>0):?>
	<div class="filter">

<?php
if(isset($_POST['flag_filter']) or count($sales)>0):
 $this->Widget('application.modules.admin.components.FilterWidget',array('current_url'=>$this->getRoute(),'action_view'=>$this->id,'type_date'=>$this->module->type_date[$this->getAction()->getId()],'num_items'=>count($sales),'current_model'=>'OrdersSales'));
 //$this->Widget('application.modules.admin.components.FilterWidget',array('current_url'=>$this->getRoute(),'action_view'=>$this->id,'type_date'=>$this->module->type_date[$this->getAction()->getId()]));
 endif;

?>
</div>
	<div class="pager">
<?php $this->Widget('application.components.PagerWidget',array('pages'=>$pages,'cssFile'=>$this->css_file_pager,'page_size'=>$this->page_size,'current_route'=>$this->getRoute(),'pager_place'=>'up','is_filter'=>1));?>
</div>
	<table width="98%" class="info_table" cellpadding="0" cellspacing="0">
<tr>
<th>№ продажи</th><th>Дата продажи</th><th>Покупатель</th><th>Сумма, руб.</th><th>Список запчастей</th><th style="border-right: 0px;">Остаточное <br>сальдо, руб.</th>
 </tr>
 <?php 
 
 $last_count=count($sales)-1;
 $counter=0;
 
 ?>
<?php foreach($sales as $sale):?>
<?php 
 
 
 	$style='';
	
?>
<tr>
 <td style="<?php echo $style;?>"><?php echo $sale->id;?></td>
  <td style="<?php echo $style;?>"><?php echo CTime::change_show_data($sale->data_shipping);?></td>
 <td style="<?php echo $style;?>"><?php echo $sale->user->fio;?></td>
 <td style="<?php echo $style;?>"><?php echo CPrice::getMoneyFormat($sale->sum);?></td>
 <input type="hidden" id="flag_admin" value="1">
 <td style="<?php echo $style;?>" class="parts_list" id="list_<?php echo $sale->id;?>" onclick="load_list_parts('<?php echo $sale->id;?>','<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/archive';?>')" nowrap="">
 Показать
 <div class="partshidden_list" id="hiddenlist_<?php echo $sale->id;?>">
 <?php $this->Widget('application.modules.autoparts.components.DropTableWidget',array('type'=>'client','items'=>array()));
 
 ?>
 </div>
 </td>
 <td style="<?php echo $style;?>">
 <?php if($sale->balance)
 			echo CPrice::getMoneyFormat($sale->balance);
		else
			echo 'Нет данных';
?>
 </td>

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
 
	
