<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta content="Омутнинск, Омутнинск автозапчасти, Омутнинск запчасти для иномарок, Омутнинск запчасти под заказ, Омутнинск автоэмали, Омутнинск подбор автоэмалей, Омутнинск кузовные детали, Омутнинск автомобили, Омутнинск иномарки, Омутнинск автохимия,  Омутнинск материалы для кузовного ремонта, Омутнинск автомагазин, Омутнинск запчасти для мототехники, Омутнинск запчасти для снегоходов, Омутнинск автомасла, Омутнинск масло" name="description">
<meta content="Омутнинск, Омутнинск автозапчасти, Омутнинск запчасти для иномарок, Омутнинск запчасти под заказ, Омутнинск автоэмали, Омутнинск подбор автоэмалей, Омутнинск кузовные детали, Омутнинск автомобили, Омутнинск иномарки, Омутнинск автохимия,  Омутнинск материалы для кузовного ремонта, Омутнинск автомагазин, Омутнинск запчасти для мототехники, Омутнинск запчасти для снегоходов, Омутнинск автомасла, Омутнинск масло" name="keywords">
	<?php
	
	echo CHtml::cssFile(Yii::app()->request->baseUrl.'/css/'.Yii::app()->theme->name.'/style.css','screen,projection');	
	echo CHtml::cssFile(Yii::app()->request->baseUrl.'/css/'.Yii::app()->theme->name.'/bg.css','screen,projection');


	Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/'.Yii::app()->theme->name.'/jquery.alerts.css');
	Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/jquery.treeview.css');
	Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/jquery.jqplot.css');
//	Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/selectbox.css');
	Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/jquery.autocomplete.css');
	Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/'.Yii::app()->theme->name.'/jdate.css');
	Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/jquery.tzCheckbox.css');
	echo CHtml::cssFile(Yii::app()->request->baseUrl.'/css/'.Yii::app()->theme->name.'/bacauto/style.css','screen,projection');
	echo CHtml::cssFile(Yii::app()->request->baseUrl.'/css/'.Yii::app()->theme->name.'/tinybox.css','screen,projection');
	echo CHtml::cssFile(Yii::app()->request->baseUrl.'/css/tipTip.css','screen,projection');
	echo CHtml::cssFile(Yii::app()->request->baseUrl.'/css/ibox.css','screen,projection');
	Yii::app()->getClientScript()->registerCoreScript('jquery');
	Yii::app()->getClientScript()->registerCoreScript('scroll');
	Yii::app()->getClientScript()->registerCoreScript('alerts');
	Yii::app()->getClientScript()->registerCoreScript('history');
	Yii::app()->getClientScript()->registerCoreScript('tzCheckbox');
	Yii::app()->getClientScript()->registerCoreScript('colorbox');
	Yii::app()->getClientScript()->registerCoreScript('jdate');
	Yii::app()->getClientScript()->registerCoreScript('autocomplete');
	if(UserIdentity::getProperty('role')=='root' or UserIdentity::getProperty('role')=='admin')
		Yii::app()->getClientScript()->registerCoreScript('treeview');
	Yii::app()->getClientScript()->registerCoreScript('tipTip');
	if(UserIdentity::getProperty('role')=='root'){
		Yii::app()->getClientScript()->registerCoreScript('jqplot');
		Yii::app()->getClientScript()->registerCoreScript('barRenderer');
		Yii::app()->getClientScript()->registerCoreScript('categoryAxisRenderer');
		Yii::app()->getClientScript()->registerCoreScript('pointLabels');
	}
	
	if(UserIdentity::getProperty('role')=='root' or UserIdentity::getProperty('role')=='admin')
		Yii::app()->getClientScript()->registerCoreScript('ajaxfileupload');
	 
	echo CHtml::scriptFile(Yii::app()->request->baseUrl.'/js/tinybox.js');
	echo CHtml::scriptFile(Yii::app()->request->baseUrl.'/js/jquery.tzCheckbox.js');
	echo CHtml::scriptFile(Yii::app()->request->baseUrl.'/js/ibox.js');
//	echo CHtml::scriptFile(Yii::app()->request->baseUrl.'/js/gear.js');
	echo CHtml::scriptFile(Yii::app()->request->baseUrl.'/js/jquery.pixlayout.0.92.7.js');
	
	echo CHtml::scriptFile(Yii::app()->request->baseUrl.'/js/'.Yii::app()->theme->name.'/basket.js');
	echo CHtml::scriptFile(Yii::app()->request->baseUrl.'/js/'.Yii::app()->theme->name.'/functions.js');
	
	if(UserIdentity::getProperty('role')=='root')
		echo CHtml::scriptFile(Yii::app()->request->baseUrl.'/js/ckeditor/ckeditor.js');
		
	?>
	
	<!--[if lt IE 8]>
		<meta http-equiv="refresh" content="0; url=ie6/ie6.html">
		<script type="text/javascript" src="js/ie7.js"></script>
		<script type="text/javascript" src="js/ie7-squish.js"></script>
		<script type="text/javascript" src="js/DD_belatedPNG_0.0.8a-min.js"></script>
		<script>
		  DD_belatedPNG.fix('.img1,.img2');
		</script>
		<![endif]-->
		
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		
		<style type="text/css">
		
		.content{
		margin: 0 0 0 0px;
		}
		
		</style>
		
		<script type="text/javascript">
		
		var supportsHistoryAPI=!!(window.history && history.pushState);// =true если поддерживается, иначе =false

		$(document).ready(function(){
		
		if($('#formDate1').length>0){
			$("#formDate1").attachDatepicker();
			$("#formDate2").attachDatepicker();
			
		}
		
		
		
		$(".select-town li").hover(function(){
				$(this).find("ul").stop(true,true).slideDown();
			}, function(){
				$(this).find("ul").slideUp();
			});
			
		});
		
		</script>
		
		<?php
		
		if(isset($this->javascript_distributors))
			echo $this->javascript_distributors;
		
		?>

