<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2><?php echo $this->section_header.' для '.UserIdentity::getProperty('fio');?></h2>
<div class="filter">

<?php
if(isset($_POST['flag_filter']) or count($items)>0):
 $this->Widget('application.modules.client.components.FilterWidget',array('current_url'=>$this->getRoute(),'action_view'=>$this->id,'type_date'=>$this->module->type_date[$this->getAction()->getId()],'num_items'=>count($items),'current_model'=>'Payments','drop_lists'=>$drop_lists));
 endif;

?>
</div>
<div class="pager">
<?php $this->Widget('application.components.PagerWidget',array('pages'=>$pages,'cssFile'=>$this->css_file_pager,'page_size'=>$this->page_size,'current_route'=>$this->getRoute(),'pager_place'=>'up','is_filter'=>1));?>
</div>
<div id="container_info_table">
<?php if(count($items)>0):?>
<table width="98%" class="info_table" cellpadding="0" cellspacing="1">
<tr><th>№</th><th>Дата</th><th>Операция</th><th>Вид платежа</th><th>Сумма</th><th>Остаточное сальдо</th><th>Примечание</th></tr>
 <?php 
 
 $last_count=count($items)-1;
 $counter=0;
 
 foreach($items as $item):
 ?>
<tr>
 <?php 

 	$style='';
	
?> 
  <td style="<?php echo $style;?>"><?php echo $item->id;?></td>
  <td style="<?php echo $style;?>"><?php echo $item->data;?></td>
  <td style="<?php echo $style;?>"><?php if($item->type_operation=='3') echo 'Зачисление средств'; else echo 'Снятие средств';?></td>
  <td style="<?php echo $style;?>"><?php echo $item->type_payment->show_type;?></td>
  <td style="<?php echo $style;?>"><?php echo $item->sum;?></td>
  <td style="<?php echo $style;?>"><?php if($item->balance=='0') echo 'Нет данных'; else echo $item->balance;?></td>
  <?php
  if($item->annotation=='Продажа')
  		$annotation='Покупка';
  else
  		$annotation=$item->annotation;
  ?>
  <td style="<?php echo $style;?>"><?php echo $annotation;?></td>

 
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

?>
<?php endif;?>
</div>
