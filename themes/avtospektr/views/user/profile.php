<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
	<?php if(empty($_POST['type'])):?>
<h2>Профиль пользователя</h2>
<div id="profile_user">
<?php endif;?>
<form action="<?php echo SITE_PATH.'user/profile';?>" method="POST" onsubmit="validate_profile(this);return false;">

<div id="profile_address">
<div class="profile_label">Адрес</div>
<input type="text" name="profile_address" id="input_address" class="input_text" value="<?php if(isset($_REQUEST['profile_address'])) echo $_REQUEST['profile_address'];?>"/>
<?php if (isset($errors['address_empty'])):?>
&nbsp;<span>
<?php echo $errors['address_empty'];?>
</span>
<?php endif;?>
</div>
<div id="profile_telephone">
<div class="profile_label">Телефон</div>
<input type="text" name="profile_telephone" id="input_telephone" class="input_text" value="<?php if(isset($_REQUEST['profile_telephone'])) echo $_REQUEST['profile_telephone'];?>"/>
<?php if (isset($errors['telephone_empty'])):?>
&nbsp;<span>
<?php echo $errors['telephone_empty'];?>
</span>
<?php endif;?>
</div>
<div id="profile_email">
<div class="profile_label">E-mail</div>
<input type="text" name="profile_email" id="input_email" class="input_text" value="<?php if(isset($_REQUEST['profile_email'])) echo $_REQUEST['profile_email'];?>"/>
<?php if (isset($errors['email_empty'])):?>
&nbsp;<span>
<?php echo $errors['email_empty'];?>
</span>
<?php elseif (isset($errors['email_wrong'])):?>
&nbsp;<span>
<?php echo $errors['email_wrong'];?>
</span>
<?php elseif (isset($errors['email_exists'])):?>
&nbsp;<span>
<?php echo $errors['email_exists'];?>
</span>
<?php endif;?>
</div>
<?php

if($_REQUEST['profile_new_password']!=''){
	$display='block';
	$label='Скрыть блок пароля';
}
else{
	$display='none';
	$label='Сменить пароль';
}
	
	

?>
<div id="profile_password" onclick="view_profile_password();"><?php echo $label;?></div>

<div id="container_profile_password" style="display:<?php echo $display;?>;">
<?php if(empty($_SESSION['temp_user'])):?>
<div class="profile_label">Старый пароль</div>
<input type="password" name="profile_old_password" id="profile_old_password" class="input_text"/>
<?php if (isset($errors['password_wrong'])):?>
&nbsp;<span>
<?php echo $errors['password_wrong'];?>
</span>
<?php endif;?>
<?php endif;?>
<div class="profile_label">Новый пароль</div>
<input type="password" name="profile_new_password" id="profile_new_password" class="input_text"/>
<?php if (isset($errors['password_strlen'])):?>
&nbsp;<span>
<?php echo $errors['password_strlen'];?>
</span>
<?php endif;?>
<div class="profile_label">Подтверждение</div>
<input type="password" name="profile_confirm_password" id="profile_confirm_password" class="input_text"/>
<?php if (isset($errors['password_no_match'])):?>
&nbsp;<span>
<?php echo $errors['password_no_match'];?>
</span>
<?php endif;?>
</div>
<div id="container_profile_submit">
<input type="submit" value="Сохранить" name="submit"/>
</div>
</form>
<?php if(empty($_POST['type'])):?>
</div>
<?php endif;?>