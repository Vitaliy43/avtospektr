
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
	
	<h3>Добавление ценовой группы</h3>
	<form action="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/pricegroups?do=add'?>" method="POST" onsubmit="validate_add_price_group(this);return false;" id="form_edit_price_group">
	<input type="hidden" name="flag_insert" id="flag_insert" value="1" />
	<table width="100%" cellpadding="3" cellspacing="3">
	<tr>
	<td>Название: </td>
	<td><input type="text" value="" id="price_group_name" name="price_group_name"/></td>
	</tr>
	<tr>
	<td>Оборот за месяц: </td>
	<td><input type="text" value="" id="price_group_amount" name="price_group_amount"/></td>
	</tr>
	<tr>
	<td>Скидка, %: </td>
	<td><input type="text" value="" id="price_group_discount" name="price_group_discount"/></td>
	</tr>
	<tr>
	<td>Лимит для заказа: </td>
	<td><input type="checkbox" id="price_group_limit_order" name="price_group_limit_order"/></td>
	</tr>
	<tr>
	<td>Лимит для отгрузки: </td>
	<td><input type="checkbox" id="price_group_limit_store" name="price_group_limit_store"/></td>
	</tr>
	</table>
	<!--div onclick="test();">Test</div-->
	<div style="margin-top:10px;">
	<input type="submit" value="Добавить" name="add"/>
	</div>
	</form>
	</div>
	
		 
	 
