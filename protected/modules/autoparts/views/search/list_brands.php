<div id="container_list_brands" style="margin-top: 20px;">
<?php if(count($brands)>0):?>
<table border="1" cellpadding="0" cellspacing="0"  width=70% style="background: #62C653;">
<tr>
	<td><font size="3">Производитель</font></td>
	<td width="200" align="center"><font size="3">Кол-во запчастей</font></td>
</tr>
<tr class="search_panel"><td onclick="output_search_result('all','<?php echo SITE_PATH.$this->module->id.'/search/result';?>');"><font size="3">все производители</font></td>
<td width="200" align="center"><font size="3"><?php echo $num_brands;?></font></td>
</tr>
<?php foreach($brands as $brand):?>
<tr class="search_panel">
	<td onclick="output_search_result('<?php echo $brand['brand'];?>','<?php echo SITE_PATH.$this->module->id.'/search/result';?>');"><font size="3"><?php echo $brand['brand'];?></font></td>
	<td width="200" align="center"><font size="3"><?php echo $brand['num'];?></font></td>
</tr>
<?php endforeach;?>
</table>
<?php else:?>
	<div>Поиск не дал результатов</div>
<?php endif;?>
</div>