
<?php


 foreach($this->items as $item):

$height=30-($item->level-1)*6;

?>
	
	<tr  class="submenu<?php echo $item->level;?>_option child level_<?php echo $item->level;?>" height="<?php echo $height;?>" id="menu_<?php echo $item->id;?>">
				<td class="menu_row" id="menu-name_<?php echo $item->id;?>"><span>
				<?php
				if(mb_strlen($item->name)>=20)
					$name=mb_substr($item->name,0,20).'..';
				else
					$name=$item->name;
				
				?>
				<a href="<?php echo SITE_PATH.'catalog/show/index?item_id='.$item->id;?>" onclick="get_content(this,'menu_catalog');return false;" id="a_<?php echo $item->id;?>" title="<?php echo $item->name;?>"><?php echo $name;?></a>
				
				
				</span></td>
				<td class="menu_row menu_arrow" align="right" id="menu-img_<?php echo $item->id;?>">
				<?php
				if($item->level==1){
					$add_width=11;
					$add_height=13;
					$delete_size=13;
				}
				else{
					$add_width=9;
					$add_height=11;
					$delete_size=11;
				}
				
				?>
				<?php if($enable_edit):?>
					<a href="<?php echo SITE_PATH.'catalog/menu/addpoint';?>" title="Добавить пункт в меню" onclick="modal_add_point_catalog(this.href,<?php echo $item->id;?>,<?php echo $item->parent_id;?>,<?php echo $item->level;?>);return false;"><img src="/images/avtospektr/add_point.png" width="<?php echo $add_width;?>" height="<?php echo $add_height;?>"/></a>
					<!--a href="<?php echo SITE_PATH.'catalog/menu/removepoint?item_id='.$item->id;?>" title="Удалить пункт из меню" onclick="remove_point(this.href,<?php echo $item->id;?>);return false;"><img src="/images/avtospektr/icon_delete.png" width="<?php echo $delete_size-2;?>" height="<?php echo $delete_size;?>"/></a-->
					<a href="<?php echo SITE_PATH.'catalog/menu/removepoint?item_id='.$item->id;?>" title="Удалить пункт из меню" onclick="remove_point(this.href,<?php echo $item->id;?>);return false;"><img src="/images/avtospektr/icon_delete.png" width="<?php echo $delete_size-2;?>" height="<?php echo $delete_size;?>"/></a>
					<a href="<?php echo SITE_PATH.'catalog/menu/editpoint?id='.$item->id;?>" title="Редактировать пункт меню" onclick="modal_edit_point_catalog(this.href,<?php echo $item->id;?>);return false;"><img src="/images/avtospektr/icon_edit.png" width="<?php echo $delete_size;?>" height="<?php echo $delete_size;?>"/></a>
					
					

				<?php else:?>
					<img src="/images/avtospektr/arrow.png" width="12" height="15"/>
				<?php endif;?>
				</td>
				<td class="menu_option menu_row" id="before-menu-name_<?php echo $item->id;?>" style="display:none;"><span>Подождите секунду..</span></td>
					<td align="right" class="menu_arrow menu_row" id="before-menu-img_<?php echo $item->id;?>" style="display:none;"><img src="/images/avtospektr/ajax-loaders/menu.gif" /></td>
			
	</tr>
	
<?php endforeach;?>