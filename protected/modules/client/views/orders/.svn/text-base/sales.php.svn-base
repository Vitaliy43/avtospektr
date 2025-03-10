<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2><?php echo $this->section_header.' для '.UserIdentity::getProperty('fio');?></h2>
	
	<?php if(count($sales)>0):?>
	<table width="90%" class="info_table" cellpadding="0" cellspacing="0" style="margin-top:20px;">
<tr>
<th>№ покупки</th><th>Дата покупки</th><th>Сумма, руб.</th><th>Список запчастей</th><th style="border-right: 0px;">Остаточное <br>сальдо, руб.</th>
 </tr>
 <?php 
 
 $last_count=count($sales)-1;
 $counter=0;
 
 ?>
<?php foreach($sales as $sale):?>
<?php 
 //if($last_count==$counter)
 //	$style='border-bottom: 0px;';
 //else
 	$style='';
	
?>
<tr>
 <td style="<?php echo $style;?>"><?php echo $sale->id;?></td>
 <td style="<?php echo $style;?>"><?php echo CTime::change_show_data($sale->data_shipping);?></td>
 <td style="<?php echo $style;?>"><?php echo CPrice::getMoneyFormat($sale->sum);?></td>
 <td style="<?php echo $style;?>" class="parts_list" id="list_<?php echo $sale->id;?>>" onclick="load_list_parts('<?php echo $sale->id;?>','<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/archive';?>')">
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
 
	
