<h2>Ценовые группы</h2>
<br/>
<table width="98%" class="info_table" cellpadding="0" cellspacing="0">
<tr><th>Название</th><th>Оборот за месяц,руб.</th><th>% скидки</th><th nowrap="">Лимит для заказа</th><th nowrap="">Лимит для отгрузки</th>
</tr>
<?php 
 
 $last_count=count($items)-1;
 $counter=0;
 
 ?>
<?php foreach($items as $item):

if($last_count==$counter)
 	$style='border-bottom: 0px;';
 else
 	$style='';

?>
<tr id="row_<?php echo $item->id;?>">
 <td ><?php echo $item->name;?></td>
 <td ><?php echo $item->amount;?></td>
 <td ><?php echo $item->percent;?></td>
 <td ><?php if($item->limit_for_order==1) echo 'Есть'; else echo 'Нет';?>
 </td>
  <td ><?php if($item->limit_for_store==1) echo 'Есть'; else echo 'Нет';?>
 </td>
</tr>
<?php $counter++;
endforeach;
?>

</table>