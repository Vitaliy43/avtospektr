<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2><?php echo $this->section_header.' для '.UserIdentity::getProperty('fio');?></h2>
<div class="finance_info">
<div>Баланс: <?php echo $items['balance'].'&nbsp;руб.';?></div>
<div>Заказы в работе: <?php echo $items['orders_in_work'].'&nbsp;руб.';?></div>
<div>Заказы на выдаче: <?php echo $items['orders_in_store'].'&nbsp;руб.';?></div>
<div>Долг по заказам: <?php echo $items['debt_by_orders'].'&nbsp;руб.';?></div>
<div>Ценовая категория: <?php echo $items['price_group'];?></div>
<div>Кредит: <?php echo $items['limit_credit'].'&nbsp;руб.';?></div>

</div>
