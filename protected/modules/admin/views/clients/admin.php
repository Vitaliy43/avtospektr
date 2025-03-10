<style type="text/css">
#easyTooltip{
	padding:5px 10px;
	border:1px solid #195fa4;
	background:#195fa4 url(/images/bg.gif) repeat-x;
	color:#fff;
	}
	.info_table a {
		text-decoration:underline;
	}

</style>

<script type="text/javascript">

$(function(){
//$(".link_info").tipTip({content: 'true'});
$(".link_info").tipTip({maxWidth: "300px"});
});
</script>
<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2>Клиенты</h2>
<div class="pager">
<?php $this->Widget('application.components.PagerWidget',array('pages'=>$pages,'cssFile'=>$this->css_file_pager,'page_size'=>$this->page_size,'current_route'=>$this->getRoute(),'pager_place'=>'up','is_filter'=>1));?>
</div>
<div class="add_client">
<img src="/images/<?php echo Yii::app()->theme->name;?>/add.png"/>
<a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/add';?>" onclick="add_client(this);return false;">
<span>Добавить клиента</span>
</a>
</div>
<?php if(count($clients)>0):?>
<div id="container_info_table">
<table width="98%" class="info_table" cellpadding="0" cellspacing="0">
<tr>
<th>ФИО или <br>наименование организации</th>
<th>Логин</th>
<th>Дата регистрации</th>
<th>Адрес</th>
<th>Телефон</th>
<th>Сред.оборот в мес., руб.</th>
<th>Наценка</th>
<th>Лимит для кредита</th>
<th></th>

</tr>
    <?php

    $last_count=count($clients)-1;
    $counter=0;

    foreach($clients as $client):?>
<tr id="row_<?php echo $client->id;?>">
 <?php 

 	$style='';
	
?> 
  <td style="<?php echo $style;?>" id="link_<?php echo $client->id;?>">
  <a href="<?php echo SITE_PATH.$this->module->id.'/clients/edit?client_id='.$client->id;?>" onclick="link_to(this);return false;" title="Редактировать клиента">
  <?php echo $client->fio;?>
  </a>
  </td>
  <td style="<?php echo $style;?>font-size:10px;"><?php echo $client->user;?></td>
  <td style="<?php echo $style;?>font-size:10px;"><?php echo CTime::change_show_data($client->data_registry);?></td>
  <td style="<?php echo $style;?>font-size:9px;" class="link_info" title="<?php echo $client->address;?>">Смотреть</td>
  <td style="<?php echo $style;?>"><?php echo $client->telephone;?></td>
  <td style="<?php echo $style;?>font-size:10px;"><?php echo CPrice::getMoneyFormat(Finance::avgAmountMonth($client->id));?></td>
  <td style="<?php echo $style;?>" class="link_info" title="<?php echo Utility::getClientDetailedInfo($client);?>">Смотреть</td>
    <td><?php 
	if(isset($client->client[0]))
		echo $client->client[0]->limit_credit;
	else
		echo '0';
	?>
	</td>
<td id="link_delete_<?php echo $client->id;?>">
	<a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/delete?client_id='.$client->id;?>" onclick="delete_client(this,'<?php echo $client->id;?>','<?php echo $client->user;?>');return false;" title="Удалить клиента"><img src="/images/<?php echo Yii::app()->theme->name.'/icon_delete.png';?>" width="8" height="8"/></a>
</td>
</tr>
<?
$counter++;
 endforeach;?>
</table>
</div>
<div class="pager">
<?php $this->Widget('application.components.PagerWidget',array('pages'=>$pages,'cssFile'=>$this->css_file_pager,'page_size'=>$this->page_size,'current_route'=>$this->getRoute(),'pager_place'=>'down','is_filter'=>1));?>
</div>
<?php else:
if(isset($_POST['flag_filter'])){
	echo '<div class="no_results">Поиск не дал результатов</div>';
}
else{
	echo '<div class="no_results">Раздел пуст</div>';

}

?>
<?php endif;?>