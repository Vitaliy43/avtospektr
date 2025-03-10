<?php if(UserIdentity::getProperty('role')=='root' or UserIdentity::getProperty('role')=='admin'):?>
<div id="container_add_point_catalog" style="display:none;">
	<div id="add_point_catalog" style="padding:20px;">
	<form action="<?php echo SITE_PATH.'admin/catalog/addpoint';?>" method="post" onsubmit="validate_add_point_catalog();return false;">
	<h2>Структура каталога товаров магазина "Автоспектр"</h2>
	<h3></h3>
	<input type="hidden" name="parent_id" id="parent_id"/>
	<input type="hidden" name="item_level" id="item_level"/>
	<div style="margin-top:10px;" id="row_point_0">Название пункта:
	<span style="margin-left:5px;"><input type="text" id="point_name_0" name="point_name_0" class="add_point">
	<a href="#add_point_catalog" onclick="add_element();return false;" title="Добавить пункт" style="margin-left:5px;">
		<img src="/images/avtospektr/add.png"/>
	</a>
	<a href="#add_point_catalog" onclick="remove_element(this);return false;" title="Удалить пункт" style="margin-left:5px;" id="link_point_0">
		<img src="/images/avtospektr/icon_delete.png"/>
	</a>
	</span>
	</div>
	<div id="submit_add_point" style="margin-top:15px;"><input type="submit" value="Ввод"/></div>
	<!--div style="margin-top:15px;" onclick="validate_add_point_catalog();">Test</div-->
	</form>
	</div>
	</div>
	
	<div id="container_edit_point_catalog" style="display:none;">
	<div id="edit_point_catalog" style="padding:20px;">
	<form action="<?php echo SITE_PATH.'admin/catalog/editpoint';?>" method="post" onsubmit="validate_edit_point_catalog();return false;">
	<h2>Структура каталога товаров магазина "Автоспектр"</h2>
	<h3></h3>
	<input type="hidden" name="item_id" id="item_id"/>
	<div style="margin-top:10px;margin-left:5px;">Название пункта:
	<div id="container_point_name">
	</div>
	</div>
	<div id="submit_add_point" style="margin-top:15px;"><input type="submit" value="Изменить"/></div>
	<!--div style="margin-top:15px;" onclick="validate_add_point_catalog();">Test</div-->
	</form>
	</div>
	</div>
	<?php endif;?>
		
	<div id="menu_catalog">
	<input  type="hidden" id="prev_id" value="0"/>
		<table cellpadding="0" cellspacing="0" width="100%">
			<?php foreach($items as $item):?>
				<!--tr onclick="submenu(this,'menu_catalog');" id="menu_<?php echo $item->id;?>" class="menu_option level_0"-->
				<tr class="menu_option level_0" id="menu_<?php echo $item->id;?>" >
					<td class="menu_option menu_row" id="menu-name_<?php echo $item->id;?>" ><span>
					
					<a href="<?php echo SITE_PATH.'catalog/show/index?item_id='.$item->id;?>" onclick="get_content(this,'menu_catalog');return false;" id="a_<?php echo $item->id;?>" ><?php echo $item->name;?></a>
					<!--a href="#test" onclick="get_content(this,'menu_catalog');return false;" id="a_<?php echo $item->id;?>" ><?php echo $item->name;?></a-->
					
					
					
					</span></td>
					<td align="right" class="menu_arrow menu_row" id="menu-img_<?php echo $item->id;?>" >
					<?php if($enable_edit):?>
						<a href="<?php echo SITE_PATH.'catalog/menu/addpoint';?>" title="Добавить пункт в меню" onclick="modal_add_point_catalog(this.href,<?php echo $item->id;?>,0,0);return false;"><img src="/images/avtospektr/add_point.png" /></a>
						<a href="<?php echo SITE_PATH.'catalog/menu/removepoint?item_id='.$item->id;?>" title="Удалить пункт из меню" onclick="remove_point(this.href,<?php echo $item->id;?>);return false;"><img src="/images/avtospektr/icon_delete.png" /></a>
						<a href="<?php echo SITE_PATH.'catalog/menu/editpoint?id='.$item->id;?>" title="Редактировать пункт меню" onclick="modal_edit_point_catalog(this.href,<?php echo $item->id;?>);return false;"><img src="/images/avtospektr/icon_edit.png" /></a>
					<?php else:?>
						<img src="/images/avtospektr/arrow.png" />
					<?php endif;?>
					</td>
					<td class="menu_option menu_row" id="before-menu-name_<?php echo $item->id;?>" style="display:none;"><span>Подождите секунду..</span></td>
					<td align="right" class="menu_arrow menu_row" id="before-menu-img_<?php echo $item->id;?>" style="display:none;">
<img src="/images/avtospektr/ajax-loaders/menu.gif" />
					</td>
				</tr>
 <?php 

	if(count($sub_items)>0 and $parent_item==$item->id):

	$this->Widget('application.modules.catalog.components.SubmenuWidget',array('items'=>$sub_items,'parent_item'=>$parent_item));
	

endif;
?>
	
			<?php endforeach;?>
		</table>
	</div>