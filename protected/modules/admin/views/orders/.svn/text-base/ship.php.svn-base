<header>
<title>Продажа товара</title>
</header>
<?php
header("Content-Type: text/html; charset=utf-8");

$html="
<h1 align=center>$firm->name</h1>
<h2 align=center>ИНН $firm->inn</h2>
<div align='center'>".$this->purchase_point->address." Тел.".$this->purchase_point->telephone." ".MAIL_ADMIN." &nbsp;<a href=".SITE_PATH.">".Yii::app()->name."</a></div>
<div align='center'><u>Бланк заказа №".$parameters['blank_id']." от ".$parameters['data_shipping'].".</u></div>
<hr align='center' width='80%'></hr>
<div align='center'>Заказчик: <b>".$parameters['buyer']."</b></div>
<div align='center'>Контактный телефон: <b>".$parameters['telephone']."</b></div>
<hr align='center' width='80%'></hr>
<div align=center><h2>Список проданных запчастей</h2></div>
<table border=1 cellpadding='2' cellspacing='2' align=center width=80%>
<th>Код детали</th>
<th>Название детали</th>
<th>Кол-во</th>
<th>Сумма</th>
";

foreach($orders as $row){

$html.= '<tr>';
$html.= '<td>'.$row->number.'</td>';
$html.= '<td>'.$row->info.'</td>';
$html.= '<td>'.$row->quantity.'</td>';
$html.= '<td>'.CPrice::getMoneyFormat($row->sum_client).'</td>';
$html.= '</tr>';

}
$html.= "</table>";
$html.= "<table align=center width=80%><tr><td width=50% align=right>&nbsp;</td><td align=right>Итого: ".CPrice::getMoneyFormat($parameters['sum'])." р.</td></tr></table>";

if($balance<0){
	$debt=abs($balance);
	$paid='0';
}
else{
$debt=0;
$paid=$parameters['sum'];	
}
$debt=CPrice::getMoneyFormat($debt);
$paid=CPrice::getMoneyFormat($paid);

$html.="
<table width='80%'>
<tr>
<td width='50%' align='center'>
Оплачено: $paid
</td>
<td align='center'>
Долг по оплате: $debt
</td>
</tr>
</table>";

$html.='
<hr align="center" width="80%"></hr>
<table width="80%" align="center">
<tr>
<td><b>Условия поставки:</b></td>
</tr>
</table>
<table width="80%" align="center" style="font-size:12px; font-weight:bold; ">
<tr>
<td>
1.Срок исполнения заказа от 5 дней, в зависимости от доставки и наличия запчастей на центральных складах Германии и Финляндии. Информацияо наличии товара на складах предоставляется исполнителем в течении 3-4 дней.
</td>
</tr>
<tr>
<td>
2.За заказ деталей, осуществленный по данным техпаспорта автомобиля заказчика, не соответствующим фактическим данным автомобиля, исполнитель ответственности не несет.
</td>
</tr>
<tr>
<td>
3.При аннулировании заказа, начиная со следующего дня от даты заказа или возврате детали не по вине исполнителя с заказчика производится удержание в сумме 50% от стоимости заказа.
</td>
</tr>
<tr>
<td>
4.Гарантию на запчасти,установленные на станциях техобслуживания, не имеющих соответствующую лицензию и сертификат исполнитель не дает!!!
</td>
</tr>
</table>
<table width="80%" align="center">
<tr>
<td>
Данные верны, с условиями согласен:___________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Исполнитель:___________________________
</td>
</tr>
</table>
<table align="center" width="80%" style="font-size:12px;">
<tr>
<td align="center" width="50%" style="font-size:10px;">(подпись заказчика)</td>
<td align="center" width="50%" style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(подпись исполнителя)</td>
</tr>
</table>';

echo $html;

?>