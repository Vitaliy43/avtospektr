<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;
	$prefix_link=SITE_PATH.$this->module->id.'/'.$this->id.'/index?item_id=';
	?>
<h2><?php echo $parent_item->name;?></h2>
<div id="catalog_info">

<?php if(count($products)>0):?>
<table cellpadding="4" cellspacing="4" class="product_info" width="80%">
<tr>
<th>Информация</th>
<th>Артикул</th>
<th>Цена, руб.</th>
</tr>
<?php foreach($products as $product):?>
<tr>
<td><?php echo $product->info;?></td>
<td><?php echo $product->number;?></td>
<!--td>
<?php if(isset($product->number_of_sales))
		echo $product->number_of_sales.' шт.';
	  elseif(isset($product->number_of_remains))
		echo $product->number_of_remains.' шт.';
?>
</td-->
<td>
<?php
if(isset($product->price_retail))
	echo CPrice::getMoneyFormat($product->price_retail);
elseif(isset($product->price_retail_remains))
	echo CPrice::getMoneyFormat($product->price_retail_remains);
?>
</td>
</tr>
<?php 
endforeach;?>
</table>
<?php else:?>
<?php if(count($this->items)>0):?>
<table cellpadding="5" cellspacing="5" width="100%">
<?php for($i=0;$i<count($this->items);$i=$i+2):?>
<tr>
<td nowrap="" class="catalog_link"><a href="<?php echo $prefix_link.$this->items[$i]->id;?>" onclick="ajax_link(this.href);return false;"><?php echo $this->items[$i]->name;?></a></td>
<?php if(isset($this->items[$i+1])):?>
<td nowrap="" class="catalog_link"><a href="<?php echo $prefix_link.$this->items[$i+1]->id;?>" onclick="ajax_link(this.href);return false;"><?php echo $this->items[$i+1]->name;?></a></td>
<?php else:?>
<td></td>
<?php endif;?>

</tr>

<?php endfor;?>
</table>
<?php else:?>
<div>Товаров в данном разделе нет.</div>
<?php if(UserIdentity::getProperty('role') == 'admin'):?>
<div class="add_client" style="margin-top:15px;">
<img src="/images/<?php echo Yii::app()->theme->name;?>/add.png"/>
<a href="<?php echo SITE_PATH.'catalog/menu/addpoint';?>" onclick="modal_add_point_catalog(this.href,0,<?php echo $parent_item->id;?>,<?php echo $parent_item->level+1;?>);return false;" style="font-weight:normal;" title="Добавить пункты в раздел">
<span>Добавить пункты в раздел</span>
</a>
</div>
<?php endif;?>
<?php endif;?>

<?php endif;?>
</div>	