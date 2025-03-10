<?php 
if(empty($_POST['type'])):
if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;
	endif;
	?>
	<div class="edit_block" style="font-size:14px;padding:5px;">
	
	<h3>Добавление сотрудника</h3>
	<form action="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/';?>" method="POST" onsubmit="validate_add_employee(this);return false;" id="form_edit_employee">
	<div style="margin-left:4px;">
	Список:&nbsp;
	<?php
		echo CHtml::dropDownList('user_id','0',$users,array('id'=>'user_id'));
	?>
	</div>
	<div style="margin-top:15px;margin-left:4px;">
	Группы:&nbsp;
	<?php
		echo CHtml::dropDownList('role_id','0',$roles,array('id'=>'role_id'));
	?>
	</div>

	<div style="margin-top:10px;">
	<input type="hidden" id="add" name="add" value="1"/>
	<input type="submit" value="Добавить" name="add"/>
	<!--button onclick="validate_edit_client('');">Изменить</button-->
	</div>
	</form>
	</div>