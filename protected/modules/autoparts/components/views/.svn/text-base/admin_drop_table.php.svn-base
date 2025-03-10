
<?php if(count($this->items)>0):?>
<div class="head_drop_table">Список проданного клиенту &lt;&lt;<?php echo $this->items[0]->user->fio;?>&gt;&gt; от <?php echo $this->data_shipping;?></div>

<table border="0" class="dropTable">
<tr>
<th>№ заказа</th>
<th>Артикул</th>
<th>Производитель</th>
<th>Сумма, руб.</th>
<th>Информация</th>
</tr>

<?php foreach($this->items as $item):

if(isset($item->old_id))	{
	$order_id='B-'.$item->old_id;
}
else{
	$order_id='A-'.$item->id;
}


?>
<tr>
<td><?php echo $order_id;?></td>
<td><?php echo $item->number;?></td>
<td><?php echo $item->manufacturer;?></td>
<td><?php echo CPrice::getMoneyFormat($item->sum_client);?></td>
<td><?php echo $item->info;?></td>
</tr>

<?php endforeach;?>
</table>
<div>Итоговая сумма: <b><?php echo Utility::countSumSale($this->items[0]->data_shipping,$this->items[0]->user->id);?> руб.</b></div>
<?php endif;?>


