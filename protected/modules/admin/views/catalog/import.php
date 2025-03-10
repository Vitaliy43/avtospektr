<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('application.components.BreadcrumbsWidget', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif;?>
	<script type="text/javascript">
	$(document).ready(function(){
	
			if($('#downloader_file').length>0){
				$('#downloader_file').hide();
			}

});

</script>


<h2>Импорт каталога</h2>
<form action="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/import';?>" method="POST">
<div id="form_import">
<?php if($data_last_modified):?>
<a href="#download_file" onclick="view_downloader('update');return false;" id="link_downloader_catalog" style="text-decoration:underline;">Обновить файл каталога </a>&nbsp;<span>(последняя дата изменения - <?php echo CTime::change_show_data($data_last_modified);?>)</span>
<?php else:?>
<a href="#download_file" onclick="view_downloader('insert');return false;" id="link_downloader_catalog" style="text-decoration:underline;">Загрузить файл каталога</a>
<?php endif;?>

<div id="downloader_file">
<img id="loading" src="<?php echo Yii::app()->request->baseUrl.'/images/'.Yii::app()->theme->name.'/ajax-loaders/loading.gif';?>" style="display:none;">
<form action="" method="POST" enctype="multipart/form-data">
<input id="catalog_file" type="file" size="15" name="catalog_file" class="input">
<button class="button" id="buttonUpload" onclick="ajaxFileUpload('<?php echo SITE_PATH;?>');return false;">Загрузить</button>
</form>
</div>
<div class="container_control" style="margin-top:10px;">
<span class="header">Тип импорта: </span>
<br>
<?php if($isset_catalog):
		$checked_create='';
		$checked_update='checked=""';
	  else:
	  	$checked_update='';
		$checked_create='checked=""';
	  endif;
		?>
<span class="control">Создание каталога <input type="radio" name="type_import" value="create" <?php echo $checked_create;?>/></span>
<span class="control">Обновление каталога <input type="radio" name="type_import" value="update" <?php echo $checked_update;?></span>
</div>
<div class="container_control">
<span class="header">Формат файла-источника: </span>
<br>
<span class="control">Excel(.xls) <input type="radio" name="type_source" value="xls" checked=""/></span>
<span class="control">XML(.xml) <input type="radio" name="type_source" value="xml"/></span>
</div>
<div class="container_control">
<?php if(!$isset_catalog)
		$checked='';
	  else
	  	$checked='checked=""';
		?>
<!--span class="header">Проверять дату модификации файла: <input type="checkbox" <?php echo $checked;?> name="check_file"></span-->
</div>
<div class="container_control" style="margin-top:8px;">
<input type="submit" name="import" value="Начать импорт"/>
</div>
</div>
</form>
<div id="import_block_message">
<?php if(isset($this->message_error) and $this->message_error!='0')
	echo $this->message_error;
	?>
</div>
