<div id="add_pricing" style="padding:20px;">
	<form action="<?php echo SITE_PATH.'admin/clients/setpricing';?>" method="post" onsubmit="validate_set_pricing();return false;">
	<input type="hidden" name="distributor_id" id="distributor_id" value="<?php echo $distributor->id;?>"/>
	<input type="hidden" name="client_id" id="client_id" value="<?php echo $_REQUEST['client_id'];?>"/>
	<?php if (isset($_REQUEST['edit_markups'])):?>
		<input type="hidden" name="pricing_update" value="1" id="pricing_update"/>
	<?php else:?>
		<input type="hidden" name="pricing_insert" value="1" id="pricing_insert"/>
	<?php endif;?>
	<h2>Комплексное ценообразование</h2>
	<h3>Система наценок по поставщику "<?php echo $distributor->name;?>"</h3>	
	<?php if (empty($_POST['type'])):?>
	<div class="warnings">
	<?php 
	if(isset($this->validate_errors['empty_fields']))
		echo '<div>'.$this->validate_errors['empty_fields'].'</div>';
	if(isset($this->validate_errors['zero']))
		echo '<div>'.$this->validate_errors['zero'].'</div>';
	if(isset($this->validate_errors['repeated_values']))
		echo '<div>'.$this->validate_errors['repeated_values'].'</div>';
	?>
	</div>
	<?php endif;?>
	<table width="80%" cellspacing="2" style="margin-top:10px;" cellpadding="2">
	<?php if(count($markups)>0):
	for($i=0;$i<count($markups);$i++):
	?>
	<tr id="price_point_edit_<?php echo $markups[$i]->id;?>">
	<td nowrap="">Ценовой предел:</td>
	<td><input type="text" id="price_name_edit_<?php echo $markups[$i]->id;?>" name="price_name_edit_<?php echo $markups[$i]->id;?>" class="pricing" value="<?php echo $markups[$i]->price_range;?>"></td>
	<td>Наценка:</td>
	<td><input type="text" id="markup_name_edit_<?php echo $markups[$i]->id;?>" name="markup_name_edit_<?php echo $markups[$i]->id;?>" class="pricing" value="<?php echo $markups[$i]->markup;?>"></td>
	<td>
	<a href="#add_point_catalog" onclick="add_element_pricing();return false;" title="Добавить пункт" style="margin-left:5px;">
		<img src="/images/avtospektr/add.png"/>
	</a>
	</td>
	<td>
	<a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/removemarkup?markup_id='.$markups[$i]->id;?>" onclick="remove_element_pricing(this);return false;" title="Удалить пункт" style="margin-left:5px;" id="link_pricing_edit_<?php echo $markups[$i]->id;?>" class="edit_pricing">
		<img src="/images/avtospektr/icon_delete.png"/>
	</a>
	</td>
	</tr>
	<?php
	endfor;
	else:?>
	<tr id="price_point_0">
	<td nowrap="">Ценовой предел:</td>
	<td><input type="text" id="price_name_0" name="price_name_0" class="pricing"></td>
	<td>Наценка:</td>
	<td><input type="text" id="markup_name_0" name="markup_name_0" class="pricing"></td>
	<td>
	<a href="#add_point_catalog" onclick="add_element_pricing();return false;" title="Добавить пункт" style="margin-left:5px;">
		<img src="/images/avtospektr/add.png"/>
	</a>
	</td>
	<td>
	<a href="#add_point_catalog" onclick="remove_element_pricing(this);return false;" title="Удалить пункт" style="margin-left:5px;" id="link_pricing_0">
		<img src="/images/avtospektr/icon_delete.png"/>
	</a>
	</td>
	</tr>
	<?php endif;?>
	<tr id="submit_pricing" height="30" valign="bottom">
	<td colspan="6">
		<input type="submit" value="Ввод"/>
	</td>
	</tr>
	</table>
	
	<!--div style="margin-top:15px;" onclick="validate_add_point_catalog();">Test</div-->
	</form>
	</div>