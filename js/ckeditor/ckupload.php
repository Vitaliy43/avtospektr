<?php

$callback = $_GET['CKEditorFuncNum'];

		$file_name = $_FILES['upload']['name'];
		$file_name_tmp = $_FILES['upload']['tmp_name'];
	

	$file_new_name = $_SERVER['DOCUMENT_ROOT'].'/uploads/images/'; 
	$full_path = $file_new_name.$file_name;
	$http_path = '/uploads/images/'.$file_name; // адрес изображения для обращения через http
	
	if( move_uploaded_file($file_name_tmp, $full_path) )
	{
	// можно добавить код при успешном выполнение загрузки файла
	} else
	{
	//$error = 'Ошибка, повторите попытку позже'; // эта ошибка появится в браузере если скрипт не смог загрузить файл
	$http_path = '';
	}
	echo "<script type=\"text/javascript\">// <![CDATA[
	window.parent.CKEDITOR.tools.callFunction(".$callback.",  \"".$http_path."\", \"".$error."\" );
	// ]]></script>";

?>