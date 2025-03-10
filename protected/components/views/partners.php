<div class="our-parners">
				<h1>Наши партнеры:</h1>
				<ul>
				<?php foreach($partners as $partner):?>
					<li><a href="<?php echo $partner['link'];?>" target="_blank">
					<?php if($partner['name']=='Bacauto')
							$border='border:1px solid #b3e3a7;';
						else 
							$border='';?>
					<img src="/images/<?php echo Yii::app()->theme->name;?>/layout/<?php echo $partner['pic'];?>" style="<?php echo $border;?>" height="62"></a></li>
				<?php endforeach;?>
				</ul>
</div>