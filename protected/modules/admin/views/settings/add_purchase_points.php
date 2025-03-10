<?php 
if(empty($_POST['type'])):
if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;
	endif;
	?>
	
	<style type="text/css">
	
	.edit_block {
		width:600px;
		height:300px;
	}
	
	.edit_block button {
		background: #daeecc;
		padding:3px;
		width:170px;
	}
	
	.edit_block input {
		width:170px;
	}
	
	</style>
	
	<div class="edit_block" style="font-size:14px;padding:5px;">
	
	<h3>Добавление торговой точки</h3>
	<form action="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/purchasepoints';?>" method="POST" onsubmit="validate_add_purchase_point(this);return false;" id="form_edit_purchase_point">
	<input type="hidden" name="add" value="1"/>
	<table width="100%" id="add_purchase_point" cellpadding="10" cellspacing="10">
	<tr>
	<td width="25%">Наименование:</td>
	<td width="25%">
	<input type="text" id="purchase_point_name" name="purchase_point_name" value="<?php if (isset($_REQUEST['purchase_point_name'])) echo $_REQUEST['purchase_point_name'];?>"/>
	</td>
	<td width="50%" nowrap="">
	<?php if(isset($errors['empty_name'])):?>
	<span style="color:red;" class="validate_message"><?php echo $errors['empty_name'];?></span>
	<?php endif;?>
	</td>
	</tr>
	<tr>
	<td width="25%">Адрес:</td>
	<td width="25%">
	<input type="text" id="purchase_point_address" name="purchase_point_address" value="<?php if (isset($_REQUEST['purchase_point_address'])) echo $_REQUEST['purchase_point_address'];?>"/>
	</td>
	<td width="50%">
	<?php if(isset($errors['empty_address'])):?>
	<span style="color:red;" class="validate_message"><?php echo $errors['empty_address'];?></span>
	<?php endif;?>
	</td>
	</tr>
	<tr>
	<td width="25%">Телефон:</td>
	<td width="25%">
	<input type="text" id="purchase_point_telephone" name="purchase_point_telephone" value="<?php if (isset($_REQUEST['purchase_point_telephone'])) echo $_REQUEST['purchase_point_telephone'];?>"/>
	</td>
	<td width="50%">
	<?php if(isset($errors['empty_telephone'])):?>
	<span style="color:red;" class="validate_message"><?php echo $errors['empty_telephone'];?></span>
	<?php endif;?>
	</td>
	</tr>
	<tr>
	<td width="25%">Менеджер:</td>
	<td width="25%">
	<?php
	
		if(isset($_REQUEST['manager_id']))
			$selected=$_REQUEST['manager_id'];
		else
			$selected=0;
		echo CHtml::dropDownList('manager_id',$selected,$managers,array('id'=>'manager_id'));
	?>
	</td>
	<td width="50%">
	<?php if(isset($errors['empty_manager_id'])):?>
	<span style="color:red;" class="validate_message"><?php echo $errors['empty_manager_id'];?></span>
	<?php endif;?>
	</td>
	</tr>
	
	<tr>
	<td width="25%">Базовая наценка:</td>
	<td width="25%">
	<input type="text" id="purchase_point_markup" name="purchase_point_markup" value="<?php if (isset($_REQUEST['purchase_point_markup'])) echo $_REQUEST['purchase_point_markup']; else echo 0;?>"/>
	</td>
	<td width="50%">
	<?php if(isset($errors['wrong_markup'])):?>
	<span style="color:red;" class="validate_message"><?php echo $errors['wrong_markup'];?></span>
	<?php endif;?>
	</td>
	</tr>
	<tr>
	<td width="25%">Время доставки:</td>
	<td width="25%">
	<input type="text" id="purchase_point_delivery_time" name="purchase_point_delivery_time" value="<?php if (isset($_REQUEST['purchase_point_delivery_time'])) echo $_REQUEST['purchase_point_delivery_time']; else echo 0;?>"/>
	</td>
	<td width="50%">
	<?php if(isset($errors['wrong_delivery_time'])):?>
	<span style="color:red;" class="validate_message"><?php echo $errors['wrong_delivery_time'];?></span>
	<?php endif;?>
	</td>
	</tr>
	<tr>
	<td width="25%">

	</td>
	<td width="25%">
		<button type="submit">Добавить</button>

	</td>
	<td width="50%"></td>
	</tr>
	</table>
	</form>
	</div>