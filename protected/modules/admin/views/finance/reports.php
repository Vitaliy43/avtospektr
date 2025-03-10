<script type="text/javascript">


if($('#formDate').length>0){
			$("#formDate").attachDatepicker();
		}	

</script>

<style type="text/css">

#client {width: 250px;}

</style>

<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2><?php echo $this->section_header;?> по платежам и списаниям</h2>
<div class="filter">
<?php
if(isset($_POST['flag_filter']) or count($items)>0):
 $this->Widget('application.modules.admin.components.FilterWidget',array('current_url'=>$this->getRoute(),'action_view'=>$this->id,'type_date'=>$this->module->type_date['payments'],'num_items'=>count($items),'current_model'=>'Payments','drop_lists'=>$drop_lists));
 endif;

?>
</div>
<div class="pager">
<?php $this->Widget('application.components.PagerWidget',array('pages'=>$pages,'cssFile'=>$this->css_file_pager,'page_size'=>$this->page_size,'current_route'=>$this->getRoute(),'pager_place'=>'up','is_filter'=>1));?>
</div>
<?php if(count($items)>0):?>
<div id="container_info_table">
<table width="98%" class="info_table" cellpadding="0" cellspacing="1">
<tr>
<th>№</th><th>Клиент</th><th>Дата</th><th>Операция</th><th>Вид платежа</th><th>Сумма</th>
<th>Баланс</th><th style="border-right: 0px;">Примечание</th>
</tr>
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
  <td style="<?php echo $style;?>"><?php echo $item->user->fio;?></td>
  <td style="<?php echo $style;?>"><?php echo $item->data;?></td>
  <td style="<?php echo $style;?>"><?php if($item->type_operation=='3') echo 'Зачисление средств'; else echo 'Снятие средств';?></td>
  <td style="<?php echo $style;?>"><?php echo $item->type_payment->show_type;?></td>
  <td style="<?php echo $style;?>"><?php echo round($item->sum,2);?></td>
  <td style="<?php echo $style;?>"><?php if($item->balance=='0') echo 'Нет данных'; else echo $item->balance;?></td>
  <td style="<?php echo $style;?>"><?php echo $item->annotation;?></td>



</tr>
<?php 
$counter++;
endforeach;

?>
</table>
</div>
<div class="pager">
<?php $this->Widget('application.components.PagerWidget',array('pages'=>$pages,'cssFile'=>$this->css_file_pager,'page_size'=>$this->page_size,'current_route'=>$this->getRoute(),'pager_place'=>'down','is_filter'=>1));?>
</div>
<?php else:
if(isset($_POST['flag_filter'])){
	echo '<div class="no_results">Поиск не дал результатов</div>';
}
else{
	echo '<div class="no_results">Раздел пуст</div>';

}

?>
<?php endif;?>