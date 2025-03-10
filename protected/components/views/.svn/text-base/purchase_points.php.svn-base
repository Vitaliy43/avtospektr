
<?php
	$url=SITE_PATH.'options/point';

?>
<ul class="select-town">
				<li><a href="#">Ваш город - <?php echo $points[$selected];?></a>
				
					<ul>
						<?php foreach($points as $key=>$value):?>
							<li><a href="<?php echo $url.'?purchase_point='.$key;?>" onclick="link_purchase_point(this.href);return false;"><?php echo $value;?></a></li>

						<?php endforeach;?>
					</ul>
				</li>
			</ul>