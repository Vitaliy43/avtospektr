<?php

?>
<table>
	<tr>
		<td><span style="font-weight:bold;">Контактное лицо, ФИО:</span>....<?php echo $user->fio;?></td>
		<td></td>
	</tr>
	<tr>
		<td><span style="font-weight:bold;">Адрес:</span>.......................<?php echo $user->address;?></td>
		<td></td>
	</tr>

	<tr>
		<!--td><span style="font-weight:bold;">Способ оплаты:</span>.....<?php echo $type_payment;?></td-->
		<td><span style="font-weight:bold;">Способ оплаты:</span>.....<?php echo $user->type_payments->show_type;?></td>
		<td></td>
	</tr>
		<tr>
		<td colspan="2" style="padding-top: 10px;">
			<button id="change_contacts" value="" onclick="show_document('/client/profile');return false;">Изменить контактные данные</button>
		</td>
	</tr>
</table>
<div id="container_info_table" style="margin-top: 15px;">
<?php if(count($orders)>0):?>
<table width="98%" class="info_table" cellpadding="0" cellspacing="0">
	<tr>
		<th>Фирма</th>
		<th>Код детали</th>
		<th>Название</th>
		<th>Кол-во</th>
		<th>Цена, Р.</th>
		<th>Сумма, Р.</th>
	</tr>
	<?php foreach($orders as $order):?>
	<tr>
		<td><?php echo $order->manufacturer;?></td>	
		<td><?php echo $order->number;?></td>	
		<td><?php echo $order->info;?></td>	
		<td><?php echo $order->quantity;?></td>	
		<td><?php echo $order->price_client;?></td>	
		<td><?php echo $order->sum_client;?></td>	
		
	</tr>
	<?php endforeach;?>
			
</table>
<table width="98%" style="margin-top: 20px;">
<tr>
	<td colspan="2" align="right">
			<button id="change_basket" value="" onclick="ajax_link('/client/cart')">Изменить содержимое карзины</button>
	</td>
</tr>
</table>
<table width="98%" style="margin-top: 15px;">
	<td></td>
	<td align="right">Со всеми пунктами <a href="/client/document/contract" style="color:#154a6c;text-decoration: underline;font-weight: bold;" target="_blank">договора</a> ознакомлен, <a href="/client/cart/order" style="background: #809db8; color: #fff; padding:4px;" onclick="ajax_link_order(this.href);return false;">Согласен, отправить заказ</a></td>
</table>
<?php endif;?>
</div>

