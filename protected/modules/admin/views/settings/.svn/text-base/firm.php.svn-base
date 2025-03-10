<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2>Реквизиты организации</h2>
<div id="profile_user">
<form action="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/firm';?>" method="POST" onsubmit="validate_edit_firm(this);return false;">
<input type="hidden" name="update" value="1"/>
<div id="profile_address">
<div class="profile_label">Наименование</div>
<input type="text" name="firm_name" id="firm_name" class="input_text" value="<?php echo $firm->name;?>"/>
<?php if(isset($errors['empty_firm_name'])):
echo '<span>'.$errors['empty_firm_name'].'</div>';
endif;
?>
</div>
<div id="profile_telephone">
<div class="profile_label">ИНН</div>
<input type="text" name="inn" id="inn" class="input_text" value="<?php echo $firm->inn;?>"/>
<?php if(isset($errors['empty_inn'])):
echo '<span>'.$errors['empty_inn'].'</div>';
endif;
?>
</div>
<div id="profile_email">
<div class="profile_label">Банковские реквизиты</div>
<textarea id="banking_details" name="banking_details" cols="29" rows="5">
<?php echo $firm->banking_details;?>
</textarea>
</div>
<div id="profile_telephone">
<div class="profile_label">Основной адрес</div>
<input type="text" name="main_address" id="main_address" class="input_text" value="<?php if(isset($firm->main_address)) echo $firm->main_address;?>"/>
</div>
<div id="profile_telephone">
<div class="profile_label">Основной телефон</div>
<input type="text" name="main_telephone" id="main_telephone" class="input_text" value="<?php if(isset($firm->main_telephone)) echo $firm->main_telephone;?>"/>
</div>
<div id="container_profile_submit">
<input type="submit" value="Сохранить" name="submit"/>
&nbsp;&nbsp;
<input type="reset" value="Сброс"/>
</div>
</form>
</div>
