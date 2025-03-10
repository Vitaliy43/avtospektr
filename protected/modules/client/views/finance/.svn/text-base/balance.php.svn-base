<?php if(isset($this->breadcrumbs)):?>
		<?php $this->Widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;
		
		$first_year=Utility::getFirstYearOrders();
	
	?>
	
	<script type="text/javascript">
	
	$(document).ready(function(){
					
			$(".select-year li").hover(function(){
				$(this).find("ul").stop(true,true).slideDown();
			}, function(){
				$(this).find("ul").slideUp();
			});
	$(".link_info").tipTip();

});
	
	</script>
	
	<h2>Финансовая информация по <?php echo ucfirst(UserIdentity::getProperty('fio'));?></h2>
<div class="balance" style="margin-top:15px;">
			<table class="t-balance">
				<tbody>
					<tr>
						<th>Баланс <span><a href="#" title="<?php echo Yii::t('ClientModule.finance','balance');?>" class="link_info"><img src="/images/avtospektr/question.png" ></a></span></th>
						<th>Лимит заказов<span><a href="#" title="<?php echo Yii::t('ClientModule.finance','credit');?>" class="link_info"><img src="/images/avtospektr/question.png" ></a></span></th>
						<th align="left">Заказы<span><a href="#" title="<?php echo Yii::t('ClientModule.finance','orders_in_work');?>" class="link_info"><img src="/images/avtospektr/question.png" ></a></span></th>
					</tr>
					<tr>
						<td><span <?php if($items['balance']<0) echo 'style="color:#B90000;"';?>>
						<?php echo $items['balance'].'&nbsp;руб.';?>
						</span></td>
						<td><?php echo $items['limit_credit'].'&nbsp;руб.';?></td>
						<td>
							<table cellpadding="1" cellspacing="1">
							<?php if($items['orders_in_work']>0):?>
								<tr>
									<td style="font-size:11px;"><?php echo $items['orders_in_work'].'&nbsp;руб.';?>&nbsp;<a href="<?php echo SITE_PATH.$this->module->id.'/orders/status?hover=2';?>" onclick="link_to(this);return false;">в работе</a></td>
								</tr>
							<?php endif;?>
							<?php if($items['orders_in_store']>0):?>
								<tr>
									<td style="font-size:11px;"><?php echo $items['orders_in_store'].'&nbsp;руб.';?>&nbsp;<a href="<?php echo SITE_PATH.$this->module->id.'/orders/status?hover=3';?>" onclick="link_to(this);return false;">на складе</a></td>
								</tr>
							<?php endif;?>
							</table>		
						</td>
					</tr>
				</tbody>
			</table>
			
			<?php if(count($price_group_info)>0):?>
			<p>Скидки <a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/categories';?>" onclick="show_table_discounts(this.href);return false;" id="link_table_discounts"><span>(таблица скидок)</span></a></p>
			
			<table class="discount" cellpadding="4" cellspacing="4" style="margin-top:15px;">
				<tbody>
					<tr>
						<th>
						<ul class="select-year">
						<li>
						<a href="#">Год - <?php if(isset($_REQUEST['current_year'])) echo $_REQUEST['current_year']; else echo date('Y');?></a>
					
						<ul>
						<?php for($i=$first_year;$i<date('Y')+1;$i++):?>
								<li>
									<a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/statistic?choise_year='.$i;?>" onclick="show_table_price_group(this.href);return false;"><?php echo $i;?></a>
								</li>
								
							<?php endfor;
							?>	
							</ul>
							</li>
						</ul>
						</th>
						<?php foreach($amounts as $key=>$value):?>
							<th><?php echo $months_names[$key];?></th>
						
						<?php endforeach;?>
						
					</tr>
					<tr>
						<td>Ценовая группа:</td>
						<?php foreach($price_group_info as $elem):?>
							<td><?php echo $elem['name'];?></td>			
						<?php endforeach;?>
						
					</tr>
					<tr>
						<td>Скидка:</td>
						<?php foreach($price_group_info as $elem):?>
							<td><?php echo $elem['percent'].'%';?></td>			
						<?php endforeach;?>
						
					</tr>
					<tr>
						<td>Объем, руб.:</td>
						<?php foreach($amounts as $elem):?>
							<td><?php echo round($elem);?></td>			
						<?php endforeach;?>
						
					</tr>
				</tbody>	
			</table>
			
			<p><img src="/images/avtospektr/star-green.png"> - Текущие объемы закупок соответствуют скидке <?php echo $price_group_info[count($price_group_info)]['percent'];?>%</p>
			<?php endif;?>
				
			<span id="bill"><a href="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/payments';?>" onclick="link_to(this);return false;">Платежи и Списания</a></span>
		</div>	
		<div>
			<a href="/client/finance/typepayments" onclick="link_to(this);return false;"><img src="/images/avtospektr/pay.png" /></a>
		</div>	
		     <div></div>


			
			
			
			