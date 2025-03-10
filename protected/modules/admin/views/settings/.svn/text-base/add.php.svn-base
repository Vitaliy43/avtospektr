<?php if(isset($article)):?>
<h2>Редактирование материала</h2>
<?php else:?>
<h2>Добавление материала</h2>
<?php endif;?>
<form action="<?php echo SITE_PATH.$this->module->id.'/'.$this->id.'/content';?>" method="POST" onsubmit="validate_editor(this.action);return false;" name="editor_form">
<div id="article_header">
Заголовок <br>
<input type="text" name="header" id="content_header" value='<?php if(isset($article)) echo $article->header;?>'/><br>
</div>
<div id="container_editor">
<textarea id="editor" name="editor">
<?php if(isset($article))
	echo $article->content;?>
</textarea>
</div>

<script type="text/javascript">
//<![CDATA[
window.CKEDITOR_BASEPATH='/js/ckeditor/';
//]]>
CKEDITOR.replace('editor');

</script>
<div id="content_submit">
<?php if(isset($article)):?>
<input type="hidden" name="update" value="<?php echo $article->id;?>"/>
<?php else:?>
<input type="hidden" name="add" value="1"/>
<?php endif;?>
<input type="submit" value="Сохранить" name="submit"/>
</div>
</form>

<div id="test">
</div>