</head>
<body>
		<div class="wrapper">
		<div id="hesterni-top-left"></div>
			<div id="spring-top-left"></div>
			<div id="hesterni-top-right"></div>
			<div id="hesterni-bottom-left"></div>
			<div id="spring-bottom"></div>
			<div id="hesterni-bottom-right"></div>
			<div class="header-main">
	<!-----------------------------Виджет выбора точки---------------------------------------------------------------->
	
		<?php
		
	 $this->Widget('application.components.PurchasePointWidget');	
		?>
	
	<!---------------------------------------------------------------------------------------------------------------->

				
				<img id="h-bottom-left" src="/images/avtospektr/layout/h-bottom-left.jpg">
				<div>
					<div class="logo">
					<img id="h-line-r" src="/images/avtospektr/layout/h-line-r.jpg">
					<a href="<?php echo SITE_PATH;?>" id="link_logo"><img id="logo"src="/images/avtospektr/layout/logo.png"></a>
					<img id="car" src="/images/avtospektr/layout/car.png">
					</div>	
				</div>
				<img id="h-bottom-right" src="/images/avtospektr/layout/h-bottom-right.png">
				<div id="phone">тел.: +7 <?php echo $this->purchase_point->telephone;?></div>
				<div style="clear: left"></div>
			</div>
		
		<!-----------------------------Виджет меню марок машин-------------------------------------------------------------->
	
		<?php
		
	 $this->Widget('application.components.CarsWidget');	
		?>
	
	<!------------------------------------------------------------------------------------------------------------------>
			<div class="karkas">		
			
			<div class="content">
				<div class="user">
			<div class="user-menu">
				<h1>Меню</h1>
				<?php	
				echo CHtml::dropDownList('user_menu','--',$this->upper_list,array('id'=>'user_menu','onchange'=>"user_menu('".SITE_PATH."');"));
				
				?>
				<p>Ваша ценовая группа: <span><?php
				if(UserIdentity::getProperty('role'))
				 	echo $this->current_price_group['name'];
				else
					echo 'Гость';
				
				?></span></p>
			</div>
			<div class="additional-menu">
				<ul>
				<li>
					<a href="<?php echo SITE_PATH.$this->module->id.'/search';?>">Поиcк по номеру</a>	
				</li>
					
				<?php if(UserIdentity::getProperty('role')):?>	
				<li>
					<a href="<?php echo SITE_PATH.$this->module->id.'/vin';?>" onclick="ajax_link(this.href);return false;">Запрос по Vin коду</a>
				</li>
				<input type="hidden" id="layout" value="autoparts">
				<li>
					<a href="<?php echo SITE_PATH.$this->current_role.'/orders';?>" onclick="ajax_link(this.href);return false;">История заказов</a>
				</li>
				
				<li>
					<a href="<?php echo SITE_PATH.$this->current_role.'/cart';?>" class="menu_cart" onclick="ajax_link(this.href);return false;">Корзина
				<?php
				if(isset($this->basket_num))
					echo '&nbsp;('.$this->basket_num.')';
				?>
				</a>
				</li>
				
				<li>
					<a href="<?php echo SITE_PATH.$this->current_role.'/finance';?>" onclick="ajax_link(this.href);return false;">Финансы</a>
				</li>
				
				<?php if($this->current_role=='client'):?>
				
				<li>
					<a href="<?php echo SITE_PATH.$this->current_role.'/profile';?>" onclick="ajax_link(this.href);return false;">Профиль</a>
				</li>
				
				<?php endif;?>
				
				<?php if($this->current_role=='admin' and UserIdentity::getProperty('role')!='manager'):?>
				
				<li>
					<a href="<?php echo SITE_PATH.$this->current_role.'/clients';?>" onclick="ajax_link(this.href);return false;">Клиенты</a>
				</li>
				
				<?php endif;?>
				<li>
					<a href="<?php echo SITE_PATH.'user/logout';?>" onclick="ajax_link(this.href);return false;">Выход</a>
				</li>
				<?php else:?>
					<li>
						<a href="<?php echo SITE_PATH.'client/cart';?>" class="menu_cart" onclick="ajax_link(this.href);return false;">Корзина
					<?php
					if(isset($this->basket_num))
						echo '&nbsp;('.$this->basket_num.')';
					?>
						</a>
					</li>
					<li>
						<a href="<?php echo SITE_PATH.'user/registration';?>">Регистрация</a>
					</li>
				
				<?php endif;?>
				
				</ul>	
			</div>
		</div>	
					
					
	<div class="container">
	<div id="content">
<?php

echo $content;

?>	
</div>
	</div>
	
	</div>
						
	<!-----------------Виджет блока партнеров----------------------------------------------->
	
	<?php $this->beginWidget('application.components.PartnersWidget');
		
		$this->endWidget();
		?>
			
	<!-------------------------------------------------------------------------------------->
		
		</div>
		
		<div class="footer">
			<div id="recive">© 2012  Все права защищены АВТОСПЕКТР</div>
			<?php 
	 
	//if($this->beginCache('addthis',array('duration'=>86400))){?>
			<div class="share">
				<script type="text/javascript" src="//yandex.st/share/share.js"charset="utf-8"></script>
				<div class="yashare-auto-init" data-yashareL10n="ru"
 					data-yashareType="link" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir"></div> 
</div>
<?php
//}	
		?>
		

		</div>
		
		</div>

</body>


</html>
