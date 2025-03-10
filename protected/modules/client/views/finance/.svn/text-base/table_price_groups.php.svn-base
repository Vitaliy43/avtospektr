

<?php
		$first_year=Utility::getFirstYearOrders();
?>

<tbody>
					<tr>
						<th>
						<ul class="select-year">
						<li>
						<a href="#">Год - <?php if(isset($_REQUEST['choise_year'])) echo $_REQUEST['choise_year']; else echo date('Y');?></a>
					
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
				
			
<script type="text/javascript">

$(".select-year li").hover(function(){
	$(this).find("ul").stop(true,true).slideDown();
}, function(){
	$(this).find("ul").slideUp();
});

</script>	