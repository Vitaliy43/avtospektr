<?php

?>
<div style="padding-left: 30%;padding-top: 3%;">
<div>
	<h3>Образец заполнения платежного поручения</h3>
	<table border="1" cellpadding="3" cellspacing="3">
		<tr>
			<td width="150">ИНН: <?php echo $this->inn;?></td>
			<td width="150">КПП</td>
			<td rowspan="2" valign="bottom" width="50"> Сч. №</td>
			<td rowspan="2" width="300"><?php echo $this->current_account;?></td>
		</tr>
		<tr>
			<td colspan="2">Получатель: <?php echo $this->recipient;?></td>
		</tr>
		<tr>
			<td colspan="2" rowspan="2">
				Банк получателя: <?php echo $this->bank_recipient;?>
			</td>
			<td>БИК: </td>
			<td rowspan="2">
				<?php echo $this->bik;?></br>
				<?php echo $this->correspondence_account;?>
			</td>
		</tr>
		<tr>
			<td valign="bottom" width="50"> Сч. №</td>

		</tr>
	</table>
</div>
<?php if(isset($order_id)):?>
<div style="margin-left: 40px;font-size: 18px;font-weight: bold;margin-top: 20px;">
	СЧЕТ № <?php echo $order_id;?>____________ от "<?php echo date('d');?>" <?php echo date('m');?>___________________<?php echo date('Y');?> г.
</div>
<?php else:?>
<div style="margin-left: 40px;font-size: 18px;font-weight: bold;margin-top: 20px;">
	СЧЕТ № _____________________ от "__" ______________________<?php echo date('Y');?> г.
</div>
<?php endif;?>
<div style="margin-top: 50px;font-size: 18px;">
<div style="margin-left: 15px;">Плательшик: <?php if (isset($payer)) echo $payer;?></div>
<div style="margin-left: 15px;">Грузополучатель: <?php if(isset($consignee)) echo $consignee;?></div>
</div>
<div style="margin-top: 15px;">
	<table cellpadding="3" cellspacing="3" style="font-weight: bold;font-size: 16px;" border="2" width="700">
		<tr>
			<th>№</th>
			<th>Наименование товара</th>
			<th>Единица</th>
			<th>Кол-во</th>
			<th>Цена</th>
			<th>Сумма</th>
		</tr>
		<?php $counter=0;?>
		<?php if(isset($orders)):?>
		
		<?php foreach($orders as $order){ ?>
		<tr height="20">
			<?php $counter++;?>
			<td><?php echo $counter;?></td>
			<td><?php echo $order->info;?></td>
			<td>шт.</td>
			<td><?php echo $order->quantity;?></td>
			<td><?php echo $order->price_client;?></td>
			<td><?php echo $order->sum_client;?></td>
		</tr>
		
		<?php }?>
		
		<?php else:?>
		<?php for($i=0;$i<12;$i++){ ?>
		<tr height="20">
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?php }?>
		<?php endif;?>
	</table>
<table style="margin-top: 0px;" style="font-weight: bold;font-size: 16px;" width="700">
	<tr>
		<td align="right" width="600"><b>Итого: </b></td>
		<td style="border:1px solid;"><?php if(isset($summary)) echo $summary;?></td>
	</tr>
		<tr>
		<td align="right" width="600"><b>В т.ч НДС (18%):</b> </td>
		<td style="border:1px solid;"></td>
	</tr>
		<tr>
		<td align="right" width="600"><b>Всего к оплате: </b></td>
		<td style="border:1px solid;"><?php if(isset($summary)) echo $summary;?></td>
	</tr>
</table>
</div>
</div>