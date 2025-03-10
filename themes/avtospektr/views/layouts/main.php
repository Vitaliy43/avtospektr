<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<meta content="Омутнинск, Омутнинск автозапчасти, Омутнинск запчасти для иномарок, Омутнинск запчасти под заказ, Омутнинск автоэмали, Омутнинск подбор автоэмалей, Омутнинск кузовные детали, Омутнинск автомобили, Омутнинск иномарки, Омутнинск автохимия,  Омутнинск материалы для кузовного ремонта, Омутнинск автомагазин, Омутнинск запчасти для мототехники, Омутнинск запчасти для снегоходов, Омутнинск автомасла, Омутнинск масло" name="description">
<meta content="Омутнинск, Омутнинск автозапчасти, Омутнинск запчасти для иномарок, Омутнинск запчасти под заказ, Омутнинск автоэмали, Омутнинск подбор автоэмалей, Омутнинск кузовные детали, Омутнинск автомобили, Омутнинск иномарки, Омутнинск автохимия,  Омутнинск материалы для кузовного ремонта, Омутнинск автомагазин, Омутнинск запчасти для мототехники, Омутнинск запчасти для снегоходов, Омутнинск автомасла, Омутнинск масло" name="keywords">
	<link rel="SHORTCUT ICON" href="<?php echo Yii::app()->request->baseUrl.'/images/'.Yii::app()->theme->name.'/favicon.ico';?>" type="image/x-icon">
	<?php
	
	echo CHtml::cssFile(Yii::app()->request->baseUrl.'/css/'.Yii::app()->theme->name.'/style.css','screen,projection');
	echo CHtml::cssFile(Yii::app()->request->baseUrl.'/css/'.Yii::app()->theme->name.'/bg.css','screen,projection');

	Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/'.Yii::app()->theme->name.'/jquery.alerts.css');
	Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/jquery.treeview.css');
	Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/jquery.jqplot.css');
	Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/jquery.autocomplete.css');
	Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/css/'.Yii::app()->theme->name.'/jdate.css');
	echo CHtml::cssFile(Yii::app()->request->baseUrl.'/css/'.Yii::app()->theme->name.'/bacauto/style.css','screen,projection');
	echo CHtml::cssFile(Yii::app()->request->baseUrl.'/css/'.Yii::app()->theme->name.'/tinybox.css','screen,projection');
	echo CHtml::cssFile(Yii::app()->request->baseUrl.'/css/tipTip.css','screen,projection');
	echo CHtml::cssFile(Yii::app()->request->baseUrl.'/css/ibox.css','screen,projection');

	Yii::app()->getClientScript()->registerCoreScript('jquery');
	Yii::app()->getClientScript()->registerCoreScript('scroll');
	Yii::app()->getClientScript()->registerCoreScript('alerts');
	Yii::app()->getClientScript()->registerCoreScript('history');
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
	echo CHtml::scriptFile(Yii::app()->request->baseUrl.'/js/ibox.js');
//	echo CHtml::scriptFile(Yii::app()->request->baseUrl.'/js/gear.js');
	
//	echo CHtml::scriptFile(Yii::app()->request->baseUrl.'/js/jquery.pixlayout.0.92.7.js');
	
	echo CHtml::scriptFile(Yii::app()->request->baseUrl.'/js/'.Yii::app()->theme->name.'/basket.js');
	echo CHtml::scriptFile(Yii::app()->request->baseUrl.'/js/'.Yii::app()->theme->name.'/functions.js');
	if(UserIdentity::getProperty('role')=='root')
		echo CHtml::scriptFile(Yii::app()->request->baseUrl.'/js/ckeditor/ckeditor.js');
	
	
	
	?>
		<!--link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/jquery.pixlayout.0.92.7.js"></script>
		<script type="text/javascript" src="js/gear.js"></script-->
		

		<!--[if lt IE 8]>
		<meta http-equiv="refresh" content="0; url=ie6/ie6.html">
		<script type="text/javascript" src="/js/ie7.js"></script>
		<script type="text/javascript" src="/js/ie7-squish.js"></script>
		<script type="text/javascript" src="/js/DD_belatedPNG_0.0.8a-min.js"></script>
		<script>
		  DD_belatedPNG.fix('.img1,.img2');
		</script>
		<![endif]-->
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<?php 
	if(isset($this->javascript_items))
		echo $this->javascript_items;
	if(isset($this->javascript_client_items))
		echo $this->javascript_client_items;
	if(isset($this->javascript_admin_items))
		echo $this->javascript_admin_items;
	if(isset($this->javascript_distributors))
		echo $this->javascript_distributors;
	?>

	<script type="text/javascript">
	

	
	<?php if(isset($this->current_item)):?>
		
		var default_route=false;
		var current_controller_id='<?php echo $this->current_item->id;?>';
		
		<?php else:?>
		
		var default_route=true;
		var current_controller_id='';

		
		<?php endif;?>
			
		var supportsHistoryAPI=!!(window.history && history.pushState);// =true если поддерживается, иначе =false

	$(document).ready(function(){
	
		if($('#formDate1').length>0){
			$("#formDate1").attachDatepicker();
			$("#formDate2").attachDatepicker();
			
		}
		<?php 	if(UserIdentity::getProperty('role')=='root' or UserIdentity::getProperty('role')=='admin'):?>

		$("#catalog_tree").treeview({
        animated: "fast",
        collapsed: true
    });
	<?php endif;?>  


			$(".select-town li").hover(function(){
				$(this).find("ul").stop(true,true).slideDown();
			}, function(){
				$(this).find("ul").slideUp();
			});
			
});
	
	
	
	</script>
	
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
		<div id="sidebar">
		<div id="head-left-menu"><h1>Каталог товаров</h1></div>
<!-----------------------------Виджет меню каталога---------------------------------------------------------------->
	
	
	
	<?php
	// $this->beginWidget('application.modules.catalog.components.CatalogMenuWidget');
	 $this->Widget('application.modules.catalog.components.CatalogMenuWidget');
		
		//$this->endWidget();
		?>
	<div id="menu_authorization">
	<table cellpadding="0" cellspacing="0" id="authorization" width="100%">
		
			
			<!-----------------Виджеты блока авторизации или профиля ----------------------------------------------->
	<?php
	
	 if(UserIdentity::getProperty('fio')):
	
	 
			$this->Widget('application.components.ProfileWidget',array('action'=>$this->id,'model_name'=>$this->type_profile,'type_profile'=>$this->type_profile));

		
	 else:
	
	 	 $this->Widget('application.components.LoginWidget');
		
	 endif;	
		
		
		?>

		
	</table>
	</div>
	
	<!-----------------Виджет блока новостей----------------------------------------------->

	<?php $this->beginWidget('application.components.NewsWidget');
		
		$this->endWidget();
		?>

	</div>
			
			
			<div class="content">
					<div class="main-menu">
						<ul>
							
							<li><a href="<?php echo SITE_PATH;?>">Главная</a></li>
							<li><a href="<?php echo SITE_PATH.'autoparts/search';?>">Поиск запчастей</a></li>
							<li><a href="<?php echo SITE_PATH.'site/info';?>" onclick="ajax_link(this.href);return false;">Информация</a></li>
							<li><a href="<?php echo SITE_PATH.'site/contacts';?>" onclick="ajax_link(this.href);return false;">Контакты</a></li>
						</ul>
					</div>
					
	<input type="hidden" id="layout" value="main">
	
			
<?php

echo $content;

?>	

	</div>
						
	<!-----------------Виджет блока партнеров----------------------------------------------->
	<?php 
	$this->beginWidget('application.components.PartnersWidget');
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
