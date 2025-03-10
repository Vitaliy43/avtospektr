<script type="text/javascript">


if($('#formDate').length>0){
			$("#formDate").attachDatepicker();
		}	
$('#payment_form').submit(function() {
	add_payment();
	return false;
	
});

</script>

<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2><?php echo $this->section_header;?></h2>
<form action="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/reports';?>" method="POST" id="payment_form">
 <div>
<table cellspacing=5 cellpadding=5 border=0>
<tr><td valign="top">Клиент</td>
<td>
 <?php
if(isset($_POST['client_id'])){
	$selected=$_POST['client_id'];
	
}
else{
	$selected='0';
}

echo CHtml::dropDownList('client_id',$selected,$clients,array('id'=>'client_id'));
?>
</td>
 </tr>
 <tr>
 <td>
  Вид операции
 </td>
 <td>
<select name="type_operation" onchange="change_annotation();" id="type_operation_payment">
<option value="add">Зачисление средств
<option value="remove">Снятие средств
</select></td>
</tr>
<tr>
<td>Дата проведения операции</td>
<td>
<?php 

	$current_date=CTime::calendar_data();
?>
<input id="formDate" name="date" type="text" value="<?php echo $current_date;?>">
		</td>
</tr>
<tr><td>Вид платежа</td><td>
<?php 

if(isset($_POST['type_payment']))
	$selected=$_POST['type_payment'];
else
	$selected='1';

echo CHtml::dropDownList('type_payment',$selected,$type_payments,array('id'=>'type_payment'));?>
</td></tr>
<tr><td>Сумма</td><td><input type=text name='sum' value='0' id="sum" class="payments_sum"></td>
</tr>
<tr>
<td valign="top">Примечание</td>
<td><textarea rows="3" cols="18" name='annotation' style='font-size:13px;' id="annotation">Оплата</textarea></td></td>
</tr>
<tr>
<td></td></tr><tr></tr>
<tr><td>
<input type=submit value='Совершить операцию' name='add_payment' id="add_payment"></td></tr>
 </table>
 </div>
 </form>
 
 
