
<script type="text/javascript">

$(document).ready(function(){

	$('.order_statistic a').click(function () {
	
      ajax_link(this);
	  return false;
    });

});

</script>

<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
	<h2>Статистика по заказам</h2>
	<?php if(count($items)>0):
	
	$html='<div class="order_statistic">';
	$url=SITE_PATH.$this->module->id.'/'.$this->id.'/'.$this->getAction()->getId();
		
		if($option=='number'){
			$point='Артикул';
			$key='number';
			$html.='<span>'.$point.'</span>&nbsp;&nbsp;';
		}
		else{
			$html.='<span><a href="'.$url.'?option=number">Артикул</a></span>&nbsp;&nbsp;';
		
		}
		
		if($option=='manufacturer'){
			$point='Производитель';
			$key='manufacturer';
			$html.='<span>'.$point.'</span>&nbsp;&nbsp;';
		}
		else{
			$html.='<span><a href="'.$url.'?option=manufacturer">Производитель</a></span>&nbsp;&nbsp;';
		
			
		}
		
		if($option=='user'){
			$point='Логин';
			$key='user';
			$html.='<span>'.$point.'</span>&nbsp;&nbsp;';
		}
		else{
			$html.='<span><a href="'.$url.'?option=user">Заказчик</a></span>&nbsp;&nbsp;';
		
			
		}
		
		if($option=='distributor'){
			$point='Поставщик';
			$key='distributor';
			$html.='<span>'.$point.'</span>&nbsp;&nbsp;';
		}
		else{
			$html.='<span><a href="'.$url.'?option=distributor">Поставщик</a></span>&nbsp;&nbsp;';
		
			
		}
		
		$html.='</div>';
		
		echo $html;
	
	?>
	<table width="60%" class="info_table" cellpadding="0" cellspacing="0">
	<tr>
	<th><?php echo $point;?></th>
	<?php if($key=='user'){
		echo '<th>ФИО</th>';
	}?>
	<th>Кол-во заказов</th>
	<th style="border-right: 0px;">% от общего кол-ва</th>
	</tr>
	<?php
	$last_count=count($items)-1;
 	$counter=0;
 	foreach($items as $k=>$v):
	
	if($last_count==$counter)
 	$style='border-bottom: 0px;';
 else
 	$style='';
	
	
	?>
	<tr>
	<?php if($key=='user'):?>
	 <td style="<?php echo $style;?>"><?php echo $v['login'];?></td>
	 <td style="<?php echo $style;?>"><?php echo $v['fio'];?></td>
	 <td style="<?php echo $style;?>"><?php echo $v['value'];?></td>
	 <td style="border-right: 0px;<?php echo $style;?>"><?php echo round($v['value']/$count_table,3)*100;?></td>
	<?php else:?>
	 <td style="<?php echo $style;?>"><?php echo $k;?></td>
	 <td style="<?php echo $style;?>"><?php echo $v;?></td>
	 <td style="border-right: 0px;<?php echo $style;?>"><?php echo round($v/$count_table,3)*100;?></td>
	<?php endif;?>
	</tr>
	<?php 
	$counter++;
	endforeach;?>
	</table>
	<?php else:
	echo '<div class="no_results">Раздел пуст</div>';
?>
<?php endif;?>