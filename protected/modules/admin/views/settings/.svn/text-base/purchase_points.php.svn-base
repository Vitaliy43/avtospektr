<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<script type="text/javascript">

$(document).ready(function(){

	var width=get_resolution('width');
//	alert(resolution['width']);
	<?php if(isset($_REQUEST['update'])):
	
		$message='Торговая точка "'.$_REQUEST['purchase_point_name'].'" успешно отредактирована!';
	?>
	TINY.box.show({html:'<?php echo $message;?>',animate:false,close:false,mask:false,boxid:'success',autohide:5,top:250,left:(width/2)-100});
	<?php elseif(isset($_REQUEST['add'])):
		$message='Торговая точка успешно добавлена!';
	?>
	TINY.box.show({html:'<?php echo $message;?>',animate:false,close:false,mask:false,boxid:'success',autohide:5,top:250,left:(width/2)-100});
	<?php endif;?>

});

</script>
<h2>Торговые точки</h2>
<div class="add_client">
<img src="/images/<?php echo Yii::app()->theme->name;?>/add.png"/>

<a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/purchasepoints?add=1';?>" id="link_add_purchase_point" onclick="add_purchase_point(this);return false;">
<span>Добавить точку</span>
</a>
</div>
<?php if(count($items)>0):?>
<table width="98%" class="info_table" cellpadding="2" cellspacing="0">
<tr><th>Наименование</th>
<th>Адрес</th>
<th>Телефон</th>
<th>Менеджер</th>
<th>Базовая наценка</th>
<th>Время доставки</th>
<th>Действия</th>
</tr>
<?php
 $last_count=count($items)-1;
 $counter=0;
 ?>
<?php foreach($items as $item):?>
<tr id="row_<?php echo $item->id;?>">
<?php

 	$style='';
	?>
<td style="<?php echo $style;?>" id="article_<?php echo $item->id;?>">
<?php echo $item->show_name;?>
</td>

<td style="<?php echo $style;?>" align="center">
<?php	
 echo $item->address;
?>
</td>

<td style="<?php echo $style;?>" align="center">
<?php 
	echo $item->telephone;
?>
</td>

<td style="<?php echo $style;?>" align="center">
<?php 
	echo $item->user->fio;
?>
</td>
<td style="<?php echo $style;?>" align="center">
<?php 
	echo $item->mark_up;
?>
</td>
<td style="<?php echo $style;?>" align="center">
<?php 
	echo $item->add_delivery_time;
?>
</td>

<td style="<?php echo $style;?>" align="center">
<a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/purchasepoints?update='.$item->id;?>" title="Редактировать торговую точку" onclick="edit_purchase_point(this.href,'<?php echo $item->id;?>');return false;" id="link_edit_<?php echo $item->id;?>"><img src="/images/<?php echo Yii::app()->theme->name.'/icon_edit.png';?>" width="12" height="12"/></a>
<!--a href="#test" title="Редактировать торговую точку" onclick="edit_purchase_point(this.href,'<?php echo $item->id;?>');return false;" id="link_edit_<?php echo $item->id;?>"><img src="/images/<?php echo Yii::app()->theme->name.'/icon_edit.png';?>" width="12" height="12"/></a-->
&nbsp;&nbsp;&nbsp;
<a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/purchasepoints?deactivate='.$item->id;?>" onclick="deactivate_purchase_point(this.href,'<?php echo $item->id;?>');return false;" title="Деактивировать торговую точку" id="deactivate_link_<?php echo $item->id;?>"><img src="/images/<?php echo Yii::app()->theme->name.'/icon_delete.png';?>" width="12" height="12"/></a>
</td>
</tr>
<?php 
$counter++;
endforeach;?>
</table>
<?php else:?>
<div style="width:100%;text-align:center;font-size:15px;">
<span style="margin-top:150px;padding-right:50px;">Раздел пуст!</span>
</div>
<?php endif;?>
