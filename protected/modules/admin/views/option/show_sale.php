<div id="to_work_popup">
<?php if(count($orders)>0):?>
 <div class="head_drop_table"><?php echo $client->fio;?>: список запчастей для продажи</div>
<table border="0" class="dropTable">
<tr>
<th>№ заказа</th>
<th>Артикул</th>
<th>Производитель</th>
<th>Сумма со скидкой, руб.</th>
<th>Информация</th>
</tr>

<?php foreach($orders as $order):

if(isset($order->old_id))	{
	$order_id='B-'.$order->old_id;
}
else{
	$order_id='A-'.$order->id;
}


?>
<tr>
<td><?php echo $order_id;?></td>
<td><?php echo $order->number;?></td>
<td><?php echo $order->manufacturer;?></td>
<td><?php echo CPrice::getMoneyFormat($order->sum_client);?></td>
<td><?php echo $order->info;?></td>
</tr>

<?php endforeach;?>
</table>
<div>Итого к оплате: <b><?php echo $sum_client;?> руб.</b></div>
<?php endif;?>
</div>