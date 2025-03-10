<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2>Профиль пользователя</h2>
<div id="profile_user">
<form action="<?php echo SITE_PATH.'user/profile';?>" method="POST" onsubmit="validate_profile(this);return false;">

<div id="profile_address">
<div class="profile_label">Адрес</div>
<input type="text" name="profile_address" id="input_address" class="input_text" value="<?php echo $user->address;?>"/>
</div>
<div id="profile_telephone">
<div class="profile_label">Телефон</div>
<input type="text" name="profile_telephone" id="input_telephone" class="input_text" value="<?php echo $user->telephone;?>"/>
</div>
<div id="profile_email">
<div class="profile_label">E-mail</div>
<input type="text" name="profile_email" id="input_email" class="input_text" value="<?php echo $user->email;?>"/>
</div>
<div id="profile_type_payment">
<div class="profile_label">Тип оплаты</div>
<!--input type="text" name="profile_type_payment" id="input_type_payment" class="input_text" value="<?php echo $user->email;?>"/-->
<div style="margin-bottom: 10px;">
<?php 
echo CHtml::dropDownList('type_payments',$user->type_payment_id,$type_payments,array('id'=>'input_type_payment'));
?>
</div>
</div>
<div id="profile_password" onclick="view_profile_password();">Сменить пароль</div>
<div id="container_profile_password" style="display:none;">
<?php if(empty($_SESSION['temp_user'])):?>
<div class="profile_label">Старый пароль</div>
<input type="password" name="profile_old_password" id="profile_old_password" class="input_text"/>
<?php endif;?>
<div class="profile_label">Новый пароль</div>
<input type="password" name="profile_new_password" id="profile_new_password" class="input_text"/>
<div class="profile_label">Подтверждение</div>
<input type="password" name="profile_confirm_password" id="profile_confirm_password" class="input_text"/>
</div>
<div id="container_profile_submit">
<input type="submit" value="Сохранить" name="submit"/>
&nbsp;&nbsp;
<input type="reset" value="Сброс"/>
</div>
</form>
</div>