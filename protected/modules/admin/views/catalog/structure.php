<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
<h2>Структура и настройки каталога</h2>
<h3>Структура</h3>
<div id="contaiber_structure">
<?php
//$this->Widget('application.modules.catalog.components.TreeViewWidget');
?>
</div>
