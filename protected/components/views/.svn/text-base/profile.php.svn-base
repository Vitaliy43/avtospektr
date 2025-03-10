<tr id="author">	
<?php
 if($role=='client' or $role=='user') $user_type='client'; 
 else $user_type='admin';
?>
<td>
		<?php if($user_type=='client'):?>
				<div id="head-left-menu"><h1>Личный кабинет</h1></div>
		<?php else:?>
				<div id="head-left-menu"><h1>Административная панель</h1></div>
		<?php endif;?>
			</td>
		</tr>
<tr>
<td class="profile" id="<?php echo $user_type;?>">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td colspan="3" class="fio menu_row" height="40">
	<span style="font-weight:bold;">
		<?php echo $fio;?>
	</span>
</td>
</tr>
<?php

?>
<?php foreach($items as $item):?>
<tr class="menu_option level_0" id="menu_<?php echo $item->id;?>">
		<td class="profile_option menu_row" align="right" width="55" id="menu-icon_<?php echo $item->id;?>">
			
			<?php 
				list($width, $height, $type, $attr) = getimagesize('images/avtospektr/profile/'.$item->name.'.png');
				if($width==12)
					$padding=10;
				elseif($width==26 or $width==28)
					$padding=0;
			
			?>
				<img src="/images/<?php echo Yii::app()->theme->name;?>/profile/<?php echo $item->name;?>.png" style="padding-right:<?php echo $padding;?>px;"/>
		</td>
		<td class="profile_option menu_row" align="left" id="menu-name_<?php echo $item->id;?>">
			<div>
	
				<!--a href="#" onclick="get_content(this,'<?php echo $user_type;?>');return false;" id="<?php echo $user_type.'_'.$item->id;?>" class="temp nolevel_0"-->
				<?php
				if($item->name=='cart')
					$add_class='menu_cart';
				else
					$add_class='';
					if($item->name=='vin'){
						$href=SITE_PATH.'autoparts/'.$item->name;
					}
					else{
						$href=SITE_PATH.$user_type.'/'.$item->name;
					}
				?>
				<a href="<?php echo $href;?>" onclick="get_content(this,'<?php echo $user_type;?>');return false;" id="<?php echo $user_type.'_'.$item->id;?>" class="temp bufferlevel_0 <?php echo $add_class;?>">
					<?php 
						echo $item->show_name;
						if($num_in_basket>0 and $item->name=='cart')
							echo ' (<b>'.$num_in_basket.'</b>)';
					?>
						
				</a>			
			</div>
		</td>
		<td align="right" class="menu_arrow menu_row" ><img src="/images/<?php echo Yii::app()->theme->name;?>/arrow.png"  id="menu-img_<?php echo $item->id;?>"/></td>
		<td class="menu_option menu_row" id="before-menu-name_<?php echo $item->id;?>" style="display:none;"><span>Подождите секунду..</span></td>
					<td align="right" class="menu_arrow menu_row" id="before-menu-img_<?php echo $item->id;?>" style="display:none;"><img src="/images/<?php echo Yii::app()->theme->name;?>/ajax-loaders/menu.gif" /></td>
</tr>

<?php 

if(isset($sub_items) and isset($parent_item)):
if(count($sub_items>0) and $parent_item->name==$item->name){

	$this->Widget('application.components.SubmenuWidget',array('items'=>$sub_items,'parent_item'=>$parent_item,'model_name'=>$this->type_profile));
	
}

endif;
?>
<?php endforeach;?>


<tr class="menu_option level_0" >
		<td class="profile_option menu_row" align="right" width="55" >
		
		<?php if($this->model_name=='client')
				$padding=7;
			  else
			  	$padding=5;
				
				?>
			
				<img src="/images/avtospektr/profile/logout.png" width="25" height="20" style="padding-right:<?php echo $padding;?>px;"/>
		</td>
		<td class="profile_option menu_row" align="left">
		<div>
			<a href="<?php echo SITE_PATH.'user/logout';?>">
					Выход
			</a>		
			</div>
		</td>
		<td align="right" class="menu_arrow menu_row" ><img src="/images/avtospektr/arrow.png" /></td>
					
					
</tr>
</table>
</td>
</tr>

