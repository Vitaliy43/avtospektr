<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
	<?php 
	if(UserIdentity::getProperty('role')=='root'):
		$catalog_title='Каталоги магазинов';
	elseif(UserIdentity::getProperty('role')=='admin'):
		$catalog_title='Каталоги магазина';
	endif;
	
	?>
<h1><?php echo $catalog_title;?></h1>
<table cellspacing="10" cellpadding="10" width="60%">
<tr>
<?php 
$counter=0;
foreach($items as $item):?>
<td width=100 align="center" valign=top ><a href="<?php echo '/'.$this->module->id.'/'.$this->id.'/'.$item->name;?>" onclick="link_to(this);return false;"><img src="<?php echo '/images/'.Yii::app()->theme->name.'/icons/'.$this->module->id.'/'.$this->id.'/'.$item->name.'.png';?>" width="128" height="128" border="0" ><br><font><?php echo $item->show_name;?></font></a></td>
<?php 
$counter++;
endforeach;?>
</tr>
</table>