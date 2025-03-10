
<?php 
if(empty($_POST['type'])):
if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;
	endif;
	if($this->validate_errors)
		$errors=$this->validate_errors;
	?>
	
	
	<style type="text/css">
	
	.edit_block {
		width:600px;
		height:300px;
	}
	
	.edit_block button {
		background: #daeecc;
		padding:3px;
		width:145px;
	}
	

	</style>
		
	<div class="edit_block" style="padding:10px;">
	
	<h3>Сотрудник: <?php echo $employee->fio;?></h3>
	<form action="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/edit?user_id='.$employee->id;?>" method="POST" onsubmit="validate_edit_employee(this,'<?php echo $employee->id;?>');return false;" id="form_edit_employee">
	<input type="hidden" name="update" value="1"/>
	<table width="100%" id="edit_employee" cellpadding="10" cellspacing="10">
	<tr>
	<td width="25%">ФИО:</td>
	<td width="25%">
	<input type="text" id="employee_fio" name="employee_fio" value="<?php echo $employee->fio;?>"/>
	</td>
	<td width="50%" nowrap="">
	<?php if(isset($errors['empty_fio'])):?>
	<span style="color:red;" class="validate_message"><?php echo $errors['empty_fio'];?></span>
	<?php endif;?>
	</td>
	</tr>
	<tr>
	<td width="25%">Пароль:</td>
	<td width="25%"><input type="password" name="employee_password" onkeyup="validate_password('employee_password','answer_validate_password','employee_confirmation_password','answer_validate_confirmation');" id="employee_password" value="<?php if(isset($_REQUEST['employee_password'])) echo $_REQUEST['employee_password'];?>"/></td>	
	<td id="answer_validate_password" width="50%">
	<?php if(isset($errors['password_strlen'])):?>
	<span style="color:red;" class="validate_message"><?php echo $errors['password_strlen'];?></span>
	<?php endif;?>
	</td>
	</tr>
	<tr>
	<td width="25%">Подтверждение:</td>
	<td width="25%"><input type="password" name="employee_confirmation_password" id="employee_confirmation_password" onkeyup="validate_confirmation('employee_confirmation_password','answer_validate_confirmation','employee_password');" value="<?php if(isset($_REQUEST['employee_confirmation_password'])) echo $_REQUEST['employee_confirmation_password'];?>"/></td>	
	<td width="50%" id="answer_validate_confirmation">
	<?php if(isset($errors['password_no_match'])):?>
	<span style="color:red;" class="validate_message"><?php echo $errors['password_no_match'];?></span>
	<?php endif;?>
	</td>
	</tr>
	<tr>
	<td width="25%">Группа:</td>
	<td width="25%">
	<?php
		echo CHtml::dropDownList('role_id',$employee->user_role[0]->role_id,$roles,array('id'=>'role_id'));
	?>
	</td>
	<td width="50%">
	<?php if(isset($errors['empty_role_id'])):?>
	<span style="color:red;" class="validate_message"><?php echo $errors['empty_role_id'];?></span>
	<?php endif;?>
	</td>
	</tr>
	
	<tr>
	<td width="25%">Адрес:</td>
	<td width="25%">
	<input type="text" id="employee_address" name="employee_address" value="<?php echo $employee->address;?>"/>
	</td>
	<td width="50%"></td>
	</tr>
	<tr>
	<td width="25%">Телефон:</td>
	<td width="25%">
	<input type="text" id="employee_telephone" name="employee_telephone" value="<?php echo $employee->telephone;?>"/>
	</td>
	<td width="50%"></td>
	</tr>
	<tr>
	<td width="25%">Email:</td>
	<td width="25%">
	<input type="text" id="employee_email" name="employee_email" value="<?php echo $employee->email;?>"/>
	</td>
	<td width="50%" id="answer_validate_email">
	<?php if(isset($errors['email_empty'])):?>
	<span style="color:red;" class="validate_message"><?php echo $errors['email_empty'];?></span>
	<?php elseif(isset($errors['email_wrong'])):?>
		<span style="color:red;" class="validate_message"><?php echo $errors['email_wrong'];?></span>
	<?php elseif(isset($errors['email_exists'])):?>
		<span style="color:red;" class="validate_message"><?php echo $errors['email_exists'];?></span>
	<?php endif;?>
	</td>
	</tr>
	<tr>
	<td width="25%">

	</td>
	<td width="25%">
		<button type="submit">Изменить</button>

	</td>
	<td width="50%"></td>
	</tr>
	</table>
	</form>
	</div>
	
		 
	 
