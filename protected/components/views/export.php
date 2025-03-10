
<span>
Экспорт
<?php
$action=Yii::app()->controller->getAction()->getId();
$controller=$this->controller->id;

?>
</span>
<span>
<a href="<?php echo SITE_PATH.Yii::app()->controller->module->id.'/'.$controller.'/'.$action.'?export=pdf'.$parameters;?>" title="Экспорт в PDF">
<img src="/images/avtospektr/icons/pdf.jpg" width="20" height="20">
</a>
</span>
<span>
<a href="<?php echo SITE_PATH.Yii::app()->controller->module->id.'/'.$controller.'/'.$action.'?export=xls'.$parameters;?>" title="Экспорт в Excel">
<img src="/images/avtospektr/icons/xls.gif" width="20" height="20">
</a>

</span>
<span>
<a href="<?php echo SITE_PATH.Yii::app()->controller->module->id.'/'.$controller.'/'.$action.'?export=doc'.$parameters;?>" title="Экспорт в Word">
<img src="/images/avtospektr/icons/doc.jpg" width="20" height="20">
</a>
</span>


