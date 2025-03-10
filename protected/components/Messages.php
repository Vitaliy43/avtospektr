<?php

class Messages extends CApplicationComponent
{
	protected static $manager_mail = 'avtospektr2014@mail.ru';

	public static function mail_notice($user,$type)
	{
 
 	switch($type){
		
	case 'order':
   	$message="На обработку поступили заказы от клиента $user->fio.";
	$to = MAIL_ADMIN;
  	$from = MAIL_SITE;
    $subject ="Заказы.";
   	$subject = '=?utf-8?b?'. base64_encode($subject) .'?=';
   	$headers = "Content-type: text/plain; charset=\"utf-8\"\r\n";
   	$headers .= "From: <". $from .">\r\n";
   	$headers .= "MIME-Version: 1.0\r\n";
   	$headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n";
   	$res=mail($to, $subject, $message, $headers);
   	$res=mail(self::$manager_mail, $subject, $message, $headers);
	break;
	
	case 'remind_password':
	$message="Восстановление пароля на сайте \"Автоспектр\".";
	$code=Utility::generate_password(8);
	$remind_password_link=SITE_PATH.'user/remind?code_restore='.$code;
	$message.=' Для восстановления пароля пройдитесь по ссылке '.$remind_password_link.'">'.$remind_password_link;
	$to = $user->email;
  	$from = MAIL_SITE;
	$_SESSION['code_restore']=$code;
	$_SESSION['temp_user']=$user->user;
    $subject ="Восстановление пароля.";
   	$subject = '=?utf-8?b?'. base64_encode($subject) .'?=';
   	$headers = "Content-type: text/plain; charset=\"utf-8\"\r\n";
   	$headers .= "From: <". $from .">\r\n";
   	$headers .= "MIME-Version: 1.0\r\n";
   	$headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n";
   	$res=mail($to, $subject, $message, $headers);
	break;
	
	}
     
	return $res;
    
}

}

?>