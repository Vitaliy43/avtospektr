<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<script type="text/javascript">

$(document).ready(function(){

	var width=get_resolution('width');
//	alert(resolution['width']);
	<?php if(isset($_REQUEST['update']) and isset($_REQUEST['header']) and (isset($update) and $update)):
	
		$message='Материал "'.$_REQUEST['header'].'" успешно отредактирован!';
	?>
	TINY.box.show({html:'<?php echo $message;?>',animate:false,close:false,mask:false,boxid:'success',autohide:5,top:250,left:(width/2)-100});
	<?php elseif(isset($_REQUEST['add']) and isset($_REQUEST['header'])):
		$message='Материал "'.$_REQUEST['header'].'" успешно добавлен!';
	?>
	TINY.box.show({html:'<?php echo $message;?>',animate:false,close:false,mask:false,boxid:'success',autohide:5,top:250,left:(width/2)-100});
	<?php endif;?>

});

</script>
<h2>Список материалов</h2>
<div class="add_client">
<img src="/images/<?php echo Yii::app()->theme->name;?>/add.png"/>

<a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/content?do=add';?>" target="_blank">
<span>Добавить материал</span>
</a>
</div>
<?php if(count($items)>0):?>
<table width="98%" class="info_table" cellpadding="2" cellspacing="0">
<tr><th>Заголовок</th>
<th>Пункт меню</th>
<th>Дата изменения</th>
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
<a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/content?article='.$item->id;?>" style="text-decoration:underline;" onclick="show_article(this.href,'<?php echo $item->id;?>');return false;"><?php echo $item->header;?></a>
</td>


<td style="<?php echo $style;?>" align="center">
<?php
//echo 'item auto_car_id '.$item->auto_car_id.'<br>';
if($item->user_menu_id==$user_menu_auto->id){
	if($item->auto_car_id)
		$menu_items[$item->user_menu_id]='Авто - '.$catalog_auto[$item->auto_car_id];
	else
		$menu_items[$item->user_menu_id]=$user_menu_auto->show_name;
}
else{
	$menu_items[$user_menu_auto->id]=$user_menu_auto->show_name;
}
	
	

 echo CHtml::dropDownList('user_menu',$item->user_menu_id,$menu_items,array('id'=>'user_menu',"onchange"=>"set_point_menu('".SITE_PATH.$this->module->id.'/'.$this->id.'/menu'."','".$item->id."');"));
?>
</td>

<td style="<?php echo $style;?>" align="center">
<?php 

	echo CTime::change_show_data($item->data_modified);
?>
</td>
<td style="<?php echo $style;?>" align="center">
<a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/content?update='.$item->id;?>" target="_blank" title="Редактировать материал"><img src="/images/<?php echo Yii::app()->theme->name.'/icon_edit.png';?>" width="12" height="12"/></a>
&nbsp;&nbsp;&nbsp;
<a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/content?delete='.$item->id;?>" onclick="delete_content(this.href,'<?php echo $item->id;?>','<?php echo SITE_PATH.$this->getRoute();?>');return false;" title="Удалить материал"><img src="/images/<?php echo Yii::app()->theme->name.'/icon_delete.png';?>" width="12" height="12"/></a>
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
