<script type="text/javascript">
$(function(){
$(".link_info").tipTip();
});
</script>
<?php if(isset($this->breadcrumbs)):?>
		<?php $this->Widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2>Список Vin запросов</h2>
<div class="filter">
<?php
if(isset($_POST['flag_filter']) or count($items)>0):
 $this->Widget('application.modules.autoparts.components.FilterWidget',array('current_url'=>$this->getRoute(),'action_view'=>$this->id,'num_items'=>count($items),'current_model'=>'VinRequest'));
 endif;
 
?>
</div>
<div class="pager">
<?php $this->Widget('application.components.PagerWidget',array('pages'=>$this->pages,'cssFile'=>$this->css_file_pager,'page_size'=>$this->page_size,'current_route'=>$this->getRoute(),'pager_place'=>'up','is_filter'=>1,'vin'=>true));?>
</div>
<div id="container_info_table">
<?php if(count($items)>0):?>
<table width="98%" class="info_table" cellpadding="2" cellspacing="0">
<tr><th>№ запроса</th>
<?php if($this->current_role=='admin'):?>
<th>Клиент</th>
<?php endif;?>
<th>Номер VIN или номер кузова</th><th>Год</th><th>Марка</th><th>Модель</th><th>Необходимые запчасти</th><th>Характеристики автомобиля</th><th>Дополнит. информация</th><th>Дата запроса</th>
 </tr>
 <?php 
 
 $last_count=count($items)-1;
 $counter=0;
 
 ?>
 <?php foreach($items as $item):?>
 <tr>
 <?php 
 	$style='';
	
?>
 <td style="<?php echo $style;?>"><?php echo $item->id;?></td>
 <?php if($this->current_role=='admin'):?>
 <td><?php echo $item->user->fio;?></td>
 <?php endif;?>
 <td style="<?php echo $style;?>"><?php echo $item->number_vin;?></td>
 <td style="<?php echo $style;?>"><?php echo $item->year;?></td>
 <td style="<?php echo $style;?>"><?php echo $brands[$item->brand];?></td>
 <td style="<?php echo $style;?>"><?php echo $item->model;?></td>
 <td style="<?php echo $style;?>"><?php echo $item->necessary_parts;?></td>
 <?php
 
 $car_info='';
 if($item->type_engine)
 	$car_info.='Тип двигателя: '.Vin::get_vin('type_engine',$item->type_engine).' ';
 if($item->engine_capacity)
 	$car_info.='Объем двигателя: '.$item->engine_capacity.'. ';
 if($item->gear)
 	$car_info.='Привод: '.Vin::get_vin('gear',$item->gear).'. ';
 if($item->car_bodies)
 	$car_info.='Тип кузова: '.Vin::get_vin('car_bodies',$item->car_bodies).'. ';
 if($item->transmission)
 	$car_info.='Тип КПП: '.Vin::get_vin('transmission',$item->transmission).'. ';
 if($item->air==3)
 	$car_info.='Кондиционер. ';
 if($item->abs==3)
 	$car_info.='ABS';
 if($item->gur==3)
 	$car_info.='ГУР';
	 ?>
 <td style="<?php echo $style;?>" align="center"
 <?php if($car_info) echo ' class="link_info" title="'.$car_info.'"';?>
 >
<?php if($car_info)  echo 'Смотреть';?>
 </td>
 <td style="<?php echo $style;?>" align="center"
 <?php if($item->additional_info) echo 'class="link_info" title="'.$item->additional_info.'"';?>>
 <?php if($item->additional_info):?>
 Смотреть
 <?php else:?>
 --
 <?php endif;?>
 </td>
 <td style="<?php echo $style;?>"><?php echo CTime::change_show_data($item->data_requested);?></td>
 </tr>
 
 <?php 
 $counter++;
 endforeach;
 ?>
</table>
<?php else:
if(isset($_POST['flag_filter'])){
	echo '<div class="no_results">Поиск не дал результатов</div>';
}
else{
	echo '<div class="no_results">Раздел пуст</div>';

}

endif;?>
</div>
<div class="pager">
<?php $this->Widget('application.components.PagerWidget',array('pages'=>$this->pages,'cssFile'=>$this->css_file_pager,'page_size'=>$this->page_size,'current_route'=>$this->getRoute(),'pager_place'=>'down','is_filter'=>1));?>
</div>
