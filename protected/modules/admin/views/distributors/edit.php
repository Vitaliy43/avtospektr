<?php 
if(empty($_POST['type'])):
if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;
	endif;
	?>
	
<div class="edit_block">
<h3>Поставщик: <?php echo $distributor->name;?></h3>
<form action="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/edit?distributor_id='.$distributor->id;?>" method="POST" onsubmit="validate_edit_distributor(this);return false;" id="form_edit_distributor">
<table class="edit_distributor" cellpadding="4" cellspacing="4">
<tr>
<td>Наименование: </td><td><input type="text" value="<?php echo $distributor->name;?>" id="name" name="name" class="text"></td>
</tr>
<tr>
<td>Сайт: </td><td><input type="text" value="<?php echo $distributor->site;?>" id="site" name="site" class="text"></td>
</tr>
<tr>
<td>Адрес: </td><td>
<input type="text" value="<?php echo $distributor->address;?>" id="address" name="address" class="text"></td>
</tr>
<tr>
<td>Телефон: </td><td><input type="text" value="<?php echo $distributor->telephone;?>" id="telephone" name="telephone" class="text"></td>
</tr>
<tr>
<td>E-mail: </td><td><input type="text" value="<?php echo $distributor->email;?>" id="email" name="email" class="text"></td>
</tr>
<tr>
<td>Сроки поставки: </td><td><input type="text" value="<?php echo $distributor->period_delivery;?>" id="period_delivery" name="period_delivery" class="text"></td>
</tr>
<tr>
<td>Базовая наценка: </td><td><input type="text" value="<?php echo $distributor->add_price_default;?>" id="add_price_default" name="add_price_default" class="text"></td>
</tr>
<tr>
<td>Разрешить скидки: </td><td align="left"><input type="checkbox" id="enable_discount" name="enable_discount" <?php if($distributor->enable_discount==1) echo 'checked';?>></td>
</tr>
<tr>
<td valign="top">Реквизиты для входа</td>
<td>
<table class="edit_accesses" cellpadding="0" cellspacing="0">
<tr>
<td>Id входа</td>
<td><input type="text" value="<?php echo $distributor->accesses[0]->id_enter;?>" id="id_enter" name="id_enter"/></td>
</tr>
<tr>
<td>Логин</td>
<td><input type="text" value="<?php echo $distributor->accesses[0]->login;?>" id="access_login" name="access_login"/></td>
</tr>
<tr>
<td>Пароль</td>
<td><input type="text" value="<?php echo $distributor->accesses[0]->password;?>" id="access_password" name="access_password"/></td>
</tr>
</table>
</td>
</tr>
</table>
<div>
<input type="submit" value="Изменить" name="update"/>
</div>
</form>
</div>