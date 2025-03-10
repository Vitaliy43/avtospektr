<div id="to_work_popup">
<div class="head_drop_table">Пуск в работу заказа № <?php echo 'A-'.$order->id.' от '.CTime::change_show_data($order->data_waiting);?></div>
<div class="info">
<table class="dropTable">
<tr>
<th>Артикул</th>
<th>Производитель</th>
<th>Информация</th>
<th>Цена у поставщика</th>
</tr>
<tr>
<td><?php echo $order->number;?></td>
<td><?php echo $order->manufacturer;?></td>
<td><?php echo $order->info;?></td>
<td><?php echo $order->price;?></td>
</tr>
</table>
</div>
<div class="info">
<table class="dropTable">
<tr>
	<th>
		Введите id заказа у поставщика <?php echo $distributor_name;?>:
	</th>
	<th>
		<input type="text" id="dist_ord_id">
	</th>
</tr>
<tr></tr>
<tr>
<td id="popup_ajax_loader"></td>
<td align="center">
<button onclick="to_work('<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/'.$this->getAction()->getId();?>','<?php echo $order->id;?>','<?php echo SITE_PATH.$this->module->id.'/orders/status';?>');">Пустить в работу</button>
</td>
</tr>
</table>
</div>
</div>

