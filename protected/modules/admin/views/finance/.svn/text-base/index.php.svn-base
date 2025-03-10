<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h1>Финансы</h1>
<table cellspacing=10 cellpadding=10 width="80%">
<tr>
<?php 
$counter=0;
foreach($items as $item):?>
<td width=100 align=center valign=top><a href="<?php echo '/'.$this->module->id.'/'.$this->id.'/'.$item->name;?>" onclick="link_to(this);return false;"><img src="<?php echo '/images/'.Yii::app()->theme->name.'/icons/'.$this->module->id.'/'.$this->id.'/'.$item->name.'.png';?>" width="128" height="128" border="0" ><br><font><?php echo $item->show_name;?></font></a></td>
<?php 
$counter++;
endforeach;?>
</tr>
</table>