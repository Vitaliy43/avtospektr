
<?php foreach($this->items as $item):

$height=30-($item->level-1)*6;

?>

	<!--tr onclick="submenu(this,'<?php echo $this->model_name;?>');" id="menu_<?php echo $item->id;?>" class="submenu<?php echo $item->level;?>_option child level_<?php echo $item->level;?>" height="<?php echo $height;?>" -->
	<tr  id="menu_<?php echo $item->id;?>" class="submenu<?php echo $item->level;?>_option child level_<?php echo $item->level;?>" height="<?php echo $height;?>" >
	
	<?php
	
	if($item->level==1){
		$q=0.8;
		
	}
	else{
		
		$q=1;
	}	
	
	$padding=0;
				
	
	?>
	
	<td class="profile_option menu_row" align="right" width="55" id="menu-icon_<?php echo $item->id;?>">
			
			<?php 
				list($width, $height, $type, $attr) = getimagesize('images/avtospektr/profile/'.$this->parent_item->name.'.png');
				
				if($width==12)
					$padding=10;
				elseif($width==26 or $width==28)
					$padding=0;
					
				$width*=$q;
				$height*=$q;
				$padding*=$q;
				
				/////////////////////////// Проверка на наличие подуровней у текущего item /////////////////
				
				if($this->model_name=='client'):
				if(array_key_exists($item->id,$this->client_items)){
					$have_levels=1;
				}
				else{
					$have_levels=0;
				}
				
				else:
				
				if(array_key_exists($item->id,$this->admin_items)){
					$have_levels=1;
				}
				else{
					$have_levels=0;
				}
				
				endif;
				
			
			
			?>
				<img src="/images/<?php echo Yii::app()->theme->name;?>/profile/<?php echo $this->parent_item->name;?>.png" style="padding-right:<?php echo $padding;?>px;" width="<?php echo $width;?>" height="<?php echo $height;?>"/>
		</td>
				<td class="menu_row" id="menu-name_<?php echo $item->id;?>"><span style="padding-left:30px;">
				<?php
				if(mb_strlen($item->name)>=20)
					$name=mb_substr($item->name,0,20).'..';
				else
					$name=$item->name;
				?>
				
				<?php if($this->parent_item->name=='vin'):?>
				<a href="<?php echo SITE_PATH.'autoparts';?>/<?php echo $this->parent_item->name;?>/<?php echo $name;?>" onclick="<?php if($have_levels):?>get_content(this,'<?php echo $this->model_name;?>')<?php else:?>link_to(this)<?php endif;?>;return false;" id="<?php echo $this->model_name;?>_<?php echo $item->id;?>" class="temp bufferlevel_<?php echo $item->level;?>" title="<?php echo $item->name;?>">
				<?php else:?>
				<a href="<?php echo SITE_PATH.$this->model_name;?>/<?php echo $this->parent_item->name;?>/<?php echo $name;?>" onclick="<?php if($have_levels):?>get_content(this,'<?php echo $this->model_name;?>')<?php else:?>link_to(this)<?php endif;?>;return false;" id="<?php echo $this->model_name;?>_<?php echo $item->id;?>" class="temp bufferlevel_<?php echo $item->level;?>" title="<?php echo $item->name;?>">
				<?php endif;
				
				
				?>
				
				
				<?php echo $item->show_name;?>
				</a>
				</span></td>
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
				<td class="menu_row menu_arrow" align="right" id="menu-img_<?php echo $item->id;?>">
				
				
				
					<img src="/images/avtospektr/arrow.png" width="12" height="15"/>
				
				
				
				</td>
				
				<td class="menu_option menu_row" id="before-menu-name_<?php echo $item->id;?>" style="display:none;" nowrap=""><span>Подождите секунду..</span></td>
					<td align="right" class="menu_arrow menu_row" id="before-menu-img_<?php echo $item->id;?>" style="display:none;"><img src="/images/<?php echo Yii::app()->theme->name;?>/ajax-loaders/menu.gif" /></td>
			
	</tr>
	
<?php endforeach;?>