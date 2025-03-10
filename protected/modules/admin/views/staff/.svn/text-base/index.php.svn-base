<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>

<script type="text/javascript">

$(document).ready(function(){

	var width=get_resolution('width');
	
//	alert(resolution['width']);
	<?php if(isset($_REQUEST['update']) and $this->updated):
	
		$message='Информация по сотруднику "'.$_REQUEST['employee_fio'].'" успешно отредактирована!';
	?>
	TINY.box.show({html:'<?php echo $message;?>',animate:false,close:false,mask:false,boxid:'success',autohide:5,top:250,left:(width/2)-100});
	<?php elseif(isset($_REQUEST['add']) and $this->added):
		$message='Сотрудник "'.$_REQUEST['employee_fio'].'" успешно добавлен!';
	?>
	TINY.box.show({html:'<?php echo $message;?>',animate:false,close:false,mask:false,boxid:'success',autohide:5,top:250,left:(width/2)-100});
	<?php endif;?>

});

</script>

<div class="add_client">
<img src="/images/<?php echo Yii::app()->theme->name;?>/add.png"/>

<a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/add';?>" onclick="add_employee(this);return false;" id="link_add_employee">
<!--a href="#test" onclick="add_employee(this);return false;" id="link_add_employee"-->
<span>Добавить сотрудника</span>
</a>
</div>
<?php if(count($staff)>0):?>
<div id="container_info_table">
<table width="98%" class="info_table" cellpadding="0" cellspacing="0">
<tr>
<th>ФИО</th>
<th>Логин</th>
<th>Группа</th>
<th>Дата регистрации</th>
<th>Email</th>
<th>Адрес</th>
<th>Телефон</th>
<th></th>

</tr>
    <?php

    $last_count=count($staff)-1;
    $counter=0;

    foreach($staff as $employee):?>
<tr>
 <?php 

 	$style='';
	
?> 
  <td style="<?php echo $style;?>"><?php echo $employee['fio'];?></td>
  <td style="<?php echo $style;?>font-size:10px;"><?php echo $employee['user'];?></td>
  <td style="<?php echo $style;?>font-size:10px;">
  <?php 
  if($employee['role_id']==3)
  	echo 'Менеджер';
  elseif($employee['role_id']==4)
  	echo 'Администратор';
  ?>
  </td>
  <td style="<?php echo $style;?>font-size:10px;"><?php echo CTime::change_show_data($employee['data_registry']);?></td>
  <td style="<?php echo $style;?>font-size:9px;"><?php echo $employee['email'];?></td>
  <td style="<?php echo $style;?>font-size:9px;"><?php echo $employee['address'];?></td>
  <td style="<?php echo $style;?>"><?php echo $employee['telephone'];?></td>
  <td style="<?php echo $style;?>font-size:10px;" id="link_<?php echo $employee['id'];?>">
  <a href="<?php echo SITE_PATH.$this->module->id.'/staff/edit?user_id='.$employee['id'];?>" onclick="edit_employee(this,'<?php echo $employee['id'];?>');return false;" title="Редактировать сотрудника"><img src="/images/<?php echo Yii::app()->theme->name.'/icon_edit.png';?>" width="12" height="12" /></a>
  </td>



</tr>
<?
$counter++;
 endforeach;?>
</table>
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