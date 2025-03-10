<script type="text/javascript">

$(function(){
$(".link_info").tipTip({maxWidth: "300px"});
});
</script>

<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2 style="margin-bottom:10px;">Поставщики</h2>
<div id="container_info_table">
<table width="99%" class="info_table" cellpadding="2" cellspacing="2">
<tr>
<th>Наименование</th>
<th>Сайт</th>
<th>Информация</th>
<th>Реквизиты</th>
<th>Сроки поставки</th>
<th>Базовая наценка</th>
<th>Скидки</th>
<th></th>
</tr>
   <?php

    $last_count=count($distributors)-1;
    $counter=0;

    foreach($distributors as $distributor):?>
	<tr>
	 <?php 

 	$style='';	
	$info='Адрес: '.$distributor->address.' Телефон: '.$distributor->telephone.' E-mail: '.$distributor->email;
	
	$requisites='';
	if($distributor->accesses[0]->id_enter)
		$requisites.='Id входа: '.$distributor->accesses[0]->id_enter.' ';
	$requisites.='Логин: '.$distributor->accesses[0]->login.' ';
	$requisites.='Пароль: '.$distributor->accesses[0]->password;
?> 
<td style="<?php echo $style;?>"><?php echo $distributor->name;?></td>
<td style="<?php echo $style;?>"><?php echo $distributor->site;?></td>
<td style="<?php echo $style;?>" class="link_info" title="<?php echo $info;?>">Смотреть</td>
<td style="<?php echo $style;?>" class="link_info" title="<?php echo $requisites;?>">Смотреть</td>
<td style="<?php echo $style;?>"><?php echo $distributor->period_delivery;?></td>
<td style="<?php echo $style;?>"><?php echo $distributor->add_price_default;?></td>
<td style="<?php echo $style;?>"><?php if($distributor->enable_discount==1) echo 'Да'; else echo 'Нет'?></td>
<td style="<?php echo $style;?>" id="link_<?php echo $distributor->id;?>"><a href="<?php echo SITE_PATH.$this->module->id.'/distributors/edit?distributor_id='.$distributor->id;?>" onclick="edit_distributor(this,'<?php echo $distributor->id;?>');return false;"><img src="/images/<?php echo Yii::app()->theme->name.'/icon_edit.png';?>" width="12" height="12" /></a>
</td>

	</tr>
	
	<?php 
	$counter++;
	endforeach;?>
</table>
</div>