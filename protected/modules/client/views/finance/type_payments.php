<style type="text/css">
	#type_payments {
		width:50%;
	}
	#type_payments span {
		color: #22b14c;
		font-size:16px;
	}
</style>
<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h1>Способы оплаты</h1>
<table cellspacing="20" cellpadding="20" width="60%" id="type_payments">
<tr>
<td align="left">
	<table>
		<tr>
			<td>
				<a href="/client/document/card" onclick="show_document(this.href);return false;"><img src="<?php echo '/images/type_payment.jpg';?>" width="128" height="128" border="0" ></a>
			</td>
			<td valign="bottom" style="padding-left: 15px;padding-bottom: 15px;">
				<a href="/client/document/card" onclick="show_document(this.href);return false;"><span>Оплата с банковской <br>карты</span></a>
			</td>
		</tr>
	</table>
		
			
</td>
<td align="left">
	<table>
		<tr>
			<td>
				<a href="/client/document/bill" onclick="show_document(this.href);return false;"><img src="<?php echo '/images/type_payment.jpg';?>" width="128" height="128" border="0" ></a>
			</td>
			<td valign="bottom" style="padding-left: 15px;padding-bottom: 35px;">
				<a href="/client/document/bill" onclick="show_document(this.href);return false;"><span>Оплата по счету</span></a>
			</td>
		</tr>
	</table>
</td>
</tr>
<tr>
	<td align="left">
	<table>
		<tr>
			<td>
				<a href="" onclick="show_document(this.href);return false;"><img src="<?php echo '/images/type_payment.jpg';?>" width="128" height="128" border="0" ></a>
			</td>
			<td valign="bottom" style="padding-left: 15px;padding-bottom: 15px;">
				<a href="/" onclick="show_document(this.href);return false;"><span>Оплата наличными <br>в пункте выдачи</span></a>
			</td>
		</tr>
	</table>	
</td>
<td align="left" >
	<table>
		<tr>
			<td>
				<a href="/client/document/invoice" onclick="show_document(this.href);return false;"><img src="<?php echo '/images/type_payment.jpg';?>" width="128" height="128" border="0" ></a>
			</td>
			<td valign="bottom" style="padding-left: 15px;padding-bottom: 35px;">
				<a href="/client/document/invoice" onclick="show_document(this.href);return false;"><span>Оплата по квитанции</span></a>
			</td>
		</tr>
	</table>
</td>
</tr>
</table>