
<?php 
if(empty($_POST['type'])):
if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;
	endif;
	?>
	<?php
	//$last_markup=$markups[count($markups)-1];
	
	?>
	<div class="hidden_block">
	
	</div>
	<div class="edit_block" style="margin: 15px;">
	
	<h3>Ценовая группа: <?php echo $group->name;?></h3>
	<form action="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/pricegroups?do=edit&price_group_id='.$group->id;?>" method="POST" onsubmit="validate_edit_price_group(this,'<?php echo $group->id;?>');return false;" id="form_edit_price_group">
	<input type="hidden" name="flag_change" id="flag_change" value="1" />
	<table width="100%" cellpadding="3" cellspacing="3">
	<tr>
	<td>Название: </td>
	<td><input type="text" value="<?php echo $group->name;?>" id="price_group_name" name="price_group_name"/></td>
	</tr>
	<tr>
	<td>Оборот за месяц: </td>
	<td><input type="text" value="<?php echo $group->amount;?>" id="price_group_amount" name="price_group_amount"/></td>
	</tr>
	<tr>
	<td>Скидка, %: </td>
	<td><input type="text" value="<?php echo $group->percent;?>" id="price_group_discount" name="price_group_discount"/></td>
	</tr>
	<tr>
	<td>Лимит для заказа: </td>
	<td><input type="checkbox" <?php if($group->limit_for_order==1) echo "checked"; ?> id="price_group_limit_order" name="price_group_limit_order"/></td>
	</tr>
	<tr>
	<td>Лимит для отгрузки: </td>
	<td><input type="checkbox" <?php if($group->limit_for_store==1) echo "checked"; ?> id="price_group_limit_store" name="price_group_limit_store"/></td>
	</tr>
	</table>
	<!--div onclick="test();">Test</div-->
	<div style="margin-top:10px;">
	<input type="submit" value="Изменить" name="update"/>
	</div>
	</form>
	</div>
	
		 
	 
