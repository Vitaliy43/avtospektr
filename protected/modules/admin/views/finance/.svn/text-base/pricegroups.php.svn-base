<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2>Ценовые группы</h2>
<br/>
<div class="add_client">
<img src="/images/<?php echo Yii::app()->theme->name;?>/add.png"/>

<a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/pricegroups?do=add';?>" onclick="add_price_group(this);return false;">
<span>Добавить группу</span>
</a>
</div>
<table width="90%" class="info_table" cellpadding="0" cellspacing="0">
<tr><th>Название</th><th>Оборот за месяц,руб.</th><th>% скидки</th><th>Лимит для заказа</th><th style="border-right: 0px;">Лимит для отгрузки</th><th></th>
</tr>
<?php 
 
 $last_count=count($items)-1;
 $counter=0;
 
 ?>
<?php foreach($items as $item):

if($last_count==$counter)
 	$style='border-bottom: 0px;';
 else
 	$style='';

?>
<tr id="row_<?php echo $item->id;?>">
 <td ><?php echo $item->name;?></td>
 <td ><?php echo $item->amount;?></td>
 <td ><?php echo $item->percent;?></td>
 <td ><?php if($item->limit_for_order==1) echo 'Есть'; else echo 'Нет';?>
 </td>
  <td ><?php if($item->limit_for_store==1) echo 'Есть'; else echo 'Нет';?>
 </td>
<td id="link_<?php echo $item->id;?>"><a href="<?php echo SITE_PATH.$this->module->id.'/finance/pricegroups?do=edit&group_id='.$item->id;?>" onclick="edit_price_group(this,'<?php echo $item->id;?>');return false;"><img src="/images/<?php echo Yii::app()->theme->name.'/icon_edit.png';?>" width="12" height="12" /></a></td>

</tr>
<?php $counter++;
endforeach;
?>

</table>
