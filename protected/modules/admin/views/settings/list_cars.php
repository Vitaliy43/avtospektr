<div id="list_cars" style="width:400px;padding:20px;">
<h3>Список марок в разделе "Auto"</h3>
<table width="90%" cellpadding="2" cellspacing="2">
<?php for($i=0;$i<count($cars);$i=$i+2):?>
<tr>
<td>

<a href="<?php echo SITE_PATH.'admin/settings/setcars?item_id='.$cars[$i]->id;?>" onclick="set_cars(this.href,'<?php echo $article_id;?>');return false;"><?php echo $cars[$i]->name;?></a>
</td>
<?php if(isset($cars[$i+1])):?>
<td>
<a href="<?php echo SITE_PATH.'admin/settings/setcars?item_id='.$cars[$i+1]->id;?>" onclick="set_cars(this.href,'<?php echo $article_id;?>');return false;"><?php echo $cars[$i+1]->name;?></a>
</td>
<?php else:?>
<td></td>
<?php endif;?>
</tr>
<?php endfor;?>
</table>
</div>