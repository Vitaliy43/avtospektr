<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h1>Заказы</h1>
<table cellspacing=20 cellpadding=20 width="60%">
<tr>
<?php 
$counter=0;
foreach($items as $item):?>
<?php if($counter==5) echo '</tr><tr>';?>
<td width=100 align=center valign=top><a href="<?php echo '/'.$this->module->id.'/'.$this->id.'/'.$item->name;?>" onclick="link_to(this);return false;"><img src="<?php echo '/images/'.Yii::app()->theme->name.'/icons/'.$this->module->id.'/'.$this->id.'/'.$item->name.'.png';?>" width="128" height="128" border="0" ><br><font><?php echo $item->show_name;?></font></a></td>
<?php 
$counter++;
endforeach;?>
</tr>
</table>