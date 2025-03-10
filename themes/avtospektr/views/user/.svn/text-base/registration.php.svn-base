<h2>Регистрация</h2>
<?php if($saved):

if($this->activated=true){
	echo '<div>Вы успешно зарегистрировались. Теперь вы сможете войти на сайт пользуюсь своим логином и паролем.</div>';
}
else{
	echo '<div>Вы зарегистрировали свой аккаунт, но для того, чтобы им пользоваться требуется активация. На e-mail, указанный вами при регистрации выслано письмо с инструкциями по активации</div>';
}

else:

?>

<form onsubmit="validate_registration(this);return false" method="POST" action="<?php echo 	SITE_PATH.'user/registration';?>">
<table width="100%">
<tr>
<td>Логин пользователя <b>(латинскими буквами!)</b>: <font color="#FF0000">*</font> 
 <br><input size="20" name="user" id="user" type="text" value="<?php if(isset($_REQUEST['user'])) echo $_REQUEST['user'];?>"></td>
 <td>
 <?php
 if(isset($errors['login_empty']))
 	echo $errors['login_empty'];
 elseif(isset($errors['login_russian']))
 	echo $errors['login_russian'];
 elseif(isset($errors['login_exist']))
 	echo $errors['login_exist'];
 ?>
 </td>
</tr>
<tr><td>Пароль: (не менее 4 символов) <font color="#FF0000">*</font><br>
 <input size="12" name="passwd" id="passwd" type="password" value="<?php if(isset($_REQUEST['passwd'])) echo $_REQUEST['passwd'];?>"></td>
 <td>
 <?php
 if(isset($errors['password_empty']))
 	echo $errors['password_empty'];
 elseif(isset($errors['password_strlen']))
 	echo $errors['password_strlen'];
 ?>
 </td>
 </tr>
 
 <tr><td>
 <?php
 
 if(isset($_REQUEST['type_contragent']) and $_REQUEST['type_contragent']=='individual'){
 	$checked_individual='checked=""';
	$check='individual';
	$fio_label='Фамилия и иннициалы';
	$address_label='Домашний адрес';
	$checked_juridical='';
 }
 elseif(isset($_REQUEST['type_contragent']) and $_REQUEST['type_contragent']=='juridical'){
 	$checked_juridical='checked=""';
	$check='juridical';
	$checked_individual='';
	$fio_label='Наименование организации';
	$address_label='Юридический адрес';
 }
 else{
 	$checked_individual='checked=""';
	$checked_juridical='';
	$check='individual';
	$fio_label='Фамилия и иннициалы';
	$address_label='Домашний адрес';
 }
 
 ?>
 <input  type="hidden" id="check" value="<?php echo $check;?>"/>
 <input type="radio" <?php echo $checked_individual;?> name="type_contragent" value="individual" id="individual" onclick="turn_contragent(this);">&nbsp;
 Физ. лицо<input type="radio" name="type_contragent" value="juridical" <?php echo $checked_juridical;?> id="juridical" onclick="turn_contragent(this);">&nbsp;Юрид. лицо</td></tr>
 <tr id="container_fio">
 <td><span><?php echo $fio_label;?>: </span><font color="#FF0000">*</font> <br>
 <input type="text" name="fio" size="30" id="fio" value="<?php if(isset($_REQUEST['fio'])) echo $_REQUEST['fio'];?>">
 </td>
 <td>
 <?php
 if(isset($errors['fio_empty']))
 	echo $errors['fio_empty'];
 ?>
 </td>
 </tr>
 <tr id="container_address">
 <td><span><?php echo $address_label;?>: </span><font color="#FF0000">*</font><br>
 <textarea style="font-size:13px;" name="address" cols="20" rows="2" id="address">
 <?php
 if(isset($_REQUEST['address']))
 	echo $_REQUEST['address'];
 ?>
 </textarea>
 </td>
 <td>
  <?php
 if(isset($errors['address_empty']))
 	echo $errors['address_empty'];
 ?>
 </td>
 </tr>
 <tr><td>Телефон: <font color="#FF0000">*</font><br>
 <input type="text" id="telephone" name="telephone" size="21" value="<?php if(isset($_REQUEST['telephone'])) echo $_REQUEST['telephone'];?>"></td>
 <td>
 <?php
 if(isset($errors['telephone_empty']))
 	echo $errors['telephone_empty'];
 ?> 
 </td>
 
 
 </tr>
 <tr><td>E-mail: <font color="#FF0000">*</font><br>
 <input type="text" id="email" name="email" size="21" value="<?php if(isset($_REQUEST['email'])) echo $_REQUEST['email'];?>"></td>
 <td>
 <?php
 if(isset($errors['email_empty']))
 	echo $errors['email_empty'];
 elseif(isset($errors['email_wrong']))
 	echo $errors['email_wrong'];
 elseif(isset($errors['email_exist']))
 	echo $errors['email_exist'];
 ?>
 </td>
 </tr>
 <tr><td>
            <table width="240" border="0" align="left">


                <tbody><tr>
                    <td align="left"><div id="status"></div></td>
                </tr>
				<tr>
						<td style="font-size:11px;" nowrap="">Кликните, чтобы обновить</td>
					</tr>
                <tr>
                    <td>
                       
                        <input type="image" onclick="return refreshCaptcha();" value="" src="/images/captcha.php" id="imgCaptcha" title="Кликните, чтобы обновить изображение">
						<span></span>
                    </td></tr>
					
                    <tr><td align="left">
                        текст: <input type="text" id="txtCaptcha" size="5" maxlength="5" value="" name="txtCaptcha">
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <?php
 							if(isset($errors['captcha']))
 							echo $errors['captcha'];
 						?> 

                    </td>
                </tr>
            </tbody></table></td></tr>
</table>
<div><input type="submit" value="Зарегистрироваться" id="submit" name="submit"></div>

</form>

<?php endif;?>
