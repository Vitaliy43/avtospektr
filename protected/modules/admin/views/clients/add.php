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
	
	<h3>Добавление клиента</h3>
	<form action="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/';?>" method="POST" onsubmit="validate_add_client(this);return false;" id="form_edit_client">
	<div style="margin-left:4px;">
	Список:&nbsp;
	<?php
		echo CHtml::dropDownList('client_id','0',$clients,array('id'=>'client_id'));
	?>
	</div>
	<div style="margin-top:5px;margin-left:4px;">Лимит для кредита: &nbsp;<input type="text" value="" id="limit_credit" name="limit_credit" style="width:83px;"> руб.</div>
	<table width="50%">
	<tr>
	<th align="left" colspan="2">Базовые наценки:
	
	</th>
	
	
	</tr>
	<?php foreach($distributors as $distributor):?>
	<tr id="row_markup_<?php echo $distributor->id;?>">
	<td><?php echo $distributor->name.': </td><td><input type="text" value="" class="input_markups" name="markup_'.$distributor->id.'" id="markup_'.$distributor->id.'">%</td>';?>
	</tr>
	<?php endforeach;?>
	
	</table>
	

	<div style="margin-top:10px;">
	<input type="submit" value="Добавить" name="add"/>
	<!--button onclick="validate_edit_client('');">Изменить</button-->
	</div>
	</form>
	</div